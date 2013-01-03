<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 24/11/2012
 * Time: 12:24
 * To change this template use File | Settings | File Templates.
 */
class UserAuth extends \Flywheel\Session\Authenticate
{
    const ERROR_USER_BLOCKED = 101;
    const ERROR_USER_BANNED = 102;
    const ERROR_USER_NOT_ALLOW = 103;
    public $cookieSupport;
    protected static $_instance;

    public function init() {
        $session = \Flywheel\Factory::getSession();
        if (null != ($id = $session->get('auth\id'))) {
            if (Users::findOneById($id)) {
                $this->_setIsAuthenticated(true);
                $this->setIdentity($session->get('auth\username'));
            }
        } else {
            $this->_authenticateByCookie();
        }
    }
    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function authenticate($username, $password, $remember = false) {
        if (null == $username || null == $password) {
            $this->_error[] = self::ERROR_UNKNOWN_IDENTITY;
            return false;
        }

        $this->_identity = $username;
        $this->_credential = $password;
        $this->cookieSupport = $remember;

        $user = new Users();
        //$user->findOneBy('username',array($username));

        $user_data = $user->findOneByUsername($username);

        //print_r($user_data);exit;
        if (!$user_data) {

            $this->_error[] = self::ERROR_USERNAME_INVALID;
            return false;
        }
        // compare password here
        if(false === self::comparePassword($password,$user_data->password)){

            $this->_error[] = self::ERROR_PASSWORD_INVALID;
            return false;
        }
        \Flywheel\Factory::getSession()->set('auth', $user_data->getAttributes('id,username'));
        if ($remember)
            $this->writeCookie();
        $this->_setIsAuthenticated(true);

        return $this->isAuthenticated();
    }

    public function logout() {
        \Flywheel\Factory::getSession()->remove('auth');
        \Flywheel\Factory::getCookie()->clear('auth');
    }

    protected function _authenticateByCookie() {
        $cookie = \Flywheel\Factory::getCookie();
        $data = $cookie->readSecure('auth');
        if (null == $data)
            return false;

        $data = explode(':', base64_decode($data));
        if (sizeof($data) != 2)
            return false;
        $user = new Users();
        if ($user->findOneByUsername($data[0]) && sha1($user->secret) == $data[1]) {
            \Flywheel\Factory::getSession()->set('auth',$user->getAttribute('id,username'));
            $this->_setIsAuthenticated(true);
            return true;
        }
        $cookie->clear('auth'); //cookie invalid!
        return false;
    }

    /**
     *
     * Set cookie to Browser from session
     *
     */
    public function writeCookie() {
        $cookie = \Flywheel\Factory::getCookie();
        if (!($user = $this->getUser()))
            return false;
        $cookie->writeSecure('auth', base64_encode($user->username .':' . sha1($user->secret)));
    }

    /**
     * Get object model user of this authen object
     *
     * @return Users | false
     */
    public static function getUser() {
        if (!self::getInstance()->isAuthenticated()){
            return false;
        }

        return Users::retrieveByPk(\Flywheel\Factory::getSession()->get('auth\id'));
    }
    /**
	 * Compare password input password with encryted pass included salt string	 
	 * @param string	$inputPass
	 * @param string	$encrytedPass
	 * 
	 * @return boolean
	 */
	public static function comparePassword($inputPass, $encrytedPass) {

		$salt = substr($encrytedPass, 0, 40);

		$md5Pass = substr($encrytedPass, 40, 32);

		return md5($salt .$inputPass) == $md5Pass;
	}
    /**
	 * reset session user by data from database
	 */
	public function resetSessionUserFromDb() {
		if (false === $this->isAuthenticated()) {
			return false;
		}
		$user = @Users::retrieveByPk($_SESSION['user']['id']);
		$this->resetSessionUser($user);
	}
    public static function getSession($key){
        return @$_SESSION[$key]['_data'];
    }

    public static function errorLabel($error){
        $label[] = '';
        if(is_array($error)){
            foreach($error as $_err){
                switch($_err){
                    case self::ERROR_USERNAME_INVALID :
                        $label[] = 'Invalid username';
                        break;
                    case self::ERROR_PASSWORD_INVALID:
                        $label[] = 'Invalid password';
                        break;
                    case self::ERROR_USER_BANNED:
                        $label[] = 'Your account was banned';
                        break;
                    case self::ERROR_USER_BLOCKED:
                        $label[] = 'Your account was blocked';
                        break;
                    case self::ERROR_USER_NOT_ALLOW:
                        $label[] = 'You do not have permission to access this area';
                        break;
                }
            }
        }


        return $label;
    }
}
