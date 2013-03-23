<?php
interface CacheDriver{
    public function get($key, $remove = false);
    public function set($key, $data, $time = 60);
    public function delete($key);
}
