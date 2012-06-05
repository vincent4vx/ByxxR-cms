<?php
class statsTable
{
    private $cache;
    private $twig;


    public function __construct($twig)
    {
	$this->twig =& $twig;
	
	global $cache;
	$this->cache =& $cache;
    }
    
    public function getStats()
    {
	if(($data = $this->cache->get('stats.html.twig', $GLOBALS['config']['cache']['stats'], '')) === false)
	{
	    
	    try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$pdo = new PDO('mysql:host='.$GLOBALS['config']['database']['host'].';dbname='.$GLOBALS['config']['database']['db_other'],
                    $GLOBALS['config']['database']['user'],
                    $GLOBALS['config']['database']['password'],
                    $pdo_options
		);
	    }catch (Exception $e)
	    {
		if(DEBUG)
		{
		    $error = 'Erreur SQL: ';
		    $error .= $e->getMessage();
		    $error .= '<br/>Ligne: '.$e->getLine();
		    exit($error);
		}else
		{
		    exit('Erreur SQL !');
		}
	    }
	    $vars = array('name' => 'stats.html.twig');
	    $vars['s_online'] = @fsockopen($GLOBALS['config']['server']['ip'], $GLOBALS['config']['server']['port']);
	    $vars['db_online'] = @fsockopen($GLOBALS['config']['database']['host'], 3306); 
	    $req = $pdo->query('SELECT COUNT(*) AS c_c FROM accounts');
	    $vars += $req->fetch();
	    $req = $pdo->query('SELECT COUNT(*) AS c_p FROM personnages');
	    $vars += $req->fetch();
	    $req = $pdo->query('SELECT COUNT(*) AS c_g FROM guilds');
	    $vars += $req->fetch();
	    $req = $pdo->query('SELECT COUNT(*) AS co FROM accounts WHERE logged = 1');
	    $vars += $req->fetch();
	    return $this->twig->render('stats.html.twig', $vars);
	}else
	{
	    return $data;
	}
    }
}
