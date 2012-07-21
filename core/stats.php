<?php
class statsTable
{
    private $cache;
    private $twig;


    public function __construct()
    {
	$this->twig =& Loader::getClass('twig');
	$this->cache=&Loader::getClass('Cache');
    }
    
    public function getStats()
    {
	if(($data = $this->cache->get('stats.html.twig', Core::$config['cache']['stats'], '')) === false)
	{
	    
	    $pdo=&Loader::getClass('Database');
	    $vars = array('name' => 'stats.html.twig');
	    $vars['s_online'] = @fsockopen(Core::$config['server']['ip'], Core::$config['server']['port']);
	    $vars['db_online'] = @fsockopen(Core::$config['database']['host'], 3306); 
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
