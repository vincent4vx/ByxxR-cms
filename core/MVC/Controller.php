<?php
/**
 * classe mère des controllers
 * @property-read Output $output The output class
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
	return $this->loader->loadModel($name);
    }
}
