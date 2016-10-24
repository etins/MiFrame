<?php
namespace app\model;

use core\lib\model;

class studentModel extends model{
    public $table = 'student';
    public function __construct(){
        parent::__construct();
    }
    public function lists(){
        return $this->select($this->table, "*");
    }

    public function getOne($id){
        $this->get($id);
    }
}