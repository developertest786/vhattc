<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Page
 *  This class has been auto-generated at 25/12/2012 04:30:37
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11)
 * @property integer $parent_id parent_id type : int(11)
 * @property string $status status type : enum('AUTO-DRAFT','DRAFT','PUBLISH','UNPUBLISH','TRASH') max_length : 10
 * @property integer $home_page home_page type : tinyint(4)
 * @property string $lang_code lang_code type : char(7) max_length : 7
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $template template type : varchar(255) max_length : 255
 * @property string $layout layout type : varchar(255) max_length : 255
 * @property string $link link type : text max_length : 
 * @property integer $ordering ordering type : int(11)
 * @property integer $created_by created_by type : int(11)
 * @property integer $modified_by modified_by type : int(11)
 * @property integer $created_time created_time type : int(11)
 * @property integer $modified_time modified_time type : int(11)

 * @method static \Page[] findById(integer $id) find objects in database by id
 * @method static \Page findOneById(integer $id) find object in database by id
 * @method static \Page[] findByParentId(integer $parent_id) find objects in database by parent_id
 * @method static \Page findOneByParentId(integer $parent_id) find object in database by parent_id
 * @method static \Page[] findByStatus(string $status) find objects in database by status
 * @method static \Page findOneByStatus(string $status) find object in database by status
 * @method static \Page[] findByHomePage(integer $home_page) find objects in database by home_page
 * @method static \Page findOneByHomePage(integer $home_page) find object in database by home_page
 * @method static \Page[] findByLangCode(string $lang_code) find objects in database by lang_code
 * @method static \Page findOneByLangCode(string $lang_code) find object in database by lang_code
 * @method static \Page[] findByName(string $name) find objects in database by name
 * @method static \Page findOneByName(string $name) find object in database by name
 * @method static \Page[] findByTemplate(string $template) find objects in database by template
 * @method static \Page findOneByTemplate(string $template) find object in database by template
 * @method static \Page[] findByLayout(string $layout) find objects in database by layout
 * @method static \Page findOneByLayout(string $layout) find object in database by layout
 * @method static \Page[] findByLink(string $link) find objects in database by link
 * @method static \Page findOneByLink(string $link) find object in database by link
 * @method static \Page[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \Page findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \Page[] findByCreatedBy(integer $created_by) find objects in database by created_by
 * @method static \Page findOneByCreatedBy(integer $created_by) find object in database by created_by
 * @method static \Page[] findByModifiedBy(integer $modified_by) find objects in database by modified_by
 * @method static \Page findOneByModifiedBy(integer $modified_by) find object in database by modified_by
 * @method static \Page[] findByCreatedTime(integer $created_time) find objects in database by created_time
 * @method static \Page findOneByCreatedTime(integer $created_time) find object in database by created_time
 * @method static \Page[] findByModifiedTime(integer $modified_time) find objects in database by modified_time
 * @method static \Page findOneByModifiedTime(integer $modified_time) find object in database by modified_time

 */
abstract class PageBase extends ActiveRecord {
    protected static $_tableName = 'page';
    protected static $_pk = 'id';
    protected static $_alias = 'p';
    protected static $_dbConnectName = 'page';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11)',
                'length' => 4),
        'parent_id' => array('name' => 'parent_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'status' => array('name' => 'status',
                'type' => 'string',
                'db_type' => 'enum(\'AUTO-DRAFT\',\'DRAFT\',\'PUBLISH\',\'UNPUBLISH\',\'TRASH\')',
                'length' => 10),
        'home_page' => array('name' => 'home_page',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(4)',
                'length' => 1),
        'lang_code' => array('name' => 'lang_code',
                'default' => '*',
                'type' => 'string',
                'db_type' => 'char(7)',
                'length' => 7),
        'name' => array('name' => 'name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'template' => array('name' => 'template',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'layout' => array('name' => 'layout',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'link' => array('name' => 'link',
                'type' => 'string',
                'db_type' => 'text'),
        'ordering' => array('name' => 'ordering',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
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
        'parent_id' => array('require' => '"parent_id" is required!',
                'unique' => 'parent_id\'s values has already been taken'),
        'status' => array('require' => '"status" is required!',
                'filter' => array('allow' => array('AUTO-DRAFT','DRAFT','PUBLISH','UNPUBLISH','TRASH'),
                            'message' => 'status\'s values is not allowed')),
        'home_page' => array('require' => '"home_page" is required!'),
        'lang_code' => array('require' => '"lang_code" is required!'),
        'name' => array('require' => '"name" is required!'),
        'link' => array('require' => '"link" is required!'),
        'ordering' => array('require' => '"ordering" is required!'),
        'created_by' => array('require' => '"created_by" is required!'),
        'modified_by' => array('require' => '"modified_by" is required!'),
        'created_time' => array('require' => '"created_time" is required!'),
        'modified_time' => array('require' => '"modified_time" is required!'),
);
    protected static $_cols = array('id','parent_id','status','home_page','lang_code','name','template','layout','link','ordering','created_by','modified_by','created_time','modified_time');

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