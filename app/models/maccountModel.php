<?php
class maccount extends model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function accountExist($account)
    {
        $req = $this->db->prepare('SELECT COUNT(*) FROM accounts WHERE account = ?');
        $req->execute(array($account));
        $num_rows = $req->fetch();
        return $num_rows['COUNT(*)'] > 0;
    }
    
    public function pseudoExist($pseudo)
    {
        $req = $this->db->prepare('SELECT COUNT(*) FROM accounts WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $num_rows = $req->fetch();
        return $num_rows['COUNT(*)'] > 0;
    }
    
    public function createAccount($account, $pseudo, $pass, $question, $answer, $email, $level = 0)
    {
        $req = $this->db->prepare('INSERT INTO accounts(account, pass, level, email, question ,reponse, pseudo) VALUES( :account, :pass, :level, :email, :question, :reponse, :pseudo)');
        $req->execute(array(
            'account' => $account,
            'pass' => $pass,
            'pseudo' => $pseudo,
            'question' => $question,
            'reponse' => $answer,
            'level' => $level,
            'email' => $email
        ));
    }
    
    public function login($account, $pass)
    {
        $req = $this->db->prepare('SELECT guid, account, level, pseudo FROM accounts WHERE account = :account AND pass = :pass');
        $req->execute(array(
            'account' => $account,
            'pass' => $pass
        ));
        $data = $req->fetchAll();
        if(sizeof($data) !== 1)
        {
            return false;
        }else
        {
            return $data[0];
        }
    }
    
    public function getStaff($with_sa = true)
    {
        $query = 'SELECT guid, level, pseudo, avatar, infos FROM accounts WHERE level >= 1';
        if(!$with_sa)
        {
            $query .= ' AND guid <> '.$this->config['admin']['super_admin'];
        }
        $query .= ' ORDER BY level DESC';
        $req = $this->db->query($query);
        return $req->fetchAll();
    }
    
    public function changeLevel($id, $level = 0)
    {
        $req = $this->db->prepare('UPDATE accounts SET level = :level WHERE guid = :id');
        $req->execute(array(
            'level' => $level,
            'id' => $id
        ));
    }
    
    public function search($s, $admin = false)
    {
        $s = str_replace(' ', '%', $s);
        $query = 'SELECT * FROM accounts WHERE pseudo LIKE :s '.($admin ? '' : ' AND level < 1').' OR account LIKE :s '.($admin ? '' : 'AND level < 1');
        $req = $this->db->prepare($query);
        $req->execute(array(
            's' => '%'.$s.'%'
        ));
        return $req->fetchAll();
    }
    
    public function ladderVote()
    {
        $req = $this->db->query('SELECT vote, pseudo FROM accounts ORDER BY vote DESC LIMIT 20');
        return $req->fetchAll();
    }
    
    public function getAccount($id)
    {
        $req = $this->db->prepare('SELECT * FROM accounts WHERE guid = ?');
        $req->execute(array($id));
        return $req->fetch();
    }
    
    public function set($account, $var, $value = '')
    {
        if(is_array($var))
        {
            $query = 'UPDATE accounts SET ';
            foreach ($var as $col => $value)
            {
                $query .= $col.' = :'.$col.' ';
            }
            $query .= 'WHERE id = :id';
            $req = $this->db->prepare($query);
            $req->bindValue('id', $account, PDO::PARAM_INT);
            $req->execute($var);
        }else
        {
            $req = $this->db->prepare('UPDATE accounts SET '.$var.' = :value WHERE guid = :id');
            $req->execute(array(
                'value' => $value,
                'id' => $account
            ));
        }
    }
    
    public function get($account, $var, $as_array = false)
    {
        if(is_array($var))
        {
            $query = 'SELECT ';
            $query .= implode(', ', $var);
            $query .= ' FROM account WHERE guid = :id';
            $req = $this->db->prepare($query);
            $req->execute(array(
                'id' => $account
            ));
            return $req->fetch();
        }else
        {
            $req = $this->db->prepare('SELECT '.$var.' FROM accounts WHERE guid = :id');
            $req->execute(array(
                'id' => $account
            ));
            if($as_array)
            {
                return $req->fetch();
            }else
            {
                $data = $req->fetch();
                return $data[$var];
            }
        }
    }
}
