<?php
require dirname(__FILE__) .'/../../bootstrap.php';
$config = dirname(__FILE__) .'/../../apps/api/configs/main.cfg.php';
use \Flywheel\Base;
try {
    $app = Base::createApiApp($config, Base::ENV_DEV, true)->run();
} catch (\Exception $ex) {
    \Flywheel\Exception\Api::printExceptionInfo($ex);
}