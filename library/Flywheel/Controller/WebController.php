<?php
namespace Flywheel\Controller;
use Flywheel\Factory;
use Flywheel\Base;
use Flywheel\Util\Inflection;
use Flywheel\Config\Handler as ConfigHandler;
use \Flywheel\Event\Common as Event;

abstract class WebController extends BaseController
{
    protected $_name;

    protected $_path;
    /**
     * Render Mode
     *
     * @var string
     */
    protected $_renderMode = 'NOT_SET';

    protected $_view;
    protected $time;
    public function __construct($name, $path) {
        parent::__construct($name, $path);
        $this->_view = $this->_path .'default';
        $this->time		= time();
    }

    /**
     * Redirects the browser to the specified URL.
     * @param string $url URL to be redirected to. If the URL is a relative one, the base URL of
     * the application will be inserted at the beginning.
     * @param int $code the HTTP status code. Defaults to 302. See {@link http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html}
     * @param bool $end whether to terminate the current application
     */
    public function redirect($url, $code = 302, $end = true) {
        $this->request()->redirect($url, $code, $end);
    }

    /**
     * Check Xml HTTP Request (Ajax) else end application
     * @param bool $end
     * @param string $endMess
     * @return bool
     */
    public function validAjaxRequest($end = true, $endMess = 'Invalid request!') {
        $valid = $this->request()->isXmlHttpRequest();
        if ($valid) {
            return true;
        }

        if ($end) {
            Base::end($endMess);
        }
    }

    /**
     * @return \Flywheel\Document\Html
     */
    public function document() {
        return Factory::getDocument('html');
    }

    /**
     * @return \Flywheel\View\Render
     */
    public function view() {
        return Factory::getView();
    }

    public function beforeExecute() {}

    /**
     * Execute
     *
     *
     * @throws \Flywheel\Exception\NotFound404
     * @return string component process result
     */
    final public function execute() {
//        $this->getEventDispatcher()->dispatch('onBeginControllerExecute', new Event($this));
        /* @var \Flywheel\Router\WebRouter $router */
        $router = Factory::getRouter();
        $action = 'execute' . Inflection::camelize($router->getAction());

        if (!method_exists($this, $action))
            throw new \Flywheel\Exception\NotFound404("Controller: Action \"". $router->getController().'/'.$action ."\" doesn't exist");

        $this->beforeExecute();
        $this->_beforeRender();
        $buffer = $this->$action();

        if ('NO_RENDER' == $this->_renderMode) {
            $buffer = null;
        } elseif('NOT_SET' == $this->_renderMode) {
            $buffer = $this->renderComponent();
        }
        $this->_afterRender();
        $this->afterExecute();
//        $this->getEventDispatcher()->dispatch('onAfterControllerExecute', new Event($this));
        return $buffer;
    }

    public function afterExecute() {}


    /**
     * forward request handler to another action
     *     rule:     - action's forwarded in same application
     *             - cannot use component define or remap
     *
     * @param string    $controllerPath path to controllers
     *                         (not include "controllers"). example: 'User/Following'
     * @param string    $action action name
     * @param array        $params
     *
     * @throws Exception
     * @throws \Flywheel\Exception\NotFound404
     * @return string
     */
    final public function forward($controllerPath, $action, $params = array()) {
        $this->getEventDispatcher()->dispatch('onBeginForwardingRequest', new Event($this));
        $controllerPath = rtrim($controllerPath, '/');
        $controllerPath = explode('/', $controllerPath);
        $path = array();
        for ($i = 0, $size = sizeof($controllerPath); $i < $size; ++$i) {
            if ($controllerPath[$i] != null) {
                $controllerPath[$i] = preg_replace('/[^a-z0-9_]+/i', '', $controllerPath[$i]);
                $controllerPath[$i] = Inflection::camelize($controllerPath[$i]);
                if ($i !== ($size-1)) {
                    $path[] = $controllerPath[$i];
                } else {
                    $class  = $controllerPath[$i] .'Controller';
                    $name   = $controllerPath[$i];
                }
            }
        }

        $path = implode(DIRECTORY_SEPARATOR, $path);

        // replace unwanted action's characters
        $action = preg_replace('/[^a-z0-9_]+/i', '', $action);
        $action = 'execute' .$action;

        $file = Base::getAppPath().DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR .$class .'.php';
        if (!file_exists($file))
            throw new Exception("Controller: \"{$path}\" [{$file}] does not exist!");

        require_once $file;

        $controller = new $class($name);
        $controller->_path = $path .DIRECTORY_SEPARATOR;
        $controller->_view = $controller->_path .'default';
        Base::getApp()->setController($controller);

        if (!method_exists($controller, $action))
            throw new \Flywheel\Exception\NotFound404("Action \"{$name}/{$action}\" doesn't exist");
        $buffer = $controller->$action();
        Base::getApp()->setController($controller);

        if (null !== $buffer)
            return $buffer;

        if ('COMPONENT' == $controller->_renderMode) { //Default render Component
            $buffer = $controller->renderComponent();
            Base::getApp()->setController($controller);
            return $buffer;
        }
        $this->getEventDispatcher()->dispatch('onAfterForwardingRequest', new Event($this));
    }

    protected function _beforeRender() {
        $this->getEventDispatcher()->dispatch('onBeforeControllerRender', new Event($this));
    }
    protected function _afterRender() {
        $this->getEventDispatcher()->dispatch('onAfterControllerRender', new Event($this));
    }

    /**
     * Render Partial
     *      only render a web page's partial.
     *
     * @param string
     *
     * @return string
     */
    protected function renderPartial($vars = null) {
        $this->_renderMode = 'PARTIAL';
        $view = Factory::getView();
        $viewFile = Base::getApp()->getTemplatePath() .'/controllers/' .$this->_view;
        return $view->render($viewFile, $vars);
    }

    /**
     * Render Component
     *      render web page
     *
     * @return string
     */
    protected function renderComponent() {
        $buffer = $this->renderPartial();
        $this->_renderMode = 'COMPONENT';

        return $buffer;
    }

    /**
     * Render Text
     *
     * @param string $text
     * @return string
     */
    protected function renderText($text) {
        $this->_renderMode = 'TEXT';
        return $text;
    }

    /**
     * set no render
     * set action not render view
     *
     * @param boolean $render
     */
    protected function setNoRender($render) {
        if (true === $render) {
            $this->_renderMode = 'NO_RENDER';
        }
    }

    /**
     * Set Layout
     *      set layout templates
     *
     * @param string $layout
     */
    public function setLayout($layout) {
        $application = Base::getApp();
        if ($application instanceof \Flywheel\Application\WebApp) {
            $application->setLayout($layout);
        }
    }

    /**
     * Get current layout templates
     *
     * @return mixed: string|null
     *
     */
    public function getLayout() {
        $application = Base::getApp();
        if ($application instanceof \Flywheel\Application\WebApp) {
            return $application->getLayout();
        }

        return null;
    }

    /**
     * Set view
     *
     * @param string $view
     */
    protected function setView($view) {
        $this->_view = $this->_path.$view;
    }

    /**
     * set full path of view file
     *
     * @param string $view
     */
    protected function setFullPathView($view) {
        $this->_view = $view;
    }

    abstract public function executeDefault();

    /**
     * Get Render Mode
     *
     * @return string
     */
    final public function getRenderMode() {
        return $this->_renderMode;
    }
}