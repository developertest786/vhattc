<?php
namespace Flywheel\Application;
use Flywheel\Factory;
use Flywheel\Base;
use Flywheel\Event\Common as Event;
use Flywheel\Config\Handler as ConfigHandler;

class WebApp extends BaseApp
{
    /**
     * Page layout
     *
     * @var $_layout string
     */
    protected $_layout = 'default';

    protected $_template = '';

    protected $_viewPath;

    public function setViewPath($viewPath)
    {
        $this->_viewPath = $viewPath;
    }

    public function getViewPath()
    {
        return $this->_viewPath;
    }

    public function setTemplate($template) {
        if (!is_dir($this->_viewPath .DIRECTORY_SEPARATOR .$template)) {
            throw new \Flywheel\Exception("'{$template}' not existed in {$this->_viewPath} or 'viewPath' not set");
        }

        $this->_template = $template;
    }

    public function getTemplatePath() {
        return $this->_viewPath .DIRECTORY_SEPARATOR .$this->_template;
    }

    public function getTemplateName() {
        return $this->_template;
    }

    /**
     * Initialize
     *
     * @return void
     */
    protected function _init() {
        parent::_init();
        \Flywheel\Loader::setPathOfAlias('template', $this->_viewPath .DIRECTORY_SEPARATOR .$this->_template);
        ini_set('display_errors',
            (ConfigHandler::get('debug') || (Base::ENV_DEV == Base::getEnv()))
                ? 'on' : 'off');

        if (Base::getEnv() == Base::ENV_DEV)
            error_reporting(E_ALL);
        else if (Base::getEnv() == Base::ENV_TEST)
            error_reporting(E_ALL ^ E_NOTICE);

        if (ConfigHandler::has('timezone'))
            date_default_timezone_set(ConfigHandler::get('timezone'));
        else
            date_default_timezone_set(@date_default_timezone_get());
    }

    /**
     * Get Layout
     *
     * @return string application layout
     */
    public function getLayout() {
        return $this->_layout;
    }

    /**
     * Set layout
     * @param string $layout
     */
    public function setLayout($layout) {
        $this->_layout = $layout;
    }

    public function run() {
        //@TODO start session here
        $buffer = $this->_loadController();

        $renderMode = $this->_controller->getRenderMode();
        switch ($renderMode) {
            case 'TEXT':
            case 'PARTIAL':
                $response = Factory::getResponse();
                $response->setBody($buffer);
                $response->send();
                break;
            case 'COMPONENT':
                $this->_renderPage($buffer);
                break;
            default:
                break;
        }
        $this->getEventDispatcher()->dispatch('onBeginRequest', new Event($this));
    }

    /**
     * @param bool $isRemap
     * @throws \Flywheel\Exception\NotFound404
     * @param bool $isRemap
     * @return mixed
     */
    private function _loadController($isRemap = false) {
        /* @var \Flywheel\Router\WebRouter $router */
        $router 		= \Flywheel\Factory::getRouter();
        $controllerName	= $router->getCamelControllerName();
        $className		= $controllerName .'Controller';
        $controllerPath	= $router->getControllerPath();
        if (file_exists(($file = $this->_basePath.DIRECTORY_SEPARATOR
            .'controllers'.DIRECTORY_SEPARATOR.$controllerPath.$className.'.php'))){
            require_once $file;
        } else {
            throw new \Flywheel\Exception\NotFound404("Application: Controller \"{$controllerName}\"[{$file}] does not existed!");
        }
        $this->_controller = new $className($controllerName, $controllerPath);

        return $this->_controller->execute();
    }

    /**
     * @param $buffer
     * @throws \Exception
     * @return void
     */
    protected function _renderPage($buffer) {
        //@TODO Addition document object and register it in factory
        $document = Factory::getDocument();
        $response = Factory::getResponse();

        $document->setBuffer($buffer, 'component');

        //@TODO same as view
        $view = Factory::getView();

        if ($this->_layout == null) {
            $config = ConfigHandler::get('templates');
            $this->_layout = (isset($config['default_layout']))?
                $config['default_layout'] : 'default'; //load default layout
        }

        ob_start();
        ob_implicit_flush(0);
        try	{
            $view->display($this->getTemplatePath() .'/' .$this->_layout);
        }
        catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }
        $content = ob_get_clean();
        if ($document->getMode() == \Flywheel\Document\Html::MODE_ASSETS_END) {
            $content = $document->disbursement($content);
        }
        $response->setBody($content);
        $response->send();
    }
}
