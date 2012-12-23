<?php
namespace FlyWheel\Session\Handler;
class Session_Handler_MongoDb implements Session_Handler_Interface {
	private $_config;
	/**
	 * Memcached driver
	 *
	 * @var Mongo
	 */
	protected $_driver;
	
	/**
	 * 
	 * @var MongoDb
	 */
	protected $_db;
	
	protected $_collection;
	
	protected $_session;
	
	public function __construct($config) {			
		$this->_config = $config;
		$this->_init();
	}
	
	private function _init() {
		$options = array();
		if (isset($this->_config['persist']) && true == $this->_config['persist']) {
			$options['persist'] = (isset($this->_config['persist_key']) && !empty($this->_config['persist_key']))?
			$this->_config['persist_key'] : 'mongo_persist';
		}
		if (!isset($this->_config['server'])) {
			$this->_config['server'] = 'localhost';
		}
		
		if (!isset($this->_config['db']) || empty($this->_config['db'])) {
			throw new \Flywheel\Session\Exception("MongoDbHandler: config database 'db' not found.");
		}
		
		if (!isset($this->_config['collection']) || empty($this->_config['collection'])) {
			throw new \Flywheel\Session\Exception("MongoDbHandler: config collection 'collection' not found.");
		}
		
		$this->_driver = new Mongo($this->_config['server'], $options);
		
		$this->_db	= $this->_driver->selectDB($this->_config['db']);
		$this->_collection = $this->_db->selectCollection($this->_config['collection']);
		
		// proper indexing on the expiration
		$this->_collection->ensureIndex(array('expiry' => 1),
		array('name' => 'expiry',
										'unique' => true,
										'dropDups' => true,
										'safe' => true));
		
		// proper indexing of session id and lock
		$this->_collection->ensureIndex(array('session_id' => 1, 'lock' => 1),
								array('name' => 'session_id',
									'unique' => true,
									'dropDups' => true,
									'safe' => true));
		
		return true;
	}
	
	/**
	 * return handler's driver
	 * 
	 * @return Mongo
	 */
	public function getDriver() {
		return $this->_driver;	
	}
	
	/**
	 * @return MongoDB
	 */
	public function getSessionDb() {
		return $this->_db;		
	}
	
	/**
	* Opens session
	*
	* @param string $savePath ignored
	* @param string $sessName ignored
	* @return bool
	*/
	public function open($savePath, $sessionName) {
		return true;
	}
	
	/**
	* Fetches session data
	*
	* @param  string $sid
	* @return string
	*/
	public function read($sid) {
		// obtain a read lock on the data, or subsequently wait for
		// the lock to be released
		//$this->_lock($sid);
		
		$result = $this->_collection->findOne(
			array(
				'session_id' => $sid,
				'expiry' => array('$gte' => time()),
				'active' => 1
			)
		);		
		if (isset($result['data'])) {
			$this->_session = $result;
			return $result['data'];
		}

		return '';
	}
	
	/**
	* Write session.
	*
	* @param  string $sid Session ID
	* @param  string $data
	* @return bool
	*/
	public function write($sid, $data) {
		//create expires
		$expiry = time() + $this->_config['lifetime'];			
		
		$obj = array('data' => $data,
				'lock' => 0,
				'active' => 1,
				'expiry' => $expiry);
		
		if (!empty($this->_session)) {
			$obj = array_merge((array) $this->_session, $obj);
		}
		
		// atomic update
		$query = array('session_id' => $sid);
		
		// update options
		$options = array(
			'upsert' => true,
			'safe' => true,
			'fsync' => true);
		
		// perform the update or insert
		try {
			$result = $this->_collection->update($query, array('$set' => $obj), $options);
			return $result['ok'] == 1;
		} catch (Exception $e) {
			return false;
		}
		
		return true;
	}
	
	/**
	* Closes session
	*
	* @return bool
	*/
	public function close() {
		return true;
	}
	
	/**
	 * Destroy Session Id
	 *
	 * @param $sid
	 */
	public function destroy($sid) {
		$this->_collection->remove(array('session_id' => $sid), true);
	}
	
	/**
	 * Garbage Collection
	 * @param unknown_type $sessMaxLifeTime
	 */
	public function gc($sessMaxLifeTime) {
		// define the query
		$query = array('expiry' => array('$lt' => time()));
		
		// specify the update vars
		$update = array('$set' => array('active' => 0));
		
		// update options
		$options = array('multiple' => true,
				'safe' => true,
				'fsync' => true);
		
		// update expired elements and set to inactive
		$this->_collection->update($query, $update, $options);
		
		return true;
	}
	
	/**
	 * Create a globals lock for the specified document.
	 *
	 * @author Benson Wong (mostlygeek@gmail.com)
	 * @access private
	 * @param string $id
	*/
	private function _lock($id)
	{
		$remaining = 30000000;
		$timeout = 5000;
	
		do {	
			try {	
				$query = array('session_id' => $id, 'lock' => 0);
				$update = array('$set' => array('lock' => 1));
				$options = array('safe' => true, 'upsert' => true);
				$result = $this->_collection->update($query, $update, $options);
				if ($result['ok'] == 1) {
					return true;
				}
	
			} catch (MongoCursorException $e) {
				if (substr($e->getMessage(), 0, 26) != 'E11000 duplicate key error') {
					throw $e; // not a dup key?
				}
			}
	
			// force delay in microseconds
			usleep($timeout);
			$remaining -= $timeout;
	
			// backoff on timeout, save a tree. max wait 1 second
			$timeout = ($timeout < 1000000) ? $timeout * 2 : 1000000;
	
		} while ($remaining > 0);
	
		// aww shit.
		throw new \Flywheel\Session\Exception('Could not obtain a session lock.');
	}
}