<?php
class NewsModel extends model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function selectAll()
    {
        $req = $this->db->query('SELECT * FROM news ORDER BY id DESC');
        return $req->fetchAll();
    }
    
    public function selectLimit($start, $num)
    {
        $req = $this->db->prepare('SELECT * FROM news ORDER BY id DESC LIMIT :start, :num');
        $req->bindValue(':start', $start, PDO::PARAM_INT);
        $req->bindValue('num', $num, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }
    
    public function deletenew($id)
    {
        $req = $this->db->prepare('DELETE FROM news WHERE id = ?');
        $req->execute(array($id));
    }
    
    public function addnew($type,$title,$new, $autor)
    {
        $req = $this->db->prepare('INSERT INTO news(titre,text,auteur,type) VALUES(:title , :text, :autor, :type)');
        $req->execute(array(
            'type' => $type,
            'title' => $title,
            'text' => $new,
            'autor' => $autor
        ));
    }
    
    public function getnew($id)
    {
        $req = $this->db->prepare('SELECT * FROM news WHERE id = ?');
        $req-> execute(array($id));
        return $req->fetch();
    }
    
    public function changenew($id,$type,$title,$new)
    {
        $req = $this->db->prepare('UPDATE news SET titre = :title, text = :message,type = :type WHERE id = :id');
        return $req->execute(array(
            'id' => $id,
            'type' => $type,
            'title' => $title,
            'message' => $new
        ));
    }
    
    public function num()
    {
        $req = $this->db->query('SELECT COUNT(*) FROM news');
        $num = $req->fetch();
        return $num['COUNT(*)'];
    }
}
