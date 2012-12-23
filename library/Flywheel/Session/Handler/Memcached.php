<?php
/**
 * Ming Session Handler Memcached
 * 	store session on memcache
 * 
 * @author		Luu Trong Hieu <hieuluutrong@vccorp.vn>
 * @version		$Id: Memcached.php 2851 2010-08-16 11:03:52Z hieult $
 * @package		Ming
 * @subpackage	Session/Handler
 *
 */
namespace FlyWheel\Session\Handler;
class Session_Handler_Memcached implements Session_Handler_Interface {
	private $_config;
	/**
	 * Memcached driver
	 * 
	 * @var Memcache
	 */
	protected $_driver;
	
	public function __construct($config) {
		$this->_config = $config;
	}
	
	/**
	 * Get Memcached driver
     * @return Memcache
     */
	public function getDriver() {
		return $this->_driver;		
	}

    /**
     * Opens session
     *
     * @param string $savePath ignored
     * @param $sessionName
     * @internal param string $sessName ignored
     * @return boolean
     */
	public function open($savePath, $sessionName) {	
		$this->_driver = new Memcache();
		if (isset($this->_config['servers'])) {
			$servers = $this->_config['servers'];
			
			for($i = 0, $size = sizeof($servers); $i < $size; ++$i) {
				$t = explode(':', $servers[$i]);
				$this->_driver->addserver($t[0], $t[1]);
			}
		}
		else {
			$this->_driver->addserver('127.0.0.1', 11211);
		}
		
		return true;
	}
	
	/**
     * Fetches session data
     *
     * @param  string $sid
     * @return string
     */
	public function read($sid) {
		$value = $this->_driver->get($sid);
		if ($value !== false) {
			if ($value['last_modified'] + $this->_config['lifetime'] > time()) {
				return $value['data'];
			}
			$this->destroy($sid);
		}
		
		return null;
	}
	
	/**
     * Write session.
     *
     * @param  string $sid Session ID
     * @param  string $data
     * @return bool
     */
	public function write($sid, $data) {
		$data = array (
			'last_modified' => time(),
			'data'	=> $data
		);
		
		$this->_driver->set($sid, $data, MEMCACHE_COMPRESSED);
	}
	
	/**
     * Closes session
     *
     * @return bool
     */
    public function close() {
    	$this->_driver->close();    	
    }
	
    /**
     * Destroy Session Id
     * 
     * @param $sid
     */
	public function destroy($sid) {
		$this->_driver->delete($sid);		
	}
	
	/**
	 * Garbage Collection
	 * @param integer $sessMaxLifeTime
     * @return bool
     */
	public function gc($sessMaxLifeTime) {
		return true;	
	}
}