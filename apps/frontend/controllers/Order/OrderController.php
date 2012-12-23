<?php
class OrderController extends \Flywheel\Controller\WebController {
    public function executeDefault() {
        //echo 'fucking';exit;
        $order = new Order();
        $order->buyer_id = 1;
        $order->buyer_username = 'admin';

        $order->save();

        Order::getPrimaryKeyField();
        exit;
    }
}