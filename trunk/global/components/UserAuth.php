<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 24/11/2012
 * Time: 12:24
 * To change this template use File | Settings | File Templates.
 */
class UserAuth extends \Flywheel\Authenticate
{
    const ERROR_USER_BLOCKED = 101;
    const ERROR_USER_BANNED = 102;
    public $cookieSupport;
    protected static $_instance;

    public function init() {
        $session = Ming_Factory::getSession();
        if (null != ($id = $session->get('auth\id'))) {
            if (Users::retrieveByPk($id)) {
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
        $user->findOneBy('username',array($username));

        if (!$user) {

            $this->_error[] = self::ERROR_USERNAME_INVALID;
            return false;
        }
        // compare password here
        if(false === self::comparePassword($password,$user->password)){

            $this->_error[] = self::ERROR_PASSWORD_INVALID;
            return false;
        }

        Ming_Factory::getSession()->set('auth', $user->getAttributes('id,username'));
        if ($remember)
            $this->writeCookie();
        $this->_setIsAuthenticated(true);

        return $this->isAuthenticated();
    }

    public function logout() {
        Ming_Factory::getSession()->remove('auth');
        Ming_Factory::getCookie()->clear('auth');
    }

    protected function _authenticateByCookie() {
        $cookie = Ming_Factory::getCookie();
        $data = $cookie->readSecure('auth');
        if (null == $data)
            return false;

        $data = explode(':', base64_decode($data));
        if (sizeof($data) != 2)
            return false;
        $user = new Users();
        if ($user->findOneByUsername($data[0]) && sha1($user->secret) == $data[1]) {
            Ming_Factory::getSession()->set('auth',$user->getAttribute('id,username'));
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
        $cookie = Ming_Factory::getCookie();
        if (!($user = $this->getUser()))
            return false;
        $cookie->writeSecure('auth', base64_encode($user->username .':' . sha1($user->secret)));
    }

    /**
     * Get object model user of this authen object
     *
     * @return Users | false
     */
    public function getUser() {
        if (!$this->isAuthenticated())
            return false;

        return Users::retrieveByPk(Ming_Factory::getSession()->get('auth\id'));
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
                        $label[] = 'Tên đăng nhập không đúng';
                        break;
                    case self::ERROR_PASSWORD_INVALID:
                        $label[] = 'Mật khẩu không đúng';
                        break;
                    case self::ERROR_USER_BANNED:
                        $label[] = 'Người dùng này đã bị band';
                        break;
                    case self::ERROR_USER_BLOCKED:
                        $label[] = 'Người dùng này đã bị khóa';
                        break;
                }
            }
        }


        return $label;
    }
}
