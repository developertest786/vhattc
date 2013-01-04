<?php
defined('APP_PATH') or define('APP_PATH', dirname(__DIR__) .DIRECTORY_SEPARATOR);
defined('FRONTEND_PATH') or define('FRONTEND_PATH', dirname(APP_PATH) .'frontend' .DIRECTORY_SEPARATOR);
return array(
	'app_path' => APP_PATH,
    'frontend_path' => FRONTEND_PATH,
    'viewPath' => APP_PATH .DIRECTORY_SEPARATOR .'templates'.DIRECTORY_SEPARATOR,
    'import' => array(
        'app.components.*',
        'app.extension.*',
        'global.model.*', //if application don't use global models can redefine self model path
        'global.components.*',
        'global.extension.*'
    ),
    'components' => array(),
    'timezone' => 'Asia/Ho_Chi_Minh',
    'csrf_preventing' => true,
    'template' => 'crown'
);