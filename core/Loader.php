<?php
class Loader{
    /**
     * All the loaded classes
     * @var array
     */
    private $classes = array();

    public function __construct() {       
        spl_autoload_register(function($class_name){
            $paths = array(CORE, CORE.strtolower($class_name).'/', CORE.'helpers/', APP.'models/');

            foreach($paths as $path){
                $file = $path.ucfirst($class_name).EXT;

                if(!file_exists($file))
                    continue;

                require_once $file;
                break;
            }

            if(!class_exists($class_name))
                exit('no class file : '.$class_name);
        });
    }

    public function preload(){
        require_once CORE.'errors/ErrorHandler'.EXT;
        ErrorHandler::init();

	require_once CORE.'MVC/BaseComponent'.EXT;
	require_once CORE.'MVC/Controller'.EXT;
	require_once CORE.'MVC/Model'.EXT;
	require_once CORE.'MVC/View'.EXT;
        require_once CORE.'helpers/I18n'.EXT;

        require_once CORE.'Output'.EXT;
        $this->load_class('Output');

        require_once CORE.'Router'.EXT;
        $this->load_class('Router');
    }

    /**
     * Add a new class in the loader
     * @param object $obj
     * @param string $name
     */
    public function add($obj, $name){
        $name = ucfirst($name);
        if(isset($this->classes[$name]))
            exit();

        $this->classes[$name] =& $obj;
    }

    /**
     * load a class
     * @param string $name
     */
    public function load_class($name){
        $name = ucfirst($name);
        $obj = new $name();
        $this->add($obj, $name);
    }

    /**
     * get an instance of $class
     * @param string $class
     * @return object
     */
    public function &get($class){
        if(!isset($this->classes[ucfirst($class)])){
            $this->load_class(ucfirst($class));
        }

        return $this->classes[ucfirst($class)];
    }

    /**
     * load the controller
     * @param string $name
     * @return mixed
     */
    public function loadController($name){
        $class = ucfirst($name).'Controller';
        $file = APP.'controllers/'.$class.EXT;

        if(!file_exists($file))
            return false;

        require_once $file;

        return $this->classes['controller'] = new $class();
    }

    /**
     * load and get a Model class
     * @param string $name
     * @return Model
     */
    public function &loadModel($name){
        $name = ucfirst($name).'Model';

        if(!isset($this->classes[$name])){
            $file = APP.'models/'.$name.EXT;

            if(!file_exists($file))
                exit('no model');

            require_once $file;

            $this->add(new $name(), $name);
        }

        return $this->classes[$name];
    }


    public function &loadForm($name){
        $name = ucfirst($name).'Form';

        if(!isset($this->classes[$name])){
            $file = APP.'forms/'.$name.EXT;

            if(!file_exists($file))
                exit('false');

            require_once $file;
            $this->add(new $name(), $name);
        }

        return $this->classes[$name];
    }
}
