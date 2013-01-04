<?php 
/**
 * Users
 *  This class has been auto-generated at 23/12/2012 16:41:36
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/UsersBase.php';
class Users extends \UsersBase {
    /**
     * @param $pk
     * @return bool|Users
     */
    public static function retrieveByPk($pk)
    {
        if (null == $pk)
            return false;

        if (null != ($obj = self::getInstanceFromPool($pk))) {
            return $obj;
        }

        $obj = self::findOneById($pk);
        if ($obj) {
            self::addInstanceToPool($obj, $obj->id);
            return $obj;
        }

        return false;
    }

    public function getRoles() {
        return self::getUserRoles($this);
    }

    public static function getUserRoles($user) {
        if ($user instanceof Users) {
            $user = $user->id;
        }
        $userRole = UserRole::findByUserId($user);
        $data = array();
        if ($userRole) {
            foreach ($userRole as $rl) {
                /* @var UserRole $rl */
                if ($t = Role::findOneById($rl->role_id)) {
                    $data[$t->id] = $t;
                }
            }
        }

        return $data;
    }
}