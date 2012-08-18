<?php
class FileCache
{
    private $default_path='data';
    
    const EXT='.cache';
    const DIR='core/cache/data/';

    public function get($id, array &$param=array())
    {
	$path=$this->getPath($param);
	
	if(!file_exists($path.$id.self::EXT))
	    return false;
	
	$data=@unserialize(@file_get_contents($path.$id.self::EXT));
	
	if($data===false)
	    return false;
	
	if($data['deletion_time']>=time())
	{
	    $this->delete($id, $param);
	    return false;
	}
	
	if(in_array('delete_after', $param) or in_array('delete_after', $data))
	    $this->delete($id, $param);
	
	return $data['value'];
    }
    
    public function set($id, &$value=null, $time=60, array &$param=array())
    {
	$data=$param;
	$data['deletion_time']=$time+time();
	$data['value']=$value;
	
	$path=$this->getPath($param);
	
	@mkdir($path, 0777, true);
	
	return @file_put_contents($path.$id.self::EXT, serialize($data));
    }
    
    public function delete($id, array &$param=array())
    {
	$path=$this->getPath($param);
	
	return @unlink($path.$id.self::EXT);
    }
    
    private function getPath(array &$param)
    {
	if(!isset($param['path']))
	    return BASE.self::DIR.$this->default_path.'/';
	else
	    return BASE.self::DIR.$param['path'].'/';
    }
}
