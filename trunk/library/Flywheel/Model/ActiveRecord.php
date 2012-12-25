<?php
namespace Flywheel\Model;
use Flywheel\Event\Common as Event;
use Flywheel\Validator\Util as ValidatorUtil;
use Flywheel\Db\Expression;
use Flywheel\Util\Inflection;
use Flywheel\Db\Connection;
use Flywheel\Db\Manager;

abstract class ActiveRecord extends \Flywheel\Object {
    protected static $_tableName;
    protected static $_pk;
    protected static $_dbConnectName;
    protected static $_validate;
    protected static $_validate_plus;
    protected static $_cols = array();
    protected static $_schema = array();
    protected static $_alias;
    protected static $_instances = array();
    protected static $_validators;

    /**
     * status of deleted om. If object had been delete from database
     * @var bool
     */
    private $_deleted = false;

    /**
     * status of new object. If object not store in database, this value is true
     * @var $_new boolean
     */
    private $_new = true;

    public $validate = array();

    protected $_data = array();
    protected $_modifiedCols = array();
    protected $_validationFailures = array();
    protected $_valid = false;

    public function __construct() {
        $this->setTableDefinition();
        $this->_initDataValue();
        $this->init();
        self::getValidate();
    }

    public function setTableDefinition() {}

    protected function _initDataValue() {
        foreach (static::$_schema as $c => $config) {
            $this->_data[$c] = (isset($config['default']))? $config['default'] : null;
        }
    }

    public function init() {}

    public static function create() {
        return new static();
    }

    public static function setTableName($tblName) {
        static::$_tableName = $tblName;
    }

    public static function getTableName() {
        return static::$_tableName;
    }

    public static function setTableAlias($alias) {
        static::$_alias = $alias;
    }

    public static function getTableAlias() {
        return static::$_alias;
    }

    public static function setPrimaryKeyField($field) {
        static::$_pk = $field;
    }

    public static function getPrimaryKeyField() {
        return static::$_pk;
    }

    public static function setDbConnectName($dbName) {
        static::$_dbConnectName = $dbName;
    }

    public static function getDbConnectName() {
        return static::$_dbConnectName;
    }

    public static function getColumnsList($alias = null) {
        $db = Manager::getConnection(static::getDbConnectName());

        $list = array();
        for($i = 0, $size = sizeof(static::$_cols); $i < $size; ++$i) {
            $list[] = ((null != $alias)? $alias .'.' : '') .$db->getAdapter()->quoteIdentifier(static::$_cols[$i]);
        }
        return implode(',', $list);
    }

    /**
     * create read query
     * @return \Flywheel\Db\Query
     */
    public static function read() {
        return Manager::getConnection(static::getDbConnectName(), Manager::__SLAVE__)
            ->createQuery()->from(static::getTableName());
    }

    /**
     * create write query
     * @return \Flywheel\Db\Query
     */
    public static function write() {
        return Manager::getConnection(static::getDbConnectName())->createQuery()
            ->from(static::getTableName());
    }

    /**
     * more rules merger with static::$_validate, overwrite it in OM
     * @see ActiveRecord::__construct()
     * must be return a array
     * @return array
     */
    public static function additionRules() {
        return array();
    }

    /**
     * return the named attribute value.
     * if this is a new record and the attribute is not set before, the default column value will be returned.
     * if this record is the result of a query and the attribute is not loaded, null will be returned.     *
     * @param string $name the attribute name
     * @return mixed
     */
    public function getAttribute($name) {
        if (property_exists($this, $name))
            return $this->$name;
        else if (isset($this->_data[$name]))
            return $this->_data[$name];

        return null;
    }

    /**
     * return all column attribute values.
     *
     * @param mixed $names names of attributes whose value need to be returned.
     * if this null (default), them all attribute values will be returned
     * if this is a array
     * @return array
     */
    public function getAttributes($names = null) {
        if (null == $names)
            return $this->_data;

        if (is_string($names)) {
            $names = explode(',', $names);
        }

        $attr = array();
        if (is_array($names)) {
            for ($i = 0, $size = sizeof($names); $i < $size; ++$i) {
                $names[$i] = trim($names[$i]);
                if (property_exists($this, $names[$i]))
                    $attr[$names[$i]] = $this->$names[$i];
                else
                    $attr[$names[$i]] = isset($this->_data[$names[$i]])? $this->_data[$names[$i]] : null;
            }
        }

        return $attr;
    }

