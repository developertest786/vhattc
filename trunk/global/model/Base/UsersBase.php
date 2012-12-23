<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Users
 *  This class has been auto-generated at 23/12/2012 18:05:25
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary type : int(11)
 * @property string $first_name first_name type : varchar(255) max_length : 255
 * @property string $last_name last_name type : varchar(255) max_length : 255
 * @property string $username username type : varchar(150) max_length : 150
 * @property string $email email type : varchar(100) max_length : 100
 * @property string $password password type : char(64) max_length : 64
 * @property integer $joined_time joined_time type : int(11)
 * @property integer $last_visited_time last_visited_time type : int(11)
 * @property integer $block block type : tinyint(1)
 * @property integer $status status type : tinyint(4)
 * @property integer $active_email active_email type : tinyint(1)
 * @property string $secret secret type : char(32) max_length : 32

 * @method static \Users[] findById(integer $id) find objects in database by id
 * @method static \Users findOneById(integer $id) find object in database by id
 * @method static \Users[] findByFirstName(string $first_name) find objects in database by first_name
 * @method static \Users findOneByFirstName(string $first_name) find object in database by first_name
 * @method static \Users[] findByLastName(string $last_name) find objects in database by last_name
 * @method static \Users findOneByLastName(string $last_name) find object in database by last_name
 * @method static \Users[] findByUsername(string $username) find objects in database by username
 * @method static \Users findOneByUsername(string $username) find object in database by username
 * @method static \Users[] findByEmail(string $email) find objects in database by email
 * @method static \Users findOneByEmail(string $email) find object in database by email
 * @method static \Users[] findByPassword(string $password) find objects in database by password
 * @method static \Users findOneByPassword(string $password) find object in database by password
 * @method static \Users[] findByJoinedTime(integer $joined_time) find objects in database by joined_time
 * @method static \Users findOneByJoinedTime(integer $joined_time) find object in database by joined_time
 * @method static \Users[] findByLastVisitedTime(integer $last_visited_time) find objects in database by last_visited_time
 * @method static \Users findOneByLastVisitedTime(integer $last_visited_time) find object in database by last_visited_time
 * @method static \Users[] findByBlock(integer $block) find objects in database by block
 * @method static \Users findOneByBlock(integer $block) find object in database by block
 * @method static \Users[] findByStatus(integer $status) find objects in database by status
 * @method static \Users findOneByStatus(integer $status) find object in database by status
 * @method static \Users[] findByActiveEmail(integer $active_email) find objects in database by active_email
 * @method static \Users findOneByActiveEmail(integer $active_email) find object in database by active_email
 * @method static \Users[] findBySecret(string $secret) find objects in database by secret
 * @method static \Users findOneBySecret(string $secret) find object in database by secret

 */
abstract class UsersBase extends ActiveRecord {
    protected static $_tableName = 'users';
    protected static $_pk = 'id';
    protected static $_alias = 'u';
    protected static $_dbConnectName = 'users';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'first_name' => array('name' => 'first_name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'last_name' => array('name' => 'last_name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'username' => array('name' => 'username',
                'type' => 'string',
                'db_type' => 'varchar(150)',
                'length' => 150),
        'email' => array('name' => 'email',
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'password' => array('name' => 'password',
                'type' => 'string',
                'db_type' => 'char(64)',
                'length' => 64),
        'joined_time' => array('name' => 'joined_time',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'last_visited_time' => array('name' => 'last_visited_time',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'block' => array('name' => 'block',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'status' => array('name' => 'status',
                'default' => 1,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(4)',
                'length' => 1),
        'active_email' => array('name' => 'active_email',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'secret' => array('name' => 'secret',
                'type' => 'string',
                'db_type' => 'char(32)',
                'length' => 32),
);
    protected static $_validate = array(
        'id' => array('require' => '"id" is required!'),
        'username' => array('require' => '"username" is required!',
                'unique' => 'username\'s values has already been taken'),
        'password' => array('require' => '"password" is required!'),
        'joined_time' => array('require' => '"joined_time" is required!'),
        'block' => array('require' => '"block" is required!'),
        'status' => array('require' => '"status" is required!'),
        'active_email' => array('require' => '"active_email" is required!'),
        'secret' => array('require' => '"secret" is required!'),
);
    protected static $_cols = array('id','first_name','last_name','username','email','password','joined_time','last_visited_time','block','status','active_email','secret');

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