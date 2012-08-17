<?php
/*
 * class mère des modèles
 */
class Model extends BaseComponent
{
    
    public function __construct()
    {
	parent::__construct();
    }
    
    public function __get($name)
    {
	if($name==='db')
	    return Loader::getClass('Database', 'db');
	else
	    return parent::__get($name);
    }
}
