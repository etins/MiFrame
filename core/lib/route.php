<?php
namespace core\lib;

class route
{
    public $controller;
    public $action;
    public function __construct()
    {
        // xxx/com/index/index
        // xxx/com/index.php/index/index
        /*
         * 1.隐藏index.php
         * 2.获取到URL中参数部分
         * 3.返回对应控制器和方法
         */
        if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/'){
            // /index/index
            $path = $_SERVER['PATH_INFO'];
            $patharr = explode('/',trim($path, '/'));
            if (isset($patharr[0])){
                $this->controller = $patharr[0];
                unset($patharr[0]);
            }
            if (isset($patharr[1])){
                $this->action = $patharr[1];
                unset($patharr[1]);
            } else {
                $this->action = config::get('ACTION', 'route');
            }
            // 把URL的多余部分转换成 GET参数
            // index/index/id/1/str/2
            $count = count($patharr) + 2;
            $i = 2;
            while ($i < $count){
                if (isset($patharr[$i+1])){
                    $_GET[$patharr[$i]] = $patharr[$i+1];
                }
                $i += 2;
            }
        } else {
            $this->controller = config::get('CONTROLLER', 'route');
            $this->action = config::get('ACTION', 'route');
        }
    }
}