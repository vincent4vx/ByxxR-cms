<?php
class perso extends model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function ladderPerso($order = 'xp')
    {
        $req = $this->db->query('SELECT DISTINCT personnages.* FROM accounts, personnages WHERE personnages.account = accounts.guid AND accounts.level < 1 ORDER BY '.$order.' DESC LIMIT 20');
        return $req->fetchAll();
    }
    
    public function ladderGuilds()
    {
        $req = $this->db->query('SELECT lvl, name, xp FROM guilds ORDER BY xp DESC LIMIT 20');
        return $req->fetchAll();
    }
}
