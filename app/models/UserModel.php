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

    public function loadUser($id){
        
    }

    /**
     * load an user with pass and account name
     * @param string $user
     * @param string $pass
     * @return mixed
     */
    public function loadForLogin($user, $pass){
        $data = $this->db->executeFirst('SELECT a.guid, a.level, a.pseudo, d.*, r.* FROM accounts a LEFT JOIN byxxr_accounts_data d ON d.account_id = a.guid LEFT JOIN byxxr_rigths r ON r.user_id = a.guid WHERE account = :account AND pass = :pass ', array('account'=>trim($user), 'pass'=>trim($pass)));

        if($data['ip']==''){
            $this->createAccountData($data['guid']);
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

    private function createAccountData($id){
        $id=(int)$id;
        $this->db->create('byxxr_accounts_data', array('account_id'=>$id));
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
}
