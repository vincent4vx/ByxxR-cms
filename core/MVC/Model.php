<?php
/**
 * class mère des modèles
 * @property-read Output $output The output class
 * @property-read Database $db alias of $database
 * @property-read Database $database the Database instance
 */
class Model extends BaseComponent
{   
    public function __construct()
    {
	parent::__construct();
    }
    
    public function __get($name) {
	if($name==='db')
	    return $this->loader->get('Database');
	return parent::__get($name);
    }
}
