<?php
namespace Flywheel\Application;

abstract class BaseApp extends \Flywheel\Object
{
    const TYPE_WEB = 1;
    const TYPE_CONSOLE = 2;
    const TYPE_API = 3;

    /**
     * Controller
     *
     * @var \Flywheel\Controller\BaseController
     */
    protected $_controller;

    /**
     * application type (Web|Console|API)
     * @var int
     */
    protected $_type;

    protected $_basePath;

    public function __construct($config, $type) {
        if (is_string($config)) {
            $config = require $config;
        }

        if (isset($config['app_path'])) {
            $this->setBasePath($config['app_path']);
            \Flywheel\Base::setAppPath($config['app_path']);
            \Flywheel\Loader::setPathOfAlias('app', \Flywheel\Base::getAppPath());
            \Flywheel\Loader::setPathOfAlias('public', dirname($_SERVER['SCRIPT_FILENAME']));
            unset($config['app_path']);
        } else {
            throw new \Flywheel\Exception('Application: missing application\'s config "app_path"');
        }

        if (isset($config['import'])) {
            $this->_import($config['import']);
            unset($config['import']);
        }

        $this->_type = $type;

        $this->preInit();
        $this->configuration($config);
        $this->_init();
        $this->afterInit();
    }

    private function _import($aliases) {
        if (is_array($aliases) && ($size = sizeof($aliases)) > 0) {
            for ($i = 0; $i < $size; ++$i)
                \Flywheel\Loader::import($aliases[$i]);
        }
    }

    public function preInit() {
        $this->getEventDispatcher()->dispatch('onBeginRequest', new \Flywheel\Event\Common($this));
    }

    public function configuration($config, $value = null) {
        if (is_array($config)) {
            foreach ($config as $name => $value) {
                $this->setParameter($name, $value);
            }
        } else if(null != $value) {
            $this->setParameter($config, $value);
        }
    }

    public function setParameter($name, $value) {
        $setter = 'set' .ucfirst($name);
        if (method_exists($this, $setter))
            $this->$setter($value);
        else
            \Flywheel\Config\Handler::set($name, $value);
    }

    /**
     * set controllers
     *
     * @param \Flywheel\Controller\BaseController $controller
     * @throws \Flywheel\Exception
     */
    public function setController($controller) {
        if (!$controller instanceof \Flywheel\Controller\BaseController) {
            throw new \Flywheel\Exception("Application: Controller was assigned is not instance of '\\Flywheel\\Controller\\'");
        }

        $this->_controller = $controller;
    }

    protected function _init() {}

    public function afterInit() {
        $this->getEventDispatcher()->dispatch('onEndRequest', new \Flywheel\Event\Common($this));
    }

    public abstract function run();

    /**
     * get type of this application
     * @see BaseApp::TYPE_WEB, BaseApp::TYPE_CONSOLE, BaseApp::TYPE_API
     * @return int
     */
    public function getType() {
        return $this->_type;
    }

    public function setBasePath($path)
    {
        if(($this->_basePath=realpath($path))===false || !is_dir($this->_basePath))
            throw new \Flywheel\Exception("Application: Base path \"{$path}\" is not a valid directory.");
    }
}
