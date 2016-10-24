<?php

class controller
{
    private $assign = array();
    public function __construct()
    {

    }
    public function assign($name, $value)
    {
        $this->assign[$name] = $value;
    }
    public function display($file)
    {
        $file = APP.'/views/'.$file;
        if (is_file($file)){
            extract($this->assign);
            include $file;
        }
    }
}