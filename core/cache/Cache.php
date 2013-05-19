<?php
class Cache
{
    public function get($key, $remove = false){
        $file = $this->getFileName($key);

        if(!file_exists($file))
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

        return unlink($file);
    }

    public function set($key, $data, $time = 60){
        $file = $this->getFileName($key);

        $data = array(
            'deletion_time'=>time()+$time,
            'data'=>$data
        );

        if(!is_dir(dirname($file)))
            mkdir(dirname($file), 0777, true);

        return file_put_contents($file, serialize($data));
    }

    private static function getFileName($key){
        $file = CORE.'cache/data/';
        $file.=str_replace('.', DIRECTORY_SEPARATOR, $key);
        $file.='.cache';

        return $file;
    }
}