    /**
     * reload object data from db
     * @return bool
     * @throws Exception
     */
    public function reload() {
        $data = static::write()->where(static::getPrimaryKeyField() .'= :pk')
            ->setMaxResults(1)
            ->setParameter(':pk', $this->getPkValue())
            ->execute()
            ->fetch(\PDO::FETCH_ASSOC);
        if ($data) {
            $this->hydrate($data);
            return true;
        }
        throw new Exception('Reload fail!');
    }

    /**
     * check OM's table has field
     * @param $field
     * @return bool
     */
    public function hasField($field) {
        return isset(static::$_schema[$field]);
    }

    /**
     * get primary key field
     *
     * @return mixed
     */
    public function getPkValue() {
        return $this->{static::getPrimaryKeyField()};
    }

    public function setValidationFailure($column, $mess)
    {
        if (!isset($this->_validationFailures[$column])) {
            $this->_validationFailures[$column] = array();
        }
        $this->_validationFailures[$column][] = $mess;
    }

    /**
     * @return array
     */
    public function getValidationFailures()
    {
        return $this->_validationFailures;
    }

    protected function _beforeSave() {
        $this->getEventDispatcher()->dispatch('onBeforeSave', new Event($this));
    }

    protected function _afterSave() {
        $this->getEventDispatcher()->dispatch('onAfterSave', new Event($this));
    }

    protected function _beforeDelete() {
        $this->getEventDispatcher()->dispatch('onBeforeDelete', new Event($this));
    }

    protected function _afterDelete() {
        $this->getEventDispatcher()->dispatch('onAfterDelete', new Event($this));
    }

    protected function _beforeValidate() {
        $this->getEventDispatcher()->dispatch('onBeforeValidate', new Event($this));
    }

    protected function _afterValidate() {
        $this->getEventDispatcher()->dispatch('onAfterValidate', new Event($this));
    }

    /**
     * is object did not store in database
     *
     * @return boolean
     */
    public function isNew() {
        return $this->_new;
    }

    /**
     * Set New
     * @param boolean $isNew
     */
    public function setNew($isNew) {
        $this->_new = (boolean) $isNew;
    }

    public function getModifiedCols() {
        return array_keys($this->_modifiedCols);
    }

    public function isColumnModified($col) {
        return isset($this->_modifiedCols[$col]);
    }

    public function hasColumnsModified() {
        return (bool) sizeof($this->_modifiedCols);
    }

    /**
     * @return bool
     */
    public function isValid() {
        return $this->_valid;
    }

    /**
     * To Array
     *
     * @param bool $raw return array with all
     *          object's property neither only column field
     *
     * @return array
     */
    public function toArray($raw = false) {
        if (true === $raw) {
            return get_object_vars($this);
        }

        return $this->_data;
    }

    /**
     * To Json
     *
     * @param bool $raw
     *
     * @return string in JSON format
     */
    public function toJSon($raw = false) {
        if (true === $raw) {
            return json_encode($this);
        }

        return json_encode($this->_data);
    }

    /**
     * hydrate data to object
     *
     * @param object | array $data
     */
    public function hydrate($data) {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        foreach ($data as $p=>$value) {
            if (isset(static::$_schema[$p])) {
				$this->_modifiedCols[$p] = true;
                $this->_data[$p] = $this->fixData($value, static::$_schema[$p]);
            } else {
                $this->$p = $value;
            }
        }
    }

    /**
     * hydrate json to om
     * @param $json
     */
    public function hydrateJSON($json) {
        $data = json_decode($json, true);

        $this->hydrate($data);
    }

    public function isDeleted() {
        return $this->_deleted;
    }

