<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Term
 *  This class has been auto-generated at 02/01/2013 01:33:10
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(10) unsigned
 * @property integer $parent_id parent_id type : int(11)
 * @property string $lang_code lang_code type : varchar(7) max_length : 7
 * @property integer $taxonomy_id taxonomy_id type : int(11)
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $slug slug type : varchar(255) max_length : 255
 * @property string $desciption desciption type : text max_length : 

 * @method static \Term[] findById(integer $id) find objects in database by id
 * @method static \Term findOneById(integer $id) find object in database by id
 * @method static \Term[] findByParentId(integer $parent_id) find objects in database by parent_id
 * @method static \Term findOneByParentId(integer $parent_id) find object in database by parent_id
 * @method static \Term[] findByLangCode(string $lang_code) find objects in database by lang_code
 * @method static \Term findOneByLangCode(string $lang_code) find object in database by lang_code
 * @method static \Term[] findByTaxonomyId(integer $taxonomy_id) find objects in database by taxonomy_id
 * @method static \Term findOneByTaxonomyId(integer $taxonomy_id) find object in database by taxonomy_id
 * @method static \Term[] findByName(string $name) find objects in database by name
 * @method static \Term findOneByName(string $name) find object in database by name
 * @method static \Term[] findBySlug(string $slug) find objects in database by slug
 * @method static \Term findOneBySlug(string $slug) find object in database by slug
 * @method static \Term[] findByDesciption(string $desciption) find objects in database by desciption
 * @method static \Term findOneByDesciption(string $desciption) find object in database by desciption

 */
abstract class TermBase extends ActiveRecord {
    protected static $_tableName = 'term';
    protected static $_pk = 'id';
    protected static $_alias = 't';
    protected static $_dbConnectName = 'term';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(10) unsigned',
                'length' => 4),
        'parent_id' => array('name' => 'parent_id',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'lang_code' => array('name' => 'lang_code',
                'default' => '*',
                'type' => 'string',
                'db_type' => 'varchar(7)',
                'length' => 7),
        'taxonomy_id' => array('name' => 'taxonomy_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'name' => array('name' => 'name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'slug' => array('name' => 'slug',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'desciption' => array('name' => 'desciption',
                'type' => 'string',
                'db_type' => 'text'),
);
    protected static $_validate = array(
        'parent_id' => array('require' => '"parent_id" is required!'),
        'lang_code' => array('require' => '"lang_code" is required!'),
        'taxonomy_id' => array('require' => '"taxonomy_id" is required!'),
        'name' => array('require' => '"name" is required!'),
        'slug' => array('require' => '"slug" is required!'),
        'desciption' => array('require' => '"desciption" is required!'),
);
    protected static $_cols = array('id','parent_id','lang_code','taxonomy_id','name','slug','desciption');

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