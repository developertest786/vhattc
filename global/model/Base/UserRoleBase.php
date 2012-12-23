<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * UserRole
 *  This class has been auto-generated at 23/12/2012 18:05:25
 * @version		$Id$
 * @package		Model

 * @property integer $user_id user_id primary type : int(11)
 * @property integer $role_id role_id primary type : int(11)

 * @method static \UserRole[] findByUserId(integer $user_id) find objects in database by user_id
 * @method static \UserRole findOneByUserId(integer $user_id) find object in database by user_id
 * @method static \UserRole[] findByRoleId(integer $role_id) find objects in database by role_id
 * @method static \UserRole findOneByRoleId(integer $role_id) find object in database by role_id

 */
abstract class UserRoleBase extends ActiveRecord {
    protected static $_tableName = 'user_role';
    protected static $_pk = 'role_id';
    protected static $_alias = 'u';
    protected static $_dbConnectName = 'user_role';
    protected static $_instances = array();
    protected static $_schema = array(
        'user_id' => array('name' => 'user_id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'role_id' => array('name' => 'role_id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
);
    protected static $_validate = array(
        'user_id' => array('require' => '"user_id" is required!'),
        'role_id' => array('require' => '"role_id" is required!'),
);
    protected static $_cols = array('user_id','role_id');

    public function setTableDefinition() {
    }

    /**
     * save object model
     * @return boolean
     * @throws \Flywheel\Db\Exception
     */
    public function save() {
        $conn = Manager::getConnection(self::getDbConnectName());
        try {
            $conn->beginTransaction();
            $this->_beforeSave();
            $status = $this->saveToDb();
            $this->_afterSave();
            $conn->commit();
            return $status;
        }
        catch (\Flywheel\Db\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }

    /**
     * delete object model
     * @return boolean
     * @throws \Flywheel\Db\Exception
     */
    public function delete() {
        $conn = Manager::getConnection(self::getDbConnectName());
        try {
            $this->_beforeDelete();
            $this->deleteFromDb();
            $this->_afterDelete();
            $conn->commit();
            return true;
        }
        catch (\Flywheel\Db\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }
}