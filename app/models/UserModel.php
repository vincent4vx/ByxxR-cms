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
        return $this->db->executeFirst('SELECT a.guid, a.level, a.pseudo, d.*, r.* FROM accounts a LEFT JOIN byxxr_accounts_data d ON d.account_id = a.guid LEFT JOIN byxxr_rigths r ON r.user_id = a.guid WHERE account = :account AND pass = :pass ', array('account'=>trim($user), 'pass'=>trim($pass)));
    }

    public function getStaff($with_sa = true)
    {
        $query = 'SELECT a.guid, a.level, a.pseudo, d.avatar, d.info FROM accounts a LEFT JOIN byxxr_accounts_data d ON d.account_id = a.guid WHERE a.level >= 1';
        if(!$with_sa)
        {
            $query .= ' AND guid <> '.$this->config['admin']['super_admin'];
        }
        $query .= ' ORDER BY a.level DESC';
        $req = $this->database->query($query);
        return $req->fetchAll();
    }
}
