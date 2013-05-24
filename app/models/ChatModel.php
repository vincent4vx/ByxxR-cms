<?php
class ChatModel extends Model{
    public function load(){
        return $this->db->queryAll('SELECT * FROM chat ORDER BY id DESC LIMIT 20');
    }

    public function send($msg, $author, $time){
        $stmt = $this->db->prepare('INSERT INTO chat(content, author, time) VALUES(:c, :a, :t)');
        $stmt->execute(array(
            'c'=>$msg,
            'a'=>$author,
            't'=>$time
        ));
    }
}
