<?php
class Cache
{
    private $_drivers=array();
    private static $default_driver='file';

    public function __construct() {
        Core::get_instance()->loader->addIncludePath(__DIR__.'/drivers/');
    }

    /**
     * load the driver
     * @param string $key
     * @return CacheDriver
     */
    private function getDriver($key){
	$data = explode(':', $key);

        if(count($data)<2)
            $class = ucfirst(self::$default_driver).'Cache';
        else
            $class = ucfirst($data[0]).'Cache';

        if(isset($this->_drivers[$class]))
            return $this->_drivers[$class];

        return $this->_drivers[$class] = new $class();
    }

    /**
     * Get a data in cache
     * @param string $key
     * @param bool $remove remove after read
     * @return mixed
     */
    public function get($key, $remove = false){
        return $this->getDriver($key)->get($key, $remove);
    }

    /**
     * Store some data in the cache
     * @param string $key
     * @param mixed $data
     * @param int $time the store time
     * @return bool
     */
    public function set($key, $data=null, $time=60){
	return $this->getDriver($key)->set($key, $data, $time);
    }

    /**
     * Delete a cache data
     * @param string $key
     * @return bool
     */
    public function delete($key){
	return $this->getDriver($key)->delete($key);
    }
}
