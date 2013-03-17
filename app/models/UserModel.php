<?php
class UserModel extends Model{
    public function idExist($id){
	return $this->db->count('accounts', array('guid'=>(int)$id)) > 0;
    }

    public function accountExists($account){
        return $this->db->count('accounts', array('account'=>$account));
    }

    public function loadUser($id){
        
    }

    public function login($user, $pass){
        $this->db->executeFirst('SELECT * FROM accounts WHERE account = :account AND pass = :pass JOIN byxxr_accounts_data ON account_id = guid JOIN byxxr_rigths ON user_id = guid');
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
