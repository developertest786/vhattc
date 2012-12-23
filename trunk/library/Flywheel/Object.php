<?php
namespace Flywheel;
abstract class Object {
    protected $_dispatcher;

    /**
     * Get event dispatcher
     * @return \Flywheel\Event\Dispatcher
     */
    public function getEventDispatcher() {
        if (null == $this->_dispatcher) {
            $this->_dispatcher = new \Flywheel\Event\Dispatcher();
        }

        return $this->_dispatcher;
    }
}
