<?php
abstract class FrontendController extends \Flywheel\Controller\WebController {
    /**
     * @var Language
     */
    public $language;
    public function beforeExecute() {
        $this->language = \Flywheel\Base::getApp()->language;
    }
}