    /**
     * fix data matche collumn data defined
     * @param $data
     * @param $config
     * @return bool|float|int|null|string|\Flywheel\Db\Expression
     */
    public function fixData($data, $config) {
        if ($data instanceof \Flywheel\Db\Expression) {
            return $data;
        }

        $type = $config['type'];
        if (null !== $data) {
            switch ($type) {
                case 'integer':
                    return (int) $data;
                case 'float':
                case 'number':
                case 'decimal':
                    return (float) $data;
                case 'double' :
                    return (double) $data;
                case 'date':
                case 'datetime':
                case 'blob':
                case 'string':
                    return (string) $data;
                case 'boolean':
                case 'bool':
                    return (bool) $data;
                case 'array':
                    if (is_scalar($data)) {
                        $data = json_decode($data);
                    }
                    return $data;
            }
        } else {
            if (false == $config['not_null']) {
                switch ($type) {
                    case 'integer':
                    case 'int':
                    case 'timestamp':
                    case 'time':
                    case 'float':
                    case 'decimal':
                    case 'double':
                    case 'number':
                    case 'date':
                    case 'datetime':
                    case 'blob':
                    case 'string':
                        return null;
                    case 'boolean':
                    case 'bool':
                        return 0;
                    case 'array':
                        return array();
                }
            } else {
                switch ($type) {
                    case 'integer':
                    case 'int':
                    case 'float':
                    case 'decimal':
                    case 'double':
                    case 'number':
                        return 0;
                    case 'timestamp':
                        return '0000-00-00 00:00:00';
                    case 'time':
                        return '00:00:00';
                    case 'date':
                        return '0000-00-00';
                    case 'datetime':
                        return '0000-00-00 00:00:00';
                    case 'blob':
                    case 'string':
                        return '';
                    case 'boolean':
                    case 'bool':
                        return 0;
                    case 'array':
                        return array();
                }
            }
        }

        return null;
    }

    /**
     * Removes errors for all attributes or a single attribute.
     * @param string $attribute attribute name. Use null to remove errors for all attribute.
     */
    public function clearErrors($attribute=null) {
        if($attribute===null)
            $this->_validationFailures = array();
        else
            unset($this->_validationFailures[$attribute]);
    }

    /**
     * @return bool
     * @throws \Flywheel\Db\Exception
     */
    public function saveToDb() {
        if (!$this->validate()) {
            return false;
        }

        $data = $this->getAttributes($this->getModifiedCols());
        foreach($data as $c => &$v) {
            if (is_array($v)) {
                $v = json_encode($v);
            } else {
                $v = $this->fixData($v, static::$_schema[$c]);
            }
        }

        $db = Manager::getConnection(static::getDbConnectName());
        $databind = $this->_populateStmtValues($data);
        if ($this->isNew()) { //insert new record
            $status = $db->insert(static::getTableName(), $data, $databind);
            if (!$status) {
                throw new \Flywheel\Db\Exception('Insert record did not succeed!');
            }
            $this->{static::getPrimaryKeyField()} = $db->lastInsertId();
        } else {
            $db->update(static::getTableName(), $data, array(static::getPrimaryKeyField() => $this->getPkValue()), $databind);
        }

        $this->setNew(false);
        return true;
    }

    protected function _populateStmtValues(&$data) {
        $databind = array();
        $c = $data;
        foreach ($c as $n => $v) {
            if (!($v instanceof Expression)) {
                if (null == $v && (!isset(static::$_validate[$n]) || !isset(static::$_validate[$n]['require']))) {
                    unset($data[$n]); // no thing
                } else {
                    $databind[] = Manager::getConnection(static::getDbConnectName())->getAdapter()->getPDOParam(static::$_schema[$n]['db_type']);
                }
            }
        }

        return $databind;
    }

    /**
     * delete object from database
     *
     * @return int
     * @throws \Flywheel\Db\Exception
     */
    public function deleteFromDb() {
        if ($this->isNew()) {
            throw new \Flywheel\Db\Exception('Record has been not saved in to database, cannot delete!');
        }

        $pkField = static::getPrimaryKeyField();
        $db = Manager::getConnection(static::getDbConnectName());
        $affectedRows = $db->delete(static::getTableName(), array($pkField, $this->getPkValue()));
        if ($affectedRows)
            $this->_deleted = true;
        return $affectedRows;
    }

    abstract public function save();
    abstract public function delete();

    /**
     * add instance to pool
     * @static
     * @param $obj
     * @param null $key
     * @return bool
     */
    public static function addInstanceToPool($obj, $key = null) {
        $lbClass = get_called_class();
        if (!$obj instanceof $lbClass) {
            return false;
        }

        /* @var ActiveRecord $obj */
        if (null == $key) {
            $key = $obj->getPkValue();
        }

        static::$_instances[$key] = $obj;
        return true;
    }

    /**
     * get all instances from pool by key
     * @static
     * @return get_called_class()[] | null
     */
    public static function getInstancesFromPool() {
        return static::$_instances;
    }

    /**
     * get instance from pool by key
     * @static
     * @param $key
     * @return get_called_class() | null
     */
    public static function getInstanceFromPool($key) {
        return isset(static::$_instances[$key])? static::$_instances[$key] : null;
    }

