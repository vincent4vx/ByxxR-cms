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
}
