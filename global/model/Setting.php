<?php 
/**
 * Setting
 *  This class has been auto-generated at 03/01/2013 17:20:43
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/SettingBase.php';
class Setting extends \SettingBase {

    static $loaded = false;
    static $pool = array();

    public static function load()
    {
        $data = self::findAll();
        if ($data) {
            foreach($data as $d) {
                /* @var Setting $d */
                $d->key = strtoupper($d->key);
                switch (strtoupper($d->format)) {
                    case 'TEXT' :
                        self::$pool[$d->key] = (string) $d->text_value;
                        break;
                    case 'NUMBER' :
                        self::$pool[$d->key] = $d->number_value;
                        break;
                    case 'BOOLEAN' :
                        self::$pool[$d->key] = (boolean) $d->bool_value;
                }
            }
        }

        self::$loaded = true;
    }

    public static function get($key) {
        if (!self::$loaded) {
            self::load();
        }
        return isset(self::$pool[$key])? self::$pool[$key] : null;
    }
}