    /**
     * remove instance in pool by $key
     * @static
     * @param $key
     */
    public static function removeInstanceFromPool($key) {
        unset(static::$_instances[$key]);
    }

    /**
     * clear pool
     * @static
     */
    public static function clearPool() {
        static::$_instances = array();
    }

    /**
     * Resolves the passed find by field name inflecting the parameter.
     *
     * @param string $name
     * @return string $fieldName
     */
    protected static function _resolveFindByFieldName($name) {
        $fieldName = Inflection::camelCaseToHungary($name);
        if (isset(static::$_schema[$fieldName])) {
            return (static::getTableAlias()? static::getTableAlias() .'.' :'')
                .Manager::getConnection(static::getDbConnectName())->getAdapter()->quoteIdentifier($fieldName);
        }

        return false;
    }

    public static function buildFindByWhere($fieldName) {
        if ('' == $fieldName || 1 == $fieldName || '*' == $fieldName || 'all' == strtolower($fieldName))
            return '1';

        $ands = array();
        $e = explode('And', $fieldName);
        foreach ($e as $k => $v) {
            $and = '';
            $e2 = explode('Or', $v);
            $ors = array();
            foreach ($e2 as $k2 => $v2) {
                if ($v2 = static::_resolveFindByFieldName($v2)) {
                    $ors[] = $v2 . ' = ?';
                } else {
                    throw new Exception('Invalid field name to find by: ' . $v2);
                }
            }
            $and .= implode(' OR ', $ors);
            $and = count($ors) > 1 ? '(' . $and . ')':$and;
            $ands[] = $and;
        }
        $where = implode(' AND ', $ands);
        return $where;
    }

    public static function findAll() {
        static::create();
        $stmt = Manager::getConnection(static::getDbConnectName(), Manager::__SLAVE__)->createQuery()
            ->select(static::getColumnsList(static::getTableAlias()))
            ->from(static::getTableName(), static::getTableAlias())
            ->execute();

        $result = array();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $om = new static();
            $om->hydrate($row);
            $om->setNew(false);
            $result[] = $om;
        }

