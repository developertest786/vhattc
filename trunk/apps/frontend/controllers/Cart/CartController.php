<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 22/11/2012
 * Time: 14:45
 * To change this template use File | Settings | File Templates.
 */
class CartController extends FrontendController {
    public $carts = '';
    public function beforeExecute(){
    }
    
	public function executeDefault() {
		$this->carts->getOne();
	}
    public function executeAdd() {}
    public function executeRemove() {}
    public function executeChangeQuantity() {}
    public function executeAddComment(){}

}
