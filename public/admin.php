<?php
require_once dirname(__FILE__) .'./../../bootstrap.php';

//require application bootstrap
$config = require ROOT_PATH .'apps/backend/config/main.cfg.php';

try {
    Ming_Base::createWebApp($config, Ming_Base::ENV_DEV, true)->run();
} catch (Ming_Controller_Error404Exception $e404) {
} catch (Exception $e) {
//    Ming_Exception::printExceptionInfo($e);
    print_r($e);
}