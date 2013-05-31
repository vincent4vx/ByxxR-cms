<?php
class ForumsModel extends Model{
    public function getCategoriesList(){
        return new CategoriesList(
            $this->db->queryAll('SELECT * FROM byxxr_forums WHERE parent = 0 ORDER BY rank, id')
        );
    }

    public function loadByPath(array $path){
        $path = implode('.', array_map(function($value){
                return base64_encode(urldecode($value));
            }, $path));

        $data = $this->db->executeFirst('SELECT * FROM byxxr_forums WHERE path = ?', array($path));
        $data['sub_forums'] = $this->getSubForums($data['id']);
        $data['threads'] = $this->loader->loadModel('threads')->getList($data['id']);

        return $data;
    }

    public function getSubForums($id){
        return $this->db->executeAll(
            'SELECT name FROM byxxr_forums WHERE parent = :id ORDER BY rank, id',
            array(
                'id'=>$id
        ));
    }
}

class CategoriesList implements Iterator{
    private $data;
    /**
     * @var Database
     */
    private $db;

    public function __construct(array $data){
        $this->db = Loader::getClass('Database');
        $this->data = $data;
    }

    public function key() {
        return key($this->data);
    }

    public function next() {
        return next($this->data);
    }

    public function rewind() {
        return reset($this->data);
    }

    public function current() {
        $data = current($this->data);
        $data['sub_forums'] = $this->db->executeAll(
                'SELECT name FROM byxxr_forums WHERE parent = :id ORDER BY rank, id',
                array(
                    'id'=>$data['id']
            ));

        return $data;
    }

    public function valid() {
        return isset($this->data[$this->key()]);
    }
}
