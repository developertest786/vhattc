<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Module
 *  This class has been auto-generated at 02/01/2013 01:33:10
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11)
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $key key type : varchar(255) max_length : 255
 * @property string $folder folder type : varchar(255) max_length : 255
 * @property string $type type type : enum('block','widget') max_length : 6
 * @property integer $active active type : tinyint(4)
 * @property string $setting setting type : text max_length : 

 * @method static \Module[] findById(integer $id) find objects in database by id
 * @method static \Module findOneById(integer $id) find object in database by id
 * @method static \Module[] findByName(string $name) find objects in database by name
 * @method static \Module findOneByName(string $name) find object in database by name
 * @method static \Module[] findByKey(string $key) find objects in database by key
 * @method static \Module findOneByKey(string $key) find object in database by key
 * @method static \Module[] findByFolder(string $folder) find objects in database by folder
 * @method static \Module findOneByFolder(string $folder) find object in database by folder
 * @method static \Module[] findByType(string $type) find objects in database by type
 * @method static \Module findOneByType(string $type) find object in database by type
 * @method static \Module[] findByActive(integer $active) find objects in database by active
 * @method static \Module findOneByActive(integer $active) find object in database by active
 * @method static \Module[] findBySetting(string $setting) find objects in database by setting
 * @method static \Module findOneBySetting(string $setting) find object in database by setting

 */
abstract class ModuleBase extends ActiveRecord {
    protected static $_tableName = 'module';
    protected static $_pk = 'id';
    protected static $_alias = 'm';
    protected static $_dbConnectName = 'module';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11)',
                'length' => 4),
        'name' => array('name' => 'name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'key' => array('name' => 'key',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'folder' => array('name' => 'folder',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'type' => array('name' => 'type',
                'default' => 'block',
                'type' => 'string',
                'db_type' => 'enum(\'block\',\'widget\')',
                'length' => 6),
        'active' => array('name' => 'active',
                'default' => 1,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(4)',
                'length' => 1),
        'setting' => array('name' => 'setting',
                'type' => 'string',
                'db_type' => 'text'),
);
    protected static $_validate = array(
        'name' => array('require' => '"name" is required!'),
        'key' => array('require' => '"key" is required!'),
        'folder' => array('require' => '"folder" is required!'),
        'type' => array('require' => '"type" is required!',
                'filter' => array('allow' => array('block','widget'),
                            'message' => 'type\'s values is not allowed')),
        'active' => array('require' => '"active" is required!'),
);
    protected static $_cols = array('id','name','key','folder','type','active','setting');

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