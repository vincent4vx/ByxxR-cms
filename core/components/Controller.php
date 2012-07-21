<?php
/*
 * class mère des controllers
 */
class Controller extends BaseComponent
{
    public function __construct() {
	parent::__construct();
    }
    
    protected function &loadModel($name, $alias)
    {
        return Loader::getClass(ucfirst($name).'Model', $alias);
    }
}
