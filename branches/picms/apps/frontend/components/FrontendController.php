<?php
abstract class FrontendController extends PiController {
    /**
     * @var Language
     */
    public $language;
    public function beforeExecute() {
        $this->language = \Flywheel\Base::getApp()->selectedLang;
    }
}
