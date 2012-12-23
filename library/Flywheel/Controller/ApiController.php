<?php
namespace Flywheel\Controller;
use Flywheel\Factory;
use Flywheel\Event\Common as Event;
class ApiController extends BaseController
{
    public function beforeExecute() {}

    final public function execute($regMethod, $method = null) {
        $this->getEventDispatcher()->dispatch('onBeginControllerExecute', new Event($this));
        $apiMethod = strtolower($regMethod) .$method;
        if (!method_exists($this, $apiMethod))
            throw new \Flywheel\Exception\Api('Api '.Factory::getRouter()->getApi() ."/{$method} not found", 404);

        $this->beforeExecute();
        $buffer = $this->$apiMethod();
        $this->afterExecute();

        $this->getEventDispatcher()->dispatch('onAfterControllerExecute', new Event($this));
        return $buffer;
    }

    public function afterExecute() {}

    public function sendResponse($status = 200, $body = array()) {
        $this->response()->setStatusCode($status);
        return $body;
    }
}
