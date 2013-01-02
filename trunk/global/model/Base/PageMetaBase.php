<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * PageMeta
 *  This class has been auto-generated at 02/01/2013 01:33:10
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11)
 * @property integer $page_id page_id type : int(11)
 * @property string $field_name field_name type : varchar(255) max_length : 255
 * @property string $field_value field_value type : text max_length : 

 * @method static \PageMeta[] findById(integer $id) find objects in database by id
 * @method static \PageMeta findOneById(integer $id) find object in database by id
 * @method static \PageMeta[] findByPageId(integer $page_id) find objects in database by page_id
 * @method static \PageMeta findOneByPageId(integer $page_id) find object in database by page_id
 * @method static \PageMeta[] findByFieldName(string $field_name) find objects in database by field_name
 * @method static \PageMeta findOneByFieldName(string $field_name) find object in database by field_name
 * @method static \PageMeta[] findByFieldValue(string $field_value) find objects in database by field_value
 * @method static \PageMeta findOneByFieldValue(string $field_value) find object in database by field_value

 */
abstract class PageMetaBase extends ActiveRecord {
    protected static $_tableName = 'page_meta';
    protected static $_pk = 'id';
    protected static $_alias = 'p';
    protected static $_dbConnectName = 'page_meta';
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
        'field_name' => array('name' => 'field_name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'field_value' => array('name' => 'field_value',
                'type' => 'string',
                'db_type' => 'text'),
);
    protected static $_validate = array(
        'page_id' => array('require' => '"page_id" is required!'),
        'field_name' => array('require' => '"field_name" is required!'),
);
    protected static $_cols = array('id','page_id','field_name','field_value');

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