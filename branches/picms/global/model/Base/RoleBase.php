<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Role
 *  This class has been auto-generated at 03/01/2013 21:28:06
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(10) unsigned
 * @property string $role role type : varchar(255) max_length : 255
 * @property integer $parent_id parent_id type : int(11)
 * @property string $description description type : varchar(255) max_length : 255

 * @method static \Role[] findById(integer $id) find objects in database by id
 * @method static \Role findOneById(integer $id) find object in database by id
 * @method static \Role[] findByRole(string $role) find objects in database by role
 * @method static \Role findOneByRole(string $role) find object in database by role
 * @method static \Role[] findByParentId(integer $parent_id) find objects in database by parent_id
 * @method static \Role findOneByParentId(integer $parent_id) find object in database by parent_id
 * @method static \Role[] findByDescription(string $description) find objects in database by description
 * @method static \Role findOneByDescription(string $description) find object in database by description

 */
abstract class RoleBase extends ActiveRecord {
    protected static $_tableName = 'role';
    protected static $_pk = 'id';
    protected static $_alias = 'r';
    protected static $_dbConnectName = 'role';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(10) unsigned',
                'length' => 4),
        'role' => array('name' => 'role',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'parent_id' => array('name' => 'parent_id',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'description' => array('name' => 'description',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
);
    protected static $_validate = array(
        'role' => array('require' => '"role" is required!'),
        'parent_id' => array('require' => '"parent_id" is required!'),
        'description' => array('require' => '"description" is required!'),
);
    protected static $_cols = array('id','role','parent_id','description');

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