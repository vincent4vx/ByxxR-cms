<?php
class FileCache implements CacheDriver
{
    public function get($key, $remove = false){
        $file = $this->getFileName($key);
        
        if(!$file)
            return null;

        $file_data = unserialize(file_get_contents($file));

        if(!is_array($file_data))
            throw new BException('Fichier de cache <b>%s</b> corrompu !', array($file));

        if($file_data['deletion_time'] < time()){
            unlink($file);
            return null;
        }

        if($remove)
            unlink($file);

        return $file_data['data'];
    }

    public function delete($key){
        $file = $this->getFileName($key);

        if(!$file)
            return false;

        return unlink($file);
    }

    public function set($key, $data, $time = 60){
        $file = $this->getFileName($key, false);

        $data = array(
            'deletion_time'=>time()+$time,
            'data'=>$data
        );

        $path = substr($file, 0, strrpos($file, DIRECTORY_SEPARATOR));

        if(!is_dir($path))
            mkdir($path, 0777, true);
        
        return file_put_contents($file, serialize($data));
    }

    private static function getFileName($key, $test = true){
        $key = substr(strstr($key, ':'), 1);
        $file = CORE.'cache/data/';
        $file.=str_replace('.', DIRECTORY_SEPARATOR, $key);
        $file.='.cache';

        if($test && !file_exists($file))
            return false;

        return $file;
    }
}
