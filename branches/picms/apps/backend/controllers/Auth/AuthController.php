<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 22/11/2012
 * Time: 14:45
 * To change this template use File | Settings | File Templates.
 */
class AuthController extends \Flywheel\Controller\WebController {

    public function executeDefault() {
        return $this->executeSignIn();
    }

    public function executeSignIn() {
        $this->setLayout('login');
        $this->setView('login_form');
        $auth = UserAuth::getInstance();
        if (($user = $auth->getUser())) {
            $roles = $user->getRoles();
            if (isset($roles[5])
                || isset($roles[6])
                || isset($roles[7])
                || isset($roles[8])) {
                $this->request()->redirect($this->document()->getBaseUrl());
            }
        }

        $username = $this->request()->post('username');
        $password = $this->request()->post('password');
        $this->view()->assign('username' ,$username);
        if('POST' == $this->request()->getMethod()){
            $error = array();
            if(true !== $auth->authenticate($username, $password, false)){
                $error = $auth->getError();
            }else{
                $roles = $auth->getUser()->getRoles();
                if (!isset($roles[5])
                    && !isset($roles[6])
                    && !isset($roles[7])
                    && !isset($roles[8])) {
                    $error[] = UserAuth::ERROR_USER_NOT_ALLOW;
                }
            }

            if (empty($error)) {
                $this->request()->redirect($this->document()->getBaseUrl());
            } else {
                $this->view()->assign('error', $error);
            }
        }
    }

    public function executeSignOut() {
        UserAuth::getInstance()->logout();
        $this->request()->redirect($this->document()->getBaseUrl());
    }

}
