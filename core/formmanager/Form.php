<?php
abstract class Form
{
    public abstract function rows();
    
    public function labels()
    {
	return array();
    }
}
