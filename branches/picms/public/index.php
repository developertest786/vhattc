<?php
use Flywheel\Base;

require_once __DIR__ .'/../bootstrap.php';
//require application bootstrap
$config = require ROOT_PATH .'/apps/frontend/config/main.cfg.php';

try {
    Base::$registry['WebApp'] = 'PiApplication';
    $app = Base::createWebApp($config, Base::ENV_DEV, true);
    /* @var PiApplication $app */
    $app->routing();
    $app->loadLanguage();
    $app->run();
}  catch (Exception $e) {
//    Ming_Exception::printExceptionInfo($e);
    print_r($e);
}

