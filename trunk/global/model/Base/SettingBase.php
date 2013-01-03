<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Setting
 *  This class has been auto-generated at 03/01/2013 18:04:53
 * @version		$Id$
 * @package		Model

 * @property string $key key primary type : varchar(255) max_length : 255
 * @property string $text_value text_value type : text max_length : 
 * @property string $number_value number_value type : varchar(255) max_length : 255
 * @property integer $bool_value bool_value type : tinyint(1)
 * @property string $format format type : enum('NUMBER','TEXT','BOOLEAN') max_length : 7

 * @method static \Setting[] findByKey(string $key) find objects in database by key
 * @method static \Setting findOneByKey(string $key) find object in database by key
 * @method static \Setting[] findByTextValue(string $text_value) find objects in database by text_value
 * @method static \Setting findOneByTextValue(string $text_value) find object in database by text_value
 * @method static \Setting[] findByNumberValue(string $number_value) find objects in database by number_value
 * @method static \Setting findOneByNumberValue(string $number_value) find object in database by number_value
 * @method static \Setting[] findByBoolValue(integer $bool_value) find objects in database by bool_value
 * @method static \Setting findOneByBoolValue(integer $bool_value) find object in database by bool_value
 * @method static \Setting[] findByFormat(string $format) find objects in database by format
 * @method static \Setting findOneByFormat(string $format) find object in database by format

 */
abstract class SettingBase extends ActiveRecord {
    protected static $_tableName = 'setting';
    protected static $_pk = 'key';
    protected static $_alias = 's';
    protected static $_dbConnectName = 'setting';
    protected static $_instances = array();
    protected static $_schema = array(
        'key' => array('name' => 'key',
                'type' => 'string',
                'primary' => true,
                'db_type' => 'varchar(255)',
                'length' => 255),
        'text_value' => array('name' => 'text_value',
                'type' => 'string',
                'db_type' => 'text'),
        'number_value' => array('name' => 'number_value',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'bool_value' => array('name' => 'bool_value',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'format' => array('name' => 'format',
                'type' => 'string',
                'db_type' => 'enum(\'NUMBER\',\'TEXT\',\'BOOLEAN\')',
                'length' => 7),
);
    protected static $_validate = array(
        'key' => array('require' => '"key" is required!'),
        'format' => array('filter' => array('allow' => array('NUMBER','TEXT','BOOLEAN'),
                            'message' => 'format\'s values is not allowed')),
);
    protected static $_cols = array('key','text_value','number_value','bool_value','format');

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