<?php
/*
 * class mère des modèles
 */
class Model
{
    protected $db;
    protected $config;
    
    public function __construct($db = 'db_other') {
        $this->config =& $GLOBALS['config'];
        
        try{
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $this->db = new PDO('mysql:host='.$this->config['database']['host'].';dbname='.$this->config['database'][$db],
                    $this->config['database']['user'],
                    $this->config['database']['password'],
                    $pdo_options
            );
        }catch (Exception $e)
        {
            if(DEBUG)
            {
                $error = 'Erreur SQL: ';
                $error .= $e->getMessage();
                $error .= '<br/>Ligne: '.$e->getLine();
                $error .= '<br/><br/><h1>Code:</h1>'.$e->getCode();
                exit($error);
            }else
            {
                exit('Erreur SQL !');
            }
        }
    }
}
