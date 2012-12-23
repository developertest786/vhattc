<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 22/11/2012
 * Time: 14:45
 * To change this template use File | Settings | File Templates.
 */

class AuthController extends FrontendController {
    private $public_path = '';
    private $frontendAuth = '';
    public function beforeExecute() {
        parent::beforeExecute();
        $this->public_path = Ming_Factory::getDocument()->getPublicPath();
        $this->frontendAuth = new FrontendAuth();
    }
    public function executeDefault() {}
    public function executeSignIn() {

        $this->setLayout('default');
        $this->setView('login');

        $cr_user = Ming_Factory::getSession()->get('auth');
        if($cr_user){
            $this->getRequest()->redirect($this->base_url);
        }

        $user = $this->getRequest()->post('username');
        $pass = $this->getRequest()->post('password');

        if('POST' == $this->getRequest()->getMethod()){
            if(true === $this->frontendAuth->authenticate($user,$pass,false)){
                $this->getRequest()->redirect($this->public_path);
            }else{
                Ming_Factory::getView()->assign('error',$this->backendAuth->getError());
            }
        }
    }
    public function executeSignOut() {
        FrontendAuth::getInstance()->logout();
        $this->getRequest()->redirect($this->public_path.'auth/sign_in');
    }
    public function executeOAuthen(){
        $params = Ming_Factory::getRouter()->getParams();
        $type = $params[0];
        $url = $this->frontendAuth->authenWith($type);
        $this->getRequest()->redirect($url);
    }
}
