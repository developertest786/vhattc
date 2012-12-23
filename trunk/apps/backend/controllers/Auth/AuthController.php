<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 22/11/2012
 * Time: 14:45
 * To change this template use File | Settings | File Templates.
 */
class AuthController extends \Flywheel\Controller\WebController {
    public $backendAuth = '';
    public $base_url = '';
    public $view = '';

    public function beforeExecute(){
        parent::beforeExecute();
        $this->backendAuth = new BackendAuth;
        $this->request = \FlyWheel\Factory::getRequest();
        $this->base_url = \FlyWheel\Factory::getDocument()->getBaseUrl();
        $this->view = \FlyWheel\Factory::getView();
    }

    public function executeDefault() {
        $this->setLayout('head_footer');
        $this->setView('login');
    }

    public function executeSignIn() {
        $this->setLayout('head_footer');
        $this->setView('login');
        $user = \FlyWheel\Factory::getSession()->get('auth');

        if($user){
            $this->getRequest()->redirect($this->base_url.'user');
        }
        $user = $this->request->post('username');
        $pass = $this->request->post('password');
        if('POST' == $this->getRequest()->getMethod()){
            if(true === $this->backendAuth->authenticate($user,$pass,false)){
                //$authen = BackendAuth::getInstance();
                $this->request->redirect($this->base_url.'user');
            }else{
                \FlyWheel\Factory::getView()->assign('error',$this->backendAuth->getError());
            }
        }
    }
    public function executeSignOut() {
        BackendAuth::getInstance()->logout();
        $this->getRequest()->redirect($this->base_url);
    }

}
