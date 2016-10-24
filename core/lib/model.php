<?php
namespace core\lib;

class model extends \medoo{
    public function __construct()
    {
        $option = config::all('database');
        parent::__construct($option);
    }

}