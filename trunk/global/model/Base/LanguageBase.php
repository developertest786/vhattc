<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Language
 *  This class has been auto-generated at 23/12/2012 18:05:25
 * @version		$Id$
 * @package		Model

 * @property integer $lang_id lang_id primary auto_increment type : int(11) unsigned
 * @property string $lang_code lang_code type : char(7) max_length : 7
 * @property string $title title type : varchar(50) max_length : 50
 * @property string $title_native title_native type : varchar(50) max_length : 50
 * @property string $sef sef type : varchar(50) max_length : 50
 * @property string $image image type : varchar(50) max_length : 50
 * @property string $description description type : varchar(512) max_length : 512
 * @property string $metakey metakey type : text max_length : 
 * @property string $metadesc metadesc type : text max_length : 
 * @property string $sitename sitename type : varchar(1024) max_length : 1024
 * @property integer $published published type : int(11)
 * @property integer $access access type : int(10) unsigned
 * @property integer $ordering ordering type : int(11)

 * @method static \Language[] findByLangId(integer $lang_id) find objects in database by lang_id
 * @method static \Language findOneByLangId(integer $lang_id) find object in database by lang_id
 * @method static \Language[] findByLangCode(string $lang_code) find objects in database by lang_code
 * @method static \Language findOneByLangCode(string $lang_code) find object in database by lang_code
 * @method static \Language[] findByTitle(string $title) find objects in database by title
 * @method static \Language findOneByTitle(string $title) find object in database by title
 * @method static \Language[] findByTitleNative(string $title_native) find objects in database by title_native
 * @method static \Language findOneByTitleNative(string $title_native) find object in database by title_native
 * @method static \Language[] findBySef(string $sef) find objects in database by sef
 * @method static \Language findOneBySef(string $sef) find object in database by sef
 * @method static \Language[] findByImage(string $image) find objects in database by image
 * @method static \Language findOneByImage(string $image) find object in database by image
 * @method static \Language[] findByDescription(string $description) find objects in database by description
 * @method static \Language findOneByDescription(string $description) find object in database by description
 * @method static \Language[] findByMetakey(string $metakey) find objects in database by metakey
 * @method static \Language findOneByMetakey(string $metakey) find object in database by metakey
 * @method static \Language[] findByMetadesc(string $metadesc) find objects in database by metadesc
 * @method static \Language findOneByMetadesc(string $metadesc) find object in database by metadesc
 * @method static \Language[] findBySitename(string $sitename) find objects in database by sitename
 * @method static \Language findOneBySitename(string $sitename) find object in database by sitename
 * @method static \Language[] findByPublished(integer $published) find objects in database by published
 * @method static \Language findOneByPublished(integer $published) find object in database by published
 * @method static \Language[] findByAccess(integer $access) find objects in database by access
 * @method static \Language findOneByAccess(integer $access) find object in database by access
 * @method static \Language[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \Language findOneByOrdering(integer $ordering) find object in database by ordering

 */
abstract class LanguageBase extends ActiveRecord {
    protected static $_tableName = 'language';
    protected static $_pk = 'lang_id';
    protected static $_alias = 'l';
    protected static $_dbConnectName = 'language';
    protected static $_instances = array();
    protected static $_schema = array(
        'lang_id' => array('name' => 'lang_id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'lang_code' => array('name' => 'lang_code',
                'type' => 'string',
                'db_type' => 'char(7)',
                'length' => 7),
        'title' => array('name' => 'title',
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'title_native' => array('name' => 'title_native',
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'sef' => array('name' => 'sef',
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'image' => array('name' => 'image',
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'description' => array('name' => 'description',
                'type' => 'string',
                'db_type' => 'varchar(512)',
                'length' => 512),
        'metakey' => array('name' => 'metakey',
                'type' => 'string',
                'db_type' => 'text'),
        'metadesc' => array('name' => 'metadesc',
                'type' => 'string',
                'db_type' => 'text'),
        'sitename' => array('name' => 'sitename',
                'type' => 'string',
                'db_type' => 'varchar(1024)',
                'length' => 1024),
        'published' => array('name' => 'published',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'access' => array('name' => 'access',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(10) unsigned',
                'length' => 4),
        'ordering' => array('name' => 'ordering',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
);
    protected static $_validate = array(
        'lang_code' => array('require' => '"lang_code" is required!',
                'unique' => 'lang_code\'s values has already been taken'),
        'title' => array('require' => '"title" is required!'),
        'title_native' => array('require' => '"title_native" is required!'),
        'sef' => array('require' => '"sef" is required!',
                'unique' => 'sef\'s values has already been taken'),
        'image' => array('require' => '"image" is required!',
                'unique' => 'image\'s values has already been taken'),
        'description' => array('require' => '"description" is required!'),
        'metakey' => array('require' => '"metakey" is required!'),
        'metadesc' => array('require' => '"metadesc" is required!'),
        'sitename' => array('require' => '"sitename" is required!'),
        'published' => array('require' => '"published" is required!'),
        'access' => array('require' => '"access" is required!'),
        'ordering' => array('require' => '"ordering" is required!'),
);
    protected static $_cols = array('lang_id','lang_code','title','title_native','sef','image','description','metakey','metadesc','sitename','published','access','ordering');

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