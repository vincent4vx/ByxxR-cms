<?php
class DatabaseCache
{
    protected $default_path='cache';
    protected $db;
    
    public function __construct()
    {
	$this->db=&Loader::getClass('Database');
    }
    
    public function get($id,array &$param=array())
    {
	$data=$this->db->execQuery('SELECT * FROM '.$this->getPath($param).' WHERE id = :id', array('id'=>$id))->fetch();
	if($data===false)
	    return false;
	if($data['deletion_time']<time())
	{
	    $this->delete($id, $param);
	    return false;
	}
	
	if($data['delete_after']==true)
	    $this->delete ($id, $param);
	return @unserialize($data['data']);
    }
    
    public function set($id, &$value=null, $time=60, array &$param=array())
    {
	$path=$this->getPath($param);
	$data=array(
	    'data'=>serialize($value),
	    'deletion_time'=>$time+time(),
	    'delete_after'=>in_array('delete_after', $param),
	    'id'=>$id
	);
	$this->db->create($path, $data);
	return true;
    }
    
    public function delete($id, array &$param=array())
    {
	$this->db->delete($this->getPath($param), array('id'=>$id));
	return true;
    }
    
    protected function getPath(array &$param)
    {
	if(isset($param['path']))
	    return $param['path'];
	return $this->default_path;
    }
}
