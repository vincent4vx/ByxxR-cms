<?php
class Loader{
    /**
     * All the loaded classes
     * @var array
     */
    private $classes = array();
    /**
     * The include path
     * @var array
     */
    private $include_path;

    public function __construct() {
        $this->include_path = array(CORE, CORE.'helpers/', APP.'models/', BASE.'lib/');
        
        spl_autoload_register(function($class_name){
            $paths = $this->include_path;
            $paths[] = CORE.strtolower($class_name).'/';

            foreach($paths as $path){
                $file = $path.ucfirst($class_name).EXT;

                if(!file_exists($file))
                    continue;

                require $file;
                break;
            }

            if(!class_exists($class_name, false) && !interface_exists($class_name, false))
                exit('no class file : '.$class_name);
        });
    }

    public function preload(){
        require CORE.'errors/ErrorHandler'.EXT;
        ErrorHandler::init();

	require CORE.'MVC/BaseComponent'.EXT;
	require CORE.'MVC/Controller'.EXT;
	require CORE.'MVC/Model'.EXT;
	require CORE.'MVC/View'.EXT;
        require CORE.'helpers/I18n'.EXT;

        require CORE.'Output'.EXT;
        $this->load_class('Output');

        require CORE.'Router'.EXT;
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

        if(isset($this->classes[$name]))
            exit();
        
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
            $this->load_class($class);
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

        require $file;

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

            require $file;

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

            require $file;
            $this->add(new $name(), $name);
        }

        return $this->classes[$name];
    }

    /**
     * add a path in the include path for lazyloading
     * @param string $path
     */
    public function addIncludePath($path){
        $this->include_path[] = $path;
    }
}
