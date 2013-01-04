<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Content
 *  This class has been auto-generated at 03/01/2013 21:28:06
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(10) unsigned
 * @property string $title title type : text max_length : 
 * @property string $content content type : text max_length : 
 * @property string $excerpt excerpt type : text max_length : 
 * @property string $lang_code lang_code type : char(7) max_length : 7
 * @property string $status status type : enum('PUBLISH','AUTO_DRAFT','HIDDEN') max_length : 10
 * @property integer $taxonomy_id taxonomy_id type : int(10) unsigned
 * @property integer $created_time created_time type : int(10) unsigned
 * @property integer $modified_time modified_time type : int(10)

 * @method static \Content[] findById(integer $id) find objects in database by id
 * @method static \Content findOneById(integer $id) find object in database by id
 * @method static \Content[] findByTitle(string $title) find objects in database by title
 * @method static \Content findOneByTitle(string $title) find object in database by title
 * @method static \Content[] findByContent(string $content) find objects in database by content
 * @method static \Content findOneByContent(string $content) find object in database by content
 * @method static \Content[] findByExcerpt(string $excerpt) find objects in database by excerpt
 * @method static \Content findOneByExcerpt(string $excerpt) find object in database by excerpt
 * @method static \Content[] findByLangCode(string $lang_code) find objects in database by lang_code
 * @method static \Content findOneByLangCode(string $lang_code) find object in database by lang_code
 * @method static \Content[] findByStatus(string $status) find objects in database by status
 * @method static \Content findOneByStatus(string $status) find object in database by status
 * @method static \Content[] findByTaxonomyId(integer $taxonomy_id) find objects in database by taxonomy_id
 * @method static \Content findOneByTaxonomyId(integer $taxonomy_id) find object in database by taxonomy_id
 * @method static \Content[] findByCreatedTime(integer $created_time) find objects in database by created_time
 * @method static \Content findOneByCreatedTime(integer $created_time) find object in database by created_time
 * @method static \Content[] findByModifiedTime(integer $modified_time) find objects in database by modified_time
 * @method static \Content findOneByModifiedTime(integer $modified_time) find object in database by modified_time

 */
abstract class ContentBase extends ActiveRecord {
    protected static $_tableName = 'content';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'content';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(10) unsigned',
                'length' => 4),
        'title' => array('name' => 'title',
                'type' => 'string',
                'db_type' => 'text'),
        'content' => array('name' => 'content',
                'type' => 'string',
                'db_type' => 'text'),
        'excerpt' => array('name' => 'excerpt',
                'type' => 'string',
                'db_type' => 'text'),
        'lang_code' => array('name' => 'lang_code',
                'default' => '*',
                'type' => 'string',
                'db_type' => 'char(7)',
                'length' => 7),
        'status' => array('name' => 'status',
                'type' => 'string',
                'db_type' => 'enum(\'PUBLISH\',\'AUTO_DRAFT\',\'HIDDEN\')',
                'length' => 10),
        'taxonomy_id' => array('name' => 'taxonomy_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(10) unsigned',
                'length' => 4),
        'created_time' => array('name' => 'created_time',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(10) unsigned',
                'length' => 4),
        'modified_time' => array('name' => 'modified_time',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(10)',
                'length' => 4),
);
    protected static $_validate = array(
        'title' => array('require' => '"title" is required!'),
        'content' => array('require' => '"content" is required!'),
        'excerpt' => array('require' => '"excerpt" is required!'),
        'lang_code' => array('require' => '"lang_code" is required!'),
        'status' => array('require' => '"status" is required!',
                'filter' => array('allow' => array('PUBLISH','AUTO_DRAFT','HIDDEN'),
                            'message' => 'status\'s values is not allowed')),
        'taxonomy_id' => array('require' => '"taxonomy_id" is required!'),
        'created_time' => array('require' => '"created_time" is required!'),
        'modified_time' => array('require' => '"modified_time" is required!'),
);
    protected static $_cols = array('id','title','content','excerpt','lang_code','status','taxonomy_id','created_time','modified_time');

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