<?php 
/**
 * Modules
 *  This class has been auto-generated at 03/01/2013 18:04:52
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/ModulesBase.php';
class Modules extends \ModulesBase {
    /**
     * @param $pk
     * @return bool|Modules
     */
    public static function retrieveByPk($pk)
    {
        if (null == $pk)
            return false;

        if (null != ($obj = self::getInstanceFromPool($pk))) {
            return $obj;
        }

        if (($obj = self::findOneById($pk))) {
            self::addInstanceToPool($obj, $obj->id);
            return $obj;
        }

        return false;
    }
}