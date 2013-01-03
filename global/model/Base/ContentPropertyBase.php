<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * ContentProperty
 *  This class has been auto-generated at 03/01/2013 18:04:52
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(10)
 * @property integer $content_id content_id type : int(10)
 * @property string $property property type : varchar(255) max_length : 255
 * @property integer $boolean_value boolean_value type : tinyint(1)
 * @property string $textual_value textual_value type : text max_length : 
 * @property string $number_value number_value type : text max_length : 
 * @property string $array_value array_value type : text max_length : 

 * @method static \ContentProperty[] findById(integer $id) find objects in database by id
 * @method static \ContentProperty findOneById(integer $id) find object in database by id
 * @method static \ContentProperty[] findByContentId(integer $content_id) find objects in database by content_id
 * @method static \ContentProperty findOneByContentId(integer $content_id) find object in database by content_id
 * @method static \ContentProperty[] findByProperty(string $property) find objects in database by property
 * @method static \ContentProperty findOneByProperty(string $property) find object in database by property
 * @method static \ContentProperty[] findByBooleanValue(integer $boolean_value) find objects in database by boolean_value
 * @method static \ContentProperty findOneByBooleanValue(integer $boolean_value) find object in database by boolean_value
 * @method static \ContentProperty[] findByTextualValue(string $textual_value) find objects in database by textual_value
 * @method static \ContentProperty findOneByTextualValue(string $textual_value) find object in database by textual_value
 * @method static \ContentProperty[] findByNumberValue(string $number_value) find objects in database by number_value
 * @method static \ContentProperty findOneByNumberValue(string $number_value) find object in database by number_value
 * @method static \ContentProperty[] findByArrayValue(string $array_value) find objects in database by array_value
 * @method static \ContentProperty findOneByArrayValue(string $array_value) find object in database by array_value

 */
abstract class ContentPropertyBase extends ActiveRecord {
    protected static $_tableName = 'content_property';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'content_property';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(10)',
                'length' => 4),
        'content_id' => array('name' => 'content_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(10)',
                'length' => 4),
        'property' => array('name' => 'property',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'boolean_value' => array('name' => 'boolean_value',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'textual_value' => array('name' => 'textual_value',
                'type' => 'string',
                'db_type' => 'text'),
        'number_value' => array('name' => 'number_value',
                'type' => 'string',
                'db_type' => 'text'),
        'array_value' => array('name' => 'array_value',
                'type' => 'string',
                'db_type' => 'text'),
);
    protected static $_validate = array(
        'content_id' => array('require' => '"content_id" is required!'),
        'property' => array('require' => '"property" is required!'),
        'number_value' => array('require' => '"number_value" is required!'),
);
    protected static $_cols = array('id','content_id','property','boolean_value','textual_value','number_value','array_value');

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