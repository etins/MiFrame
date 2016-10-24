<?php
namespace core;

/**
 * 1.加载日志类
 * 2.路由解析
 * 3.执行响应的控制器和方法
 */
class mi
{
    static public $classMap = array();
    static public function run()
    {
        \core\lib\log::init();
        \core\lib\log::log($_SERVER);
        $route = new \core\lib\route();
        $controllerClass = $route->controller;
        $action = $route->action;
        $controllerFile = APP.'/controllers/'.$controllerClass.'controller.php';
        $controllerClass = '\\' . MODULE . '\\controllers\\'.$controllerClass.'Controller';
        if (is_file($controllerFile)){
            $controller = new $controllerClass;
            $controller->$action();
        } else {
            throw new \Exception('找不到控制器'.$controllerClass);
        }
    }
    static public function load($class)
    {
        if (isset(self::$classMap[$class])){
            return true;
        } else {
            $class = str_replace('\\', '/', $class);
            $file = MIFrame.'/'.$class.'.php';
            if (is_file($file)){
                include $file;
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }

    /**
     * $file 文件名
     * $arr 数组名（键值对的形式）
     */
    public function render($file, $arr=array())
    {
        $loader = new \Twig_Loader_Filesystem(APP.'/views');
        $twig = new \Twig_Environment($loader, array(
            'cache' => APP.'/runtime/cache',
        ));
        echo $twig->render($file, $arr);
    }
}