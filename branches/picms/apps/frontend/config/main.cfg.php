<?php
defined('APP_PATH') or define('APP_PATH', dirname(dirname(__FILE__))) .DIRECTORY_SEPARATOR;
return array(
	'app_path'=> APP_PATH,
    'viewPath' => APP_PATH .DIRECTORY_SEPARATOR .'templates/',
    'template' => 'vhattc',
    'import' => array(
        'app.components.*',
        'global.model.*', //if application don't use global models can redefine self model path
        'global.components.*',
        'global.config.*'
    ),
    'components' => array(),
    'timezone' => 'Asia/Ho_Chi_Minh',
);