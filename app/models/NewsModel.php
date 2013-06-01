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
    
    public function delete($id)
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
    
    public function getById($id){
        return $this->db->selectFirst('news', '*', array('id'=>$id));
    }

    public function update($id, $title, $type, $content){
        $stmt = $this->db->prepare('UPDATE news SET title = :title, type = :type, content = :content WHERE id = :id');
        $stmt->execute(array(
            'id' => (int)$id,
            'title' => trim($title),
            'type' => (int)$type,
            'content' => trim($content)
        ));
    }
    
    public function num()
    {
        return $this->db->count('news');
    }
}
