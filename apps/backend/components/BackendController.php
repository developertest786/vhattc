<?php
abstract class BackendController extends \Flywheel\Controller\WebController {
    public function beforeExecute() {
        $auth = UserAuth::getInstance();
        if (!($user = $auth->getUser())) {
            $this->request()->redirect('sign_in');
        } else{
            $roles = $user->getRoles();
            if (!isset($roles[5])
                && !isset($roles[6])
                && !isset($roles[7])
                && !isset($roles[8])) {
                $this->request()->redirect('sign_in');
            }
        }
    }
}
