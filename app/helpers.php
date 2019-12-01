<?php
// +----------------------------------------------------------------------
// |  
// | helpers.php
// | 
// +----------------------------------------------------------------------
// | Copyright (c) https://www.56br.com/ All rights reserved.
// +----------------------------------------------------------------------
// | Author:  wll <wanglelecc@gmail.com>
// +----------------------------------------------------------------------
// | Date: 2019-12-01 21:33
// +----------------------------------------------------------------------

use Console\Config;

if( !function_exists("config") )
{
    /**
     * 获取配置文件
     *
     * @param $key
     * @param null $default
     *
     * @return array|mixed|null
     *
     * @author wll <wanglelecc@gmail.com>
     * @date 2019-12-01 21:34
     */
    function config($key, $default = null){
        return Config::getInstance()->get($key, $default);
    }
}