<?php
abstract class Form
{
    public abstract function rows();
    public abstract function url();

    public function labels()
    {
	return array();
    }
}
