<?php
define('ROOT_PATH', __DIR__);
define('GLOBAL_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'global');
define('LIBRARY_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'library');
define('RUNTIME_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'runtime');
define('APP_DIR', ROOT_PATH .DIRECTORY_SEPARATOR .'apps'.DIRECTORY_SEPARATOR);

require_once LIBRARY_PATH .'/Flywheel/Loader.php';
\Flywheel\Loader::register();
\Flywheel\Loader::setPathOfAlias('global', GLOBAL_PATH);
\Flywheel\Loader::setPathOfAlias('library', LIBRARY_PATH);