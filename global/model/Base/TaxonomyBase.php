<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Taxonomy
 *  This class has been auto-generated at 03/01/2013 21:28:06
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(10) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $slug slug type : varchar(255) max_length : 255
 * @property integer $group group type : int(10) unsigned

 * @method static \Taxonomy[] findById(integer $id) find objects in database by id
 * @method static \Taxonomy findOneById(integer $id) find object in database by id
 * @method static \Taxonomy[] findByName(string $name) find objects in database by name
 * @method static \Taxonomy findOneByName(string $name) find object in database by name
 * @method static \Taxonomy[] findBySlug(string $slug) find objects in database by slug
 * @method static \Taxonomy findOneBySlug(string $slug) find object in database by slug
 * @method static \Taxonomy[] findByGroup(integer $group) find objects in database by group
 * @method static \Taxonomy findOneByGroup(integer $group) find object in database by group

 */
abstract class TaxonomyBase extends ActiveRecord {
    protected static $_tableName = 'taxonomy';
    protected static $_pk = 'id';
    protected static $_alias = 't';
    protected static $_dbConnectName = 'taxonomy';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(10) unsigned',
                'length' => 4),
        'name' => array('name' => 'name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'slug' => array('name' => 'slug',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'group' => array('name' => 'group',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(10) unsigned',
                'length' => 4),
);
    protected static $_validate = array(
        'name' => array('require' => '"name" is required!'),
        'slug' => array('require' => '"slug" is required!'),
        'group' => array('require' => '"group" is required!'),
);
    protected static $_cols = array('id','name','slug','group');

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