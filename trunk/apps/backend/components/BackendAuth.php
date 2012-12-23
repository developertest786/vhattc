<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 26/11/2012
 * Time: 09:03
 * To change this template use File | Settings | File Templates.
 */
class BackendAuth extends UserAuth
{
    const ERROR_NOT_STAFF = 1012;

    public function init() {
        parent::init();
        if ($this->isAuthenticated() && !Ming_Factory::getSession()->get('auth\staff_auth'))
            $this->_setIsAuthenticated(false);

    }

    public function authenticate($username, $password, $remember = false) {
        parent::authenticate($username, $password, $remember = false);

        if ($this->isAuthenticated()) {
            if (!$this->getUser()->is_staff) {
                $this->_error[] = self::ERROR_NOT_STAFF;
                $this->_setIsAuthenticated(false);
            } else {
                $_SESSION['auth']['staff_auth'] = true;
            }

        }

        return $this->isAuthenticated();
    }

}