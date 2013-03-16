<?php
class Loader{
    /**
     * All the loaded classes
     * @var array
     */
    private $classes = array();

    public function __construct() {
        $this->preload();
        
        spl_autoload_register(function($class_name){
            $paths = array(CORE, CORE.strtolower($class_name).'/', CORE.'helpers/');

            foreach($paths as $path){
                $file = $path.ucfirst($class_name).EXT;

                if(!file_exists($file))
                    continue;

                require_once $file;
                break;
            }
        });
    }

    private function preload(){
        require_once CORE.'errors/ErrorHandler'.EXT;
        ErrorHandler::init();
    }

    /**
     * Add a new class in the loader
     * @param object $obj
     * @param string $name
     */
    public function add($obj, $name){
        $name = strtolower($name);
        if(isset($this->classes[$name]))
            exit();

        $this->classes[$name] =& $obj;
    }

    /**
     * load a class
     * @param string $name
     */
    public function load_class($name){
        $obj = new $name();
        $this->add($obj, strtolower($name));
    }

    /**
     * get an instance of $class
     * @param string $class
     * @return object
     */
    public function get($class){
        if(!isset($this->classes[strtolower($class)])){
            $this->load_class(ucfirst($class));
        }

        return $this->classes[strtolower($class)];
    }
}
