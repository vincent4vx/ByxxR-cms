<?php
class ApcCache
{
    protected $default_path='';
    
    public function get($id, &$param=array())
    {
	$data=apc_fetch($this->getPath($param).$id);
	if($data===false)
	    return false;
	
	if(in_array('delete_after', $data['param']) or in_array('delete_after', $param))
	    $this->delete($id, $param);
	
	return $data['value'];
    }
    
    public function set($id, &$value=null, $time=60, &$param=array())
    {
	$var=array('param'=>$param, 'value'=>$value);
	return apc_store($this->getPath($param).$id, $var, $time);
    }
    
    public function delete($id, array &$param)
    {
	return apc_delete($this->getPath($param).$id);
    }
    
    protected function getPath(array &$param)
    {
	if(isset($param['path']))
	    return $param['path'].'/';
	return $this->default_path.'/';
    }
}