        return (empty($result))? $result : null;
    }

    public static function findBy($by, $param = null, $first = false) {
        static::create();
        $q = Manager::getConnection(static::getDbConnectName(), Manager::__SLAVE__)->createQuery()
            ->select(static::getColumnsList(static::getTableAlias()))
            ->from(static::getTableName(), static::getTableAlias())
            ->where(static::buildFindByWhere($by));
        if ($first)
            $q->setMaxResults(1);

        if (null != $param)
            $q->setParameters($param);

        $stmt = $q->execute();

        $result = array();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $om = new static();
            $om->hydrate($row);
            $om->setNew(false);
            if ($first)
                return $om;

            $result[] = $om;
        }

        return (empty($result))? $result : null;
    }

    public function __call($method, $params) {
        if (strrpos($method, 'set') === 0
            && isset($params[0]) && null !== $params[0]) {
            $name = Inflection::camelCaseToHungary(substr($method, 3, strlen($method)));

            if (isset(static::$_cols[$name])) {
                $this->_data[$name] = $this->fixData($params[0], static::$_schema[$name]);
                $this->_modifiedCols[$name] = true;
            } else {
                $this->$name = $params[0];
            }

            return true;
        }

        if (strpos($method, 'get') === 0) {
            $name = Inflection::camelCaseToHungary(substr($method, 3, strlen($method)));
            if (isset(static::$_cols[$name])) {
                return isset($this->_data[$name])? $this->_data[$name]: null ;
            }

            return $this->$name;
        }

        $lcMethod = strtolower($method);
        if (substr($lcMethod, 0, 6) == 'findby') {
            $by = substr($method, 6, strlen($method));
            $method = 'findBy';
            $one = false;
        } else if(substr($lcMethod, 0, 9) == 'findoneby') {
            $by = substr($method, 9, strlen($method));
            $method = 'findOneBy';
            $one = true;
        }

        if (isset($by)) {
            if (!isset($params[0])) {
                throw new Exception('You must specify the value to ' . $method);
            }

            /*if ($one) {
                $fieldName = static::_resolveFindByFieldName($by);
                if(false == $fieldName) {
                    throw new Exception('Column ' .$fieldName .' not found!');
                }
            }*/

            return static::findBy($by, $params, $one);
        }
    }

    public function __set($name, $value) {
        if (isset(static::$_schema[$name])) {
            $this->_data[$name] = $this->fixData($value, static::$_schema[$name]);
            $this->_modifiedCols[$name] = true;
        } else {
            $this->$name = $value;
        }
    }

    public function __get($name) {
        if (isset(static::$_schema[$name])) {
            return $this->_data[$name];
        }

        return $this->$name;
    }

    public function __isset($name) {
        return (isset($this->_data[$name]))? true : isset($this->$name);
    }

    public function __unset($name) {
        if (isset(static::$_schema[$name])) {
            unset($this->_data[$name]);
        } else {
            unset($this->$name);
        }
    }

    public static function __callStatic($method, $params) {
        $lcMethod = strtolower($method);
        if (substr($lcMethod, 0, 6) == 'findby') {
            $by = substr($method, 6, strlen($method));
            $method = 'findBy';
            if (isset($by)) {
                if (!isset($params[0])) {
                    throw new Exception('You must specify the value to ' . $method);
                }

                return static::findBy($by, $params);
            }
        }

        $lcMethod = strtolower($method);
        if (substr($lcMethod, 0, 9) == 'findoneby') {
            $by = substr($method, 9, strlen($method));
            $method = 'findOneBy';

            if (isset($by)) {
                if (!isset($params[0])) {
                    throw new Exception('You must specify the value to ' . $method);
                }

                /*$fieldName = static::_resolveFindByFieldName($by);
                if(false == $fieldName) {
                    throw new Exception('Column ' .$fieldName .' not found!');
                }*/

                return static::findBy($by, $params, true);
            }
        }
    }

    public function validate() {
        $this->clearErrors();
        $this->_beforeValidate();
        $unique = array();
        //thay thế static::$_validate bằng validate get

        //print_r(static::$_validate);exit;
        foreach (static::$_validate as $name => $rules) {

            $isNull = false;
            //check not null
            if (isset($rules['require']) && ValidatorUtil::isEmpty($this->$name)) {
                if (isset(static::$_schema[$name]['default']) && null != static::$_schema[$name]['default']) {
                    $this->$name = static::$_schema[$name]['default'];
                } else {
                    $isNull = true;
                    $this->setValidationFailure($name, $rules['require']); //$rules['require'] store message
                }
            }
            //check allow value for enum type
            if (!$isNull && isset($rules['filter']) && !ValidatorUtil::isEmpty($this->$name)
                && !in_array($this->$name, $rules['filter']['allow'])) {
                $this->setValidationFailure($name, $rules['filter']['message']);
            }
            if (!$isNull && isset($rules['length']) && 'string' == static::$_schema[$name]['type']
                && !ValidatorUtil::isEmpty($this->$name) && mb_strlen($this->$name) > $rules['length']['max']) {
                $this->setValidationFailure($name, $rules['length']['message']);
            }
            //check unique
            if (isset($rules['unique']))
                $unique[$name] = $rules;

            //check type
            if(isset($rules['type'])){
                 //is_numeric()
                switch ($rules['type']){
                    case 'number':
                        if(!is_numeric($this->$name))
                            $this->setValidationFailure($name,$name.' must be a number');
                        break;
                    case 'email':
                        if(false === ValidatorUtil::isValidEmail($this->$name)){
                            $this->setValidationFailure($name,$name.' must be a email');
                        }
                        break;
                }
            }

            //check patent
            if(isset($rules['patent'])){

                if(!preg_match($rules['patent'], $this->$name)){
                    $this->setValidationFailure($name, $name.' does not matched patent');
                }
            }

        }

        if (!empty($unique)) {
            $where = array();
            $params = array();
            foreach ($unique as $name => $mess) {
                $where[] = static::getTableName().".{$name} = ?";
                $params[] = $this->$name;
            }

            if (!$this->isNew()) {
                $where[] = static::getTableName().'.' .static::getPrimaryKeyField() .' != ?';
                $params[] = static::getPkValue();
            }
            $where = implode(' AND ', $where);

            $data = static::read()->select(implode(',', array_keys($unique)))
                ->where($where)
                ->setMaxResults(1)
                ->setParameters($params)
                ->execute()
                ->fetch(\PDO::FETCH_ASSOC);

            if ($data) {
                foreach ($data as $field => $value) {
                    if($this->$field == $value)
                        $this->setValidationFailure($field, static::$_validate[$field]['unique']);
                }
            }
        }
        
        $this->_afterValidate();

        $this->_valid = empty($this->_validationFailures);
        return $this->isValid();
    }
}