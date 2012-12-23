<?php
require_once __DIR__ .'./../../bootstrap.php';
require_once __DIR__ .'./../../apps/backend/bootstrap.php';

//require application bootstrap

$config = require ROOT_PATH .'/apps/backend/config/main.cfg.php';

try {
    \Flywheel\Base::createWebApp($config, \Flywheel\Base::ENV_DEV, true)->run();
} catch (\Flywheel\Exception\NotFound404 $e404) {
} catch (\Exception $e) {
//    Ming_Exception::printExceptionInfo($e);
    var_dump($e);
}