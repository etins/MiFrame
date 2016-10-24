<?php
/**
 * 入口文件
 * 1.定义常量
 * 2.加载我们的函数库
 * 3.启动框架
 */
// realpath 返回的是规范化后的绝对路径名
define('MIFrame', realpath('./'));
define('CORE', MIFrame.'/core');
define('APP', MIFrame.'/app');
define('PUBLIC', MIFrame.'/public');
define('MODULE', 'app');
define('DEBUG', true);

//composer的自动加载类
include "vendor/autoload.php";

if(DEBUG){
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

include CORE.'/common/function.php';
include CORE.'/mi.php';

spl_autoload_register('\core\mi::load');
\core\mi::run();
