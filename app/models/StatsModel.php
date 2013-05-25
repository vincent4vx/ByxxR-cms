<?php
class StatsModel extends Model{
    public function globalStats(){
        $return = array(
            'accounts' => $this->db->count('accounts'),
            'characters' => $this->db->count('personnages'),
            'online' => $this->db->count('accounts', array('logged'=>1)),
            'state' => fsockopen($this->config['server']['ip'], $this->config['server']['port'], $errno, $errstr, 0.1)
        );

        $r = $this->db->queryFirst('SELECT AVG(level) FROM personnages');
        $return['lvl_moy'] = $r['AVG(level)'];

        $r = $this->db->queryFirst('SELECT name FROM personnages p JOIN accounts a ON a.guid = p.account WHERE a.level = 0 ORDER BY xp DESC LIMIT 1');
        $return['leader'] = $r['name'];

        return $return;
    }
}
