<?php
/**
 * User: Daniel Jin
 * Date: 2016/8/23
 * Time: 16:39
 */
namespace core\lib;
use \core\lib\config;
class log
{
    /**
     * 1.确定日志存储方式
     * 2.写日志
     */
    static $class;
    static public function init()
    {
        //确定存储方式
        $drive = config::get('DRIVE', 'log');
        $class= '\core\lib\drive\log\\' . $drive;
        self::$class = new $class;
    }

    static public function log($message, $file='log')
    {
        self::$class->log($message, $file);
    }
}