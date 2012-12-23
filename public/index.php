<?php
//ini_set('memory_limit', '-1');
    require_once dirname(__FILE__) .'/../bootstrap.php';

    //require application bootstrap
    $config = require ROOT_PATH .'/apps/frontend/config/main.cfg.php';

try {
    \Flywheel\Base::createWebApp($config, \Flywheel\Base::ENV_DEV, true)->run();
}  catch (Exception $e) {
//    Ming_Exception::printExceptionInfo($e);
    print_r($e);
}

