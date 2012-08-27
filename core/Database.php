<?php
class Database extends PDO
{
    protected $_config;
    public $lastQuery='';
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
    
    /*
     * Fonctions PDO
     */
    
    public function query($statement)
    {
	try{
	    self::$num_req++;
	    $this->lastQuery=$statement;
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
	    $this->lastQuery=$statement;
	    return parent::prepare($statement, $driver_options);
	}catch(Exception $e)
	{
	    exit('PDO error :<br/>'.$e->getFile().' ligne : '.$e->getLine().'<br/>'.$e->getMessage());
	}
    }
    
    public function exec($statement) {
	try{
	    self::$num_req++;
	    $this->lastQuery=$statement;
	    parent::exec($statement);
	}catch(Exception $e)
	{
	    exit($e);
	}
    }


    /*
     * fonctions raccourcies
     * all-in-one pour query / prepare
     */
    
    /**
     * Execute and return all value of a query
     * 
     * Use PDO::query for exectute the query and
     * PDOStatement::fetchAll() to return and array
     * with all result
     * 
     * @param string $query the query that we want to execute
     * 
     * @return array the result of the query
     */
    public function queryAll($query)
    {
	return $this->query($query)->fetchAll();
    }
        
    /**
     * Execute and return the first value of a query
     * 
     * Use PDO::query for exectute the query and
     * PDOStatement::fetch() to return and array
     * with the first result
     * 
     * @param string $query the query that we want to execute
     * 
     * @return array the result of the query
     */
    public function queryFirst($query)
    {
	return $this->query($query)->fetch();
    }
    
    /**
     * Prepare and execute a query
     * 
     * Use PDO::prepare to prepare the query and
     * PDOStatement::execute to execute query with the 
     * params
     * 
     * @param string $query The query that we want to execute
     * @param array $param The parameters
     * 
     * @return PDOStatement
     */
    public function &execute($query, array &$param=array())
    {
	try{
	    $statement=$this->prepare($query);
	    $statement->execute($param);
	    return $statement;
	}catch(Exception $e)
	{
	    exit('PDO error :<br/>'.$e->getFile().' ligne : '.$e->getLine().'<br/>'.$e->getMessage());
	}
    }
    
    /**
     * Use Database::execute and return all result to array
     * 
     * @param string $query The query that we want to execute
     * @param array $param The parameters
     * @return array The list of affected rows
     */
    public function executeAll($query, array $param=array())
    {
	return $this->execute($query, $param)->fetchAll();
    }
    
    /**
     * Use Database::execute and return the first affected row
     * 
     * @param string $query The query that we want to execute
     * @param array $param The parameters
     * @return array The first affected row
     */
    public function executeFirst($query, array $param=array())
    {
	return $this->execute($query, $param)->fetch();
    }
    
    /*
     * Fonctions de générations de requêtes
     */
    
    /**
     * Select generator
     * 
     * Select All the affected rows
     * 
     * @param string $table table name
     * @param string $vars the list of column
     * @param array $requirement An array of requirements form column => value
     * @param string $other The other sql operations (LIMIT, ORDER...)
     * @return array The array with all affected rows
     */
    public function selectAll($table, $vars='*', array $requirement=array(), $other='')
    {
	$query='SELECT '.$vars.' FROM '.$table;
	if($requirement!==array())
	    $query.=$this->whereBuilder($requirement);
	$query.=' '.$other;
	return $this->executeAll($query, $requirement);
    }
    
    /**
     * Select generator
     * 
     * Select the first affected row
     * 
     * @param string $table table name
     * @param string $vars the list of column
     * @param array $requirement An array of requirements form column => value
     * @param string $other The other sql operations (LIMIT, ORDER...)
     * @return array The first affected row
     */
    public function selectFirst($table, $vars='*', array $requirement=array(), $other='')
    {
	$query='SELECT '.$vars.' FROM '.$table;
	if($requirement!==array())
	    $query.=$this->whereBuilder($requirement);
	$query.=' '.$other;
	
	return $this->executeFirst($query, $requirement);
    }
    
    /**
     * Return the number of rows
     * 
     * @param string $table the table name
     * @param array $requirements An array of requirements form column => value
     * @return int The num of rows
     */
    public function count($table, array $requirements=array())
    {
	$data=$this->selectFirst($table, 'COUNT(*)', $requirements);
	return intval($data['COUNT(*)']);
    }
    
    public function delete($table, array $requirements=array())
    {
	$where='';
	if($requirements!==array())
	    $where=$this->whereBuilder($requirements);
	return $this->execute('DELETE FROM '.$table.$where, $requirements);
    }
    
    public function create($table, array $value=array())
    {
	$col=array_keys($value);
	$query='INSERT INTO '.$table.'('.implode(', ', $col).') VALUES (:'.implode(', :', $col).')';
	$this->execute($query, $value);
    }
    
    /**
     * Change the database
     * 
     * @param string $dbname 
     */
    public function change_db($dbname)
    {
	$this->exec('USE '.$dbname);
    }



    
    /**
     * Create the query requirement for PDO::prepare
     * 
     * @param array $requirements
     * @return string 
     */
    protected function whereBuilder(array &$requirements)
    {
	$query=' WHERE ';
	$rows=array();
	foreach(array_keys($requirements) as $col)
	    $rows[]=$col.' = :'.$col;
	$query.=implode(' AND ', $rows);
	return $query;
    }
}
