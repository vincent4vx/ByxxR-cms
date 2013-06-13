<?php
class ChatModel extends Model{
    private $sqlite;

    public function __construct() {
        parent::__construct();
        $db = APP.'chat.db';
        try{
            $create = false;
            if(!file_exists($db))
                $create = true;
            
            $this->sqlite = new PDO('sqlite:'.$db);
            if($create)
                $this->createTable();
        }catch(Exception $e){
            throw new BException('Erreur SQLite : '.$e->getMessage());
        }
    }

    private function createTable(){
        $this->sqlite->exec('CREATE TABLE chat (
                id INTEGER AUTO_INCREMENT,
                author VARCHAR(255) NOT NULL,
                content VARCHAR(255) NOT NULL,
                time INTEGER NOT NULL,
                PRIMARY KEY (id)
        )');
    }

    public function load(){
        return $this->sqlite->query('SELECT * FROM chat ORDER BY id DESC LIMIT 20')->fetchAll();
    }

    public function add($msg, $author, $time){
        $stmt = $this->sqlite->prepare('INSERT INTO chat(content, author, time) VALUES(:c, :a, :t)');
        $stmt->execute(array(
            'c'=>$msg,
            'a'=>$author,
            't'=>$time
        ));
    }

    public function clear(){
        $this->sqlite->exec('DELETE FROM chat');
    }
}
