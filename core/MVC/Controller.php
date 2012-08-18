<?php
/*
 * class mère des controllers
 */
class Controller extends BaseComponent
{
    public function __construct() {
	parent::__construct();
    }
    
    protected function &helper($name)
    {
	return Loader::getClass(ucfirst($name), CORE.'helpers/');
    }
    
    protected function &model($name)
    {
	return Loader::getClass(ucfirst($name).'Model', APP.'models/');
    }
}
