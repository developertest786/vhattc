<?php
namespace Flywheel\Config;
use \Flywheel\Loader;
class Handler
{
    private static $_data = array();
    public static $_loaded = array();

    public static function load($alias, $namespace='default', $require = false) {

        if (isset(self::$_loaded[$alias])) {

            return self::get($namespace);
        }

        if(($path=Loader::getPathOfAlias($alias))!==false)
        {

            if (file_exists($path.'.cfg.php')) {
                $config = require($path. '.cfg.php');
                self::$_loaded[$alias] = true;
                self::add($config, $namespace);
            }
            else {
                if (true == $require)
                    throw new \Flywheel\Exception("Alias \"{$alias}\" which was loaded is invalid. Make sure it points to an existing PHP file and the file is readable.");
                else
                    return false;
            }
            return $config;
        }

        return false;
    }
    public static function set($path, $value) {
        $path = array_reverse(explode('.', $path));
        $res = array(array_shift($path) => $value);
        while(!empty($path)) {
            $next = array_shift($path);
            $res = array($next => $res);
        }
        self::$_data = array_merge_recursive(self::$_data, $res);
    }

    public static function get($path) {
        $deep = explode('.', $path);
        if (isset(self::$_data[$deep[0]])) {
            $data = self::$_data[$deep[0]];
            $i = 0;
            while ($i < (sizeof($deep)-1)) {
                ++$i;
                $data = $data[$deep[$i]];
            }
            return $data;
        }
        return null;
    }

    /**
     * check has config value
     * @param string $path
     * @return boolean
     */
    public static function has($path) {
        $path = explode('.', $path);
        $data = self::$_data;
        $i = 0;
        while ($i < (sizeof($path))) {
            if (!isset($data[$path[$i]]))
                return false;
            $data = $data[$path[$i]];
            ++$i;
        }
        return true;
    }

    /**
     * Add Config setting
     * @param array $config
     * @param string $namespace
     */
    public static function add($config, $namespace = 'default') {
        if (!isset(self::$_data[$namespace]))
            self::$_data[$namespace] = $config;
        else
            self::$_data[$namespace] = array_merge_recursive(self::$_data[$namespace], $config);
    }
}
