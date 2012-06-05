<?php
class stats extends model
{
    public function __construct($db = 'db_other')
    {
	parent::__construct($db);
    }
    
    public function getStats()
    {
	$req = $this->db->query('SELECT COUNT(*) AS c_p FROM personnages UNION SELECT COUNT(*) AS c_c FROM accounts UNION SELECT COUNT(*) AS c_g FROM guilds UNION SELECT COUNT(*) AS co FROM accounts WHERE logged = 1');
	return $req->fetch();
    }
}
