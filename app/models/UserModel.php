<?php
class UserModel extends Model{
    public function idExist($id){
	return $this->db->count('accounts', array('guid'=>(int)$id)) > 0;
    }

    public function accountExists($account){
        return $this->db->count('accounts', array('account'=>$account)) > 0;
    }

    public function pseudoExists($pseudo){
        return $this->db->count('accounts', array('pseudo'=>$pseudo));
    }

    /**
     * load an user with pass and account name
     * @param string $user
     * @param string $pass
     * @return mixed
     */
    public function loadForLogin($user, $pass){
        $data = $this->db->executeFirst('SELECT a.account, a.guid, a.level, a.pseudo, d.*, r.*, a.banned FROM accounts a LEFT JOIN byxxr_accounts_data d ON d.account_id = a.guid LEFT JOIN byxxr_rigths r ON r.user_id = a.guid WHERE account = :account AND pass = :pass ', array('account'=>trim($user), 'pass'=>trim($pass)));

        if(!$data)
            return false;

        if($data['ip']==''){
            $this->createAccountData($data['guid'], $_SERVER['REMOTE_ADDR']);
            $data['ip']=$_SERVER['REMOTE_ADDR'];
        }

        return $data;
    }

    public function getStaff($with_sa = true){
        $query = 'SELECT a.guid, a.level, a.pseudo, d.avatar, d.info FROM accounts a LEFT JOIN byxxr_accounts_data d ON d.account_id = a.guid WHERE a.level >= 1';
        if(!$with_sa)
        {
            $query .= ' AND guid <> '.$this->config['admin']['super_admin'];
        }
        $query .= ' ORDER BY a.level DESC';
        $req = $this->database->query($query);
        return $req->fetchAll();
    }

    /**
     * Test if the user can vote
     * @return boolean
     */
    public function canVote(){
        $last_vote = (int)$this->session->vote_time;

        return $last_vote + $this->config['points']['vote_time']*60 < time();
    }

    public function canVoteByIp($ip){
        $t = time() - $this->config['points']['vote_time']*60;
        $data = $this->db->executeFirst('SELECT COUNT(*) FROM byxxr_accounts_data WHERE ip = :ip AND vote_time > :t', array(
            'ip'=>$ip,
            't'=>$t
        ));

        return $data['COUNT(*)'] == 0;
    }

    /**
     * Add points, increment votes columns and set at actual time vote_time
     * @param int $id
     */
    public function validateVote($id){
        $stmt = $this->db->prepare('UPDATE byxxr_accounts_data SET points = points + ?, votes = votes + 1, vote_time = ? WHERE account_id = ?');
        $stmt->bindParam(1, $this->config['points']['per_vote'], PDO::PARAM_INT);
        $stmt->bindValue(2, time(), PDO::PARAM_INT);
        $stmt->bindParam(3, $id);
        $stmt->execute();
    }

    private function createAccountData($id, $ip = 0){
        $id=(int)$id;
        $this->db->create('byxxr_accounts_data',
                array(
                    'account_id'=>$id,
                    'ip'=>$ip,
                    'register_time' => time()
                ));
    }

    /**
     * Set an ip in the database
     * @param int $id
     * @param string $ip
     */
    public function setIp($id, $ip){
        $stmt = $this->db->prepare('UPDATE byxxr_accounts_data SET ip = :ip WHERE account_id = :id');
        $stmt->bindParam('ip', $ip);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Get the 20th firsts accounts sort by votes
     * @return array
     */
    public function getVotesLadder(){
        return $this->db->queryAll('SELECT d.votes, pseudo, guid FROM byxxr_accounts_data d JOIN accounts ON d.account_id = guid ORDER BY votes DESC LIMIT 20');
    }

    public function canRegister($ip){
        $count = $this->db->count('accounts', array('lastIP'=>$ip));

        if($count >= $this->config['user']['per_ip'])
            return false;

        $stmt = $this->db->prepare('SELECT COUNT(*) FROM byxxr_accounts_data WHERE ip = :ip AND register_time > :time');
        $stmt->bindValue('ip', $ip);
        $stmt->bindValue('time', time() - ($this->config['user']['inter_register_attemps'] * 3600), PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result['COUNT(*)'] == 0;
    }

    public function createAccount($username, $pseudo, $pass, $email, $answer, $response){
        $this->db->create('accounts', array(
            'account'=>$username,
            'pseudo'=>$pseudo,
            'pass'=>$pass,
            'email'=>$email,
            'question'=>$answer,
            'reponse'=>$response,
            'lastIP'=>$_SERVER['REMOTE_ADDR']
        ));

        $id = $this->db->lastInsertId();

        $this->createAccountData($id, $_SERVER['REMOTE_ADDR']);
    }

    public function isBanIp($ip){
        return $this->db->count('banip', array('ip'=>$ip)) > 0;
    }

    public function loadAccount($id){
        return $this->db->executeFirst('SELECT * FROM accounts WHERE guid = ?', array($id));
    }

    public function addPoints($id, $points){
        $stmt = $this->db->prepare('UPDATE byxxr_accounts_data SET points = points + :p WHERE account_id = :id');
        $stmt->bindParam('p', $points, PDO::PARAM_INT);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete($guid){
        $guid = array((int)$guid);
        $this->db->execute('DELETE FROM accounts WHERE guid = ?', $guid);
        $this->db->execute('DELETE FROM byxxr_accounts_data WHERE account_id = ?', $guid);
        $this->db->execute('DELETE FROM byxxr_rigths WHERE user_id = ?', $guid);
        $this->db->execute('DELETE FROM personnages WHERE account = ?', $guid);
    }
}
