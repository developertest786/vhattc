<?php
/**
 * Session Handler Interface
 * 
 * @author		Luu Trong Hieu <hieuluutrong@vccorp.vn>
 * @version		$Id: Interface.php 1836 2010-07-20 17:07:21Z hieult $
 * @package		t90
 * @subpackage	Session/Handler
 *
 */
namespace FlyWheel\Session\Handler;
interface Session_Handler_Interface {
	/**
     * Opens session
     *
     * @param string $savePath ignored
     * @param string $sessName ignored
     * @return bool
     */
    public function open($savePath, $sessName);

    /**
     * Fetches session data
     *
     * @param  string $sid
     * @return string
     */
    public function read($sid);

    /**
     * Closes session
     *
     * @return bool
     */
    public function close();

    /**
     * Updates session.
     *
     * @param  string $sid Session ID
     * @param  string $data
     * @return bool
     */
    public function write($sid, $data);

    /**
     * Destroys session provided with ID.
     *
     * @param  string $sid
     * @return bool
     */
    public function destroy($sid);

    /**
     * Garbage collection
     *
     * @param  int $sessMaxLifeTime
     * @return bool
     */
    public function gc($sessMaxLifeTime);
}