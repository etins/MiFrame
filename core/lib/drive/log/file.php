<?php
/**
 * desc: 日志写到文件系统中
 */
namespace core\lib\drive\log;
use core\lib\config;

class file
{

    public $path;
    public function __construct()
    {
        $conf = config::get('OPTION', 'log');
        $this->path = $conf['PATH'];
    }
    public function log($message, $file)
     {
        /**
         * 1. 确定文件存储位置是否存在
         *    新建目录
         * 2. 写入目录
         */
        $path = $this->path;
        $path = str_replace('\\', '/', $path);
        $path .= date('YmdH');
        if (!is_dir($path)){
            mkdir($path, '0777', true);
        }
        $message = date('Y-m-d H:i:s').'--'.json_encode($message);
        return file_put_contents($path.'/'.$file.'.php', $message.PHP_EOL, FILE_APPEND);
    }
}