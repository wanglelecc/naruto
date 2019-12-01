<?php
// +----------------------------------------------------------------------
// |  
// | Config.php
// | 
// +----------------------------------------------------------------------
// | Copyright (c) https://www.56br.com/ All rights reserved.
// +----------------------------------------------------------------------
// | Author:  wll <wanglelecc@gmail.com>
// +----------------------------------------------------------------------
// | Date: 2019-12-01 20:31
// +----------------------------------------------------------------------

namespace Console;

use Console\Component\Singleton;

class Config
{
    use Singleton;

    protected static $config = [];

    /**
     * config directory
     *
     * @var string
     */
    protected $configDir = 'config';

    /**
     * Config constructor.
     */
    private function __construct()
    {
        $this->load();
    }

    /**
     * 读取配置文件
     *
     * @param $key
     * @param null $default
     *
     * @return array|mixed|null
     *
     * @author wll <wanglelecc@gmail.com>
     * @date 2019-12-01 21:29
     */
    public function get($key, $default = null)
    {
        $config = static::$config;

        foreach(explode('.', $key) as $segment){
            if( is_array($config) && array_key_exists($segment, $config) ){
                $config = $config[$segment];
            }else{
                return $default;
            }
        }

        return $config;
    }

    /**
     * 加载配置文件
     *
     * @author wll <wanglelecc@gmail.com>
     * @date 2019-12-01 21:03
     */
    protected function load()
    {
        $files = $this->scanFile($this->configDir);

        foreach ($files as $key => $file){
            static::$config[$key] = require $file;
        }
    }

    /**
     * 读取文件单层
     *
     * @param string $path
     *
     * @return array
     *
     * @author wll <wanglelecc@gmail.com>
     * @date 2019-12-01 20:37
     */
    protected function scanFile($path)
    {
        $result = [];

        $files = scandir($path);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && substr( strrchr( $file, '.' ), 1 ) == 'php') {
                if (is_dir($path . '/' . $file)) {
                    continue;
                } else {
                    $result[strstr($file, '.', true)] = $path . DIRECTORY_SEPARATOR . basename($file);
                }
            }
        }

        return $result;
    }
}