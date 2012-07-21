<?php
class Database extends PDO
{
    protected $_config;
    public static $num_req=0;


    public function __construct()
    {
	try{
	    $pdo_options=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	    $this->_config=&Core::$config['database'];
	    parent::__construct('mysql:host='.$this->_config['host'].';dbname='.$this->_config['db_other'], $this->_config['user'], $this->_config['password'], $pdo_options);
	}catch(Exception $e)
	{
	    exit($e->getMessage());
	}
    }
    
    public function query($statement)
    {
	try{
	    self::$num_req++;
	    return parent::query($statement);
	}catch(Exception $e)
	{
	    exit('PDO error :<br/>'.$e->getFile().' ligne : '.$e->getLine().'<br/>'.$e->getMessage());
	}
    }
    
    public function prepare($statement, $driver_options = array())
    {
	try{
	    self::$num_req++;
	    return parent::prepare($statement, $driver_options);
	}catch(Exception $e)
	{
	    exit('PDO error :<br/>'.$e->getFile().' ligne : '.$e->getLine().'<br/>'.$e->getMessage());
	}
    }


    public function &execQuery($query, &$param)
    {
	try{
	    $req = $this->prepare($query);
	    $req->execute($param);
	    return $req;
	}catch(Exception $e)
	{
	    exit('PDO error :<br/>'.$e->getFile().' ligne : '.$e->getLine().'<br/>'.$e->getMessage());
	}
    }


    public function selectAll($table)
    {
	$data = $this->query('SELECT * FROM `'.$table.'`');
	return $data->fetchAll();
    }
    
    public function countAll($table)
    {
	$data = $this->query('SELECT COUNT(*) FROM `'.$table.'`');
	$array=$data->fetch();
	return $array['COUNT(*)'];
    }
    
    public function delete($table, array &$cond)
    {
	$query='DELETE FROM `'.$table.'` WHERE ';
	foreach($cond as $col => $value)
	    $query.=$col.' = :'.$col.' ';
	return $this->execQuery($query, $cond);
    }
    
    public function create($table, array $values)
    {
	$query='INSERT INTO '.$table.'(';
	$cols=array_keys($values);
	$query.=implode(',', $cols).') VALUES (:';
	$query.=implode(', :', $cols).')';
	return $this->execQuery($query, $values);
    }
    
    public function select($table, array $selected, array $cond, $all=false)
    {
	$query='SELECT '.implode(',', $selected).' FROM `'.$table.'` WHERE ';
	foreach(array_keys($cond) as $col)
	    $query.=$col.' = :'.$col.' ';
	if($all)
	    return $this->execQuery($query, $cond)->fetchAll();	
	return $this->execQuery($query, $cond)->fetch();
    }
    
    public function findAll($table, array $cond)
    {
	return $this->select($table, array('*'), $cond, true);
    }
    
    public function find($table, array $cond)
    {
	return $this->select($table, array('*'), $cond);
    }


    public function exist($table, array $cond)
    {
	$data=$this->select($table, 'COUNT(*)', $cond);
	return $data['COUNT(*)'] > 0;
    }
    
    public function changeDb($dbname)
    {
	$this->query('USE '.$dbname);
    }
}
