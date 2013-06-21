<?php
class LogModel extends Model{
    public function add($type, $value, $info){
        $this->db->create('points_log', array(
            'account' => $this->session->guid,
            'type' => $type,
            'value' => $value,
            'info' => $info,
            'time' => time()
        ));
    }

    public function getByTime($account, $time){
        return $this->db->executeAll('SELECT * FROM points_log WHERE account = ? AND time >= ?', array($account, $time));
    }
}
