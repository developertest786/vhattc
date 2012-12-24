<?php
namespace Flywheel;
use Flywheel\Application\BaseApp;
use Flywheel\Config\Handler as ConfigHandler;
class Factory
{
    public static $_overwrite = array();
    private static $_registry = array();

    /**
     * get response
     * @return \Flywheel\Router\BaseRouter
     */
    public static function getRouter() {

        if (isset(self::$_registry['router'])) {
            return self::$_registry['router'];
        }
        //echo Base::getApp()->getType();exit;
        switch(Base::getApp()->getType()) {
            case BaseApp::TYPE_WEB:
                $class = '\\Flywheel\\Router\\WebRouter';
                break;
            case BaseApp::TYPE_API:
                $class = '\\Flywheel\\Router\\ApiRouter';
                break;
        }
        self::$_registry['router'] = new $class();

        return self::$_registry['router'];
    }

    public static function getRequest() {
        if (isset(self::$_registry['request'])) {
            return self::$_registry['request'];
        }

        switch(Base::getApp()->getType()) {
            case BaseApp::TYPE_WEB:
                $class = '\\Flywheel\\Http\\WebRequest';
                break;
            case BaseApp::TYPE_API:
                $class = '\Flywheel\Http\RESTfulRequest';
                break;
        }
        self::$_registry['request'] = new $class();
        return self::$_registry['request'];
    }

    /**
     * get response
     * @return \Flywheel\Http\Response
     */
    public static function getResponse() {
        if (isset(self::$_registry['response'])) {
            return self::$_registry['response'];
        }

        switch(Base::getApp()->getType()) {
            case BaseApp::TYPE_WEB:
                $class = '\Flywheel\Http\WebResponse';
                break;
            case BaseApp::TYPE_API:
                $class = '\Flywheel\Http\RESTfulResponse';
                break;
        }
        self::$_registry['response'] = new $class();
        return self::$_registry['response'];
    }

    /**
     * Get Document
     *
     * @param string $type. Document type default 'html'
     * @return \Flywheel\Document\Html
     */
    public static function getDocument($type = 'html') {
        if (!isset(self::$_registry['document'][$type])) {
            $class = "\\Flywheel\\Document\\" .ucfirst($type);
            self::$_registry['document'][$type] = new $class();
        }

        return self::$_registry['document'][$type];
    }

    /**
     * Get Session
     *
     * @return Session
     */
    public static function getSession() {
        if (!Base::getApp()) {
            throw new \Flywheel\Exception('Factory: Session must start after the application is initialized!');
        }
        if (!isset(self::$_registry['session'])) {
            ($config = ConfigHandler::load('app.config.session', 'session', false)
                or ($config = ConfigHandler::load('global.config.session', 'session')));

            if (false == $config) {
                throw new \Flywheel\Exception('Session: config file not found, "session.cfg.php" must be exist at globals/config or '
                    .\Flywheel\Base::getAppPath() .' config directory');            }

            self::$_registry['session'] = new \Flywheel\Session\Session($config, 'session');
        }
        return self::$_registry['session'];
    }

    /**
     * get Cookie handler
     *
     * @return Cookie
     */
    public static function getCookie() {
        if (!isset(self::$_registry['cookie'])) {
            self::getSession(); //make s$ure that session initialized
            self::$_registry['cookie'] = new \Flywheel\Session\Cookie(ConfigHandler::get('session'));
        }
        return self::$_registry['cookie'];
    }

    /**
     * Get View
     *
     * @param $name default null
     * @return \Flywheel\View\Render
     */
    public static function getView($name = null) {
        if (!isset(self::$_registry['view'.$name])) {
            self::$_registry['view'.$name] = new \Flywheel\View\Render();
        }

        return self::$_registry['view'.$name];
    }
}
