<?php
class OrderController extends BackendController {
    public function executeDefault() {
        $order = new Order();
        $order->buyer_id = 1;
        $order->buyer_username = 'admin';

        $order->save();
        exit;
    }
}