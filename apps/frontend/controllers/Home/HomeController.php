<?php
class HomeController extends \Flywheel\Controller\WebController {

    public function executeDefault() {
        echo 'vai~';
        $this->setView('home');
    }

}