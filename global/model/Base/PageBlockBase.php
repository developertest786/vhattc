<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * PageBlock
 *  This class has been auto-generated at 23/12/2012 18:05:25
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11)
 * @property integer $page_id page_id type : int(11)
 * @property integer $module_id module_id type : int(11)
 * @property string $position position type : varchar(255) max_length : 255
 * @property string $data data type : text max_length : 
 * @property integer $ordering ordering type : int(11)
 * @property integer $active active type : tinyint(4)
 * @property integer $created_by created_by type : int(11)
 * @property integer $modified_by modified_by type : int(11)
 * @property integer $created_time created_time type : int(11)
 * @property integer $modified_time modified_time type : int(11)

 * @method static \PageBlock[] findById(integer $id) find objects in database by id
 * @method static \PageBlock findOneById(integer $id) find object in database by id
 * @method static \PageBlock[] findByPageId(integer $page_id) find objects in database by page_id
 * @method static \PageBlock findOneByPageId(integer $page_id) find object in database by page_id
 * @method static \PageBlock[] findByModuleId(integer $module_id) find objects in database by module_id
 * @method static \PageBlock findOneByModuleId(integer $module_id) find object in database by module_id
 * @method static \PageBlock[] findByPosition(string $position) find objects in database by position
 * @method static \PageBlock findOneByPosition(string $position) find object in database by position
 * @method static \PageBlock[] findByData(string $data) find objects in database by data
 * @method static \PageBlock findOneByData(string $data) find object in database by data
 * @method static \PageBlock[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \PageBlock findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \PageBlock[] findByActive(integer $active) find objects in database by active
 * @method static \PageBlock findOneByActive(integer $active) find object in database by active
 * @method static \PageBlock[] findByCreatedBy(integer $created_by) find objects in database by created_by
 * @method static \PageBlock findOneByCreatedBy(integer $created_by) find object in database by created_by
 * @method static \PageBlock[] findByModifiedBy(integer $modified_by) find objects in database by modified_by
 * @method static \PageBlock findOneByModifiedBy(integer $modified_by) find object in database by modified_by
 * @method static \PageBlock[] findByCreatedTime(integer $created_time) find objects in database by created_time
 * @method static \PageBlock findOneByCreatedTime(integer $created_time) find object in database by created_time
 * @method static \PageBlock[] findByModifiedTime(integer $modified_time) find objects in database by modified_time
 * @method static \PageBlock findOneByModifiedTime(integer $modified_time) find object in database by modified_time

 */
abstract class PageBlockBase extends ActiveRecord {
    protected static $_tableName = 'page_block';
    protected static $_pk = 'id';
    protected static $_alias = 'p';
    protected static $_dbConnectName = 'page_block';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11)',
                'length' => 4),
        'page_id' => array('name' => 'page_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'module_id' => array('name' => 'module_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'position' => array('name' => 'position',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'data' => array('name' => 'data',
                'type' => 'string',
                'db_type' => 'text'),
        'ordering' => array('name' => 'ordering',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'active' => array('name' => 'active',
                'default' => 1,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(4)',
                'length' => 1),
        'created_by' => array('name' => 'created_by',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'modified_by' => array('name' => 'modified_by',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'created_time' => array('name' => 'created_time',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'modified_time' => array('name' => 'modified_time',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
);
    protected static $_validate = array(
        'page_id' => array('require' => '"page_id" is required!'),
        'module_id' => array('require' => '"module_id" is required!'),
        'position' => array('require' => '"position" is required!'),
        'data' => array('require' => '"data" is required!'),
        'ordering' => array('require' => '"ordering" is required!'),
        'active' => array('require' => '"active" is required!'),
        'created_by' => array('require' => '"created_by" is required!'),
        'modified_by' => array('require' => '"modified_by" is required!'),
        'created_time' => array('require' => '"created_time" is required!'),
        'modified_time' => array('require' => '"modified_time" is required!'),
);
    protected static $_cols = array('id','page_id','module_id','position','data','ordering','active','created_by','modified_by','created_time','modified_time');

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