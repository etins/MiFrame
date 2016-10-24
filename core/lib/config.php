<?php
namespace core\lib;

class config
{
    static private $config;
    /**
     * 1.判断配置文件是否存在
     * 2.判断配置是否存在
     * 3.缓存配置
     */
    static function get($name, $file)
    {
        if (isset(self::$config[$file])){
            return self::$config[$file][$name];
        } else {
            $file = APP.'/config/'.$file.'.php';
            if (is_file($file)){
                $config = include $file;
                if(isset($config[$name])){
                    self::$config[$file] = $config;
                    return $config[$name];
                } else {
                    throw new \Exception('配置文件中无此选项'.$name);
                }
            } else {
                throw new \Exception('没有此配置文件'.$file);
            }
        }

    }

    /**
     * 加载整个配置文件
     */
    static public function all($file){
        if (isset(self::$config[$file])){
            return self::$config[$file];
        } else {
            $path = CORE . '/config/' . $file . '.php';
            if(is_file($path)){
                $config = include $path;
                self::$config[$file] = $config;
                return $config;
            } else {
                throw new \Exception('配置文件不存在'.$file);
            }
        }

    }

}