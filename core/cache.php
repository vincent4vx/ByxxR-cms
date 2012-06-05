<?php
class cache
{
    protected $config;
    protected $cachePath;
    
    public function __construct()
    {
	$this->config =& $GLOBALS['config']['cache'];
	$this->cachePath = CORE.'cache/pages/';
    }
    
    public function get($name, $time, $id)
    {
	if($this->config['driver'] === 'file')
	{
	    $filename = $this->cachePath.$name.$id.'.cache';
	    if(file_exists($filename))
	    {
		if((filemtime($filename) + $time) >= time() and !DEBUG)
		{
		    return file_get_contents($filename);
		}else
		{
		    unlink($filename);
		    return false;
		}
	    }else
	    {
		return false;
	    }
	}elseif($this->config['driver'] === 'apc')
        {
            if(apc_exists($name.$id))
            {
                if((apc_fetch($name.$id.'-age') + $time) >= time() and !DEBUG)
                {
		    return apc_fetch($name.$id);
                }else
                {
                    apc_delete($name.$id);
                    apc_delete($name.$id.'-age');
                    return false;
                }
            }else
            {
                return false;
            }
        }else
        {
            return false;
        }
    }
    
    public static function save($data, $name)
    {
	$filename = CORE.'cache/pages/'.$name.'.cache';
	file_put_contents($filename, $data);
	return $data;
    }

    public function purge()
    {
	$return = array();
	$dir = scandir($this->cachePath);
	foreach ($dir as $row)
	{
	    if($row == '.' or $row == '..')
	    {
		continue;
	    }elseif(is_dir($this->cachePath.$row))
	    {
		$local_dir = scandir($this->cachePath.$row);
		foreach ($local_dir as $local_row)
		{
		    if(is_file($this->cachePath.$row.'/'.$local_row))
		    {
			unlink($this->cachePath.$row.'/'.$local_row);
			$return[] = 'fichier : '.$row.'/'.$local_row.' supprimé !';
		    }else
		    {
			continue;
		    }
		}
	    }
	}
	return $return;
    }
    
    public function delete($file)
    {
	if(file_exists($this->cachePath.$file.'.cache'))
	{
	    unlink($this->cachePath.$file.'.cache');
	}else
	{
	    return false;
	}
    }
    
    public function purgeDir($dir)
    {
	$files = scandir($this->cachePath.$dir);
	foreach ($files as $file)
	{
	    if(is_file($this->cachePath.$dir.'/'.$file))
	    {
		unlink($this->cachePath.$dir.'/'.$file);
		echo 'fichier '.$file.' supprimé !';
	    }else
	    {
		continue;
	    }
	}
    }
}
