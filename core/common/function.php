<?php

function p($var)
{
    if (is_bool($var)){
        var_dump($var);
    } else if (is_null($var)){
        var_dump(NULL);
    } else {
        echo "<pre style='position: relative;z-index: 1000;padding: 10px;
border-radius: 5px;background: #F5F5F5;border: 1px solid #aaa; font-size: 14px;
    line-hight:18px; opacity:0.9;'>" . print_r($var, true) . "</pre>";
    }
}

/**
 * @param $name
 * @param $default
 * @param $filter
 */
function post($name, $default=false, $filter=false)
{
    if (isset($_POST[$name])){
        if ($filter){
            switch ($filter){
                case 'int':
                    if (is_numeric($_POST[$name])){
                        return $_POST['name'];
                    }
                    return $default;
                break;
            }
        } else {
            return $_POST['name'];
        }
    } else {
        return $default;
    }
}

/**
 * 跳转函数
 */
function redirect($url)
{
    header("Location: http://www.example.com/");
}
/**
 * 拿到base_url();
 */
function baseUrl()
{
    //http://www.case.com//MiFrame/index.php/index/index
    return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
}

/**
 * @param $str 'index/index'
 * @return $url baseUrl().APP.'index.php/index/index'.
 * 拿到要跳转的site_url()
 */
function siteUrl($str=null)
{
    if (empty($str)){
        throw new \Exception('siteUrl中参数不能为空');
    }
    $arr = explode('/', $str);
    $params = '';
    foreach ($arr as $key => $val) {
        $params .= '/'.$val;
    }
    return baseUrl().$_SERVER['SCRIPT_NAME'].$params.'/';
}

/**
 * 拿到public的url
 */
function getAsset()
{
    $assetUrl = baseUrl().$_SERVER['SCRIPT_NAME'];
    $index = strrpos($assetUrl, '/');
    return substr($assetUrl, 0, $index).'/public';
}

/**
 * 拿到项目名称
 */
function getProjectName()
{
    $index = strrpos(MIFrame, '\\') + 1;
    return substr(MIFrame, $index);
}

/**
 * 在页面中包含view文件
 */
function includeView($file)
{
    $file = APP.'/views/'.$file;
    if( is_file($file) ){
        include $file;
    }
}

?>


