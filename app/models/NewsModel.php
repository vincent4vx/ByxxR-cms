<?php
class NewsModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get($page)
    {
        if($page<1)
            $page=1;
	return $this->db->selectAll('news', '*', array(), 'ORDER BY id DESC LIMIT '.(($page-1)*$this->config['news_per_page']).', '.$this->config['news_per_page']);
    }

    public function getList(){
        return $this->db->queryAll('SELECT id, title, author, type FROM news ORDER BY id DESC');
    }
    
    public function selectAll()
    {
        return $this->db->queryAll('SELECT * FROM news ORDER BY id DESC');
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
    
    public function create($type, $title, $content, $author)
    {
        $this->db->create('news', array(
            'type' => $type,
            'title' => $title,
            'content' => $content,
            'author' => $author,
            'date' => time()
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
        return $this->db->count('news');
    }
}
