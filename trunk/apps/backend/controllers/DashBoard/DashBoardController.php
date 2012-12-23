<?php
class DashBoardController extends BackendController {
    public function executeDefault() {
        $this->setLayout('head_footer');
        $this->setView('login');
    }
}