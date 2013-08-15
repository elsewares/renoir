<?php

App::uses('Component', 'Controller');

class CartComponent extends Component {
    
	var $components = array('Session');
	var $CTRL = '';
    var $CART = '';
    
	function initialize(&$controller){
		
		$this->CTRL = $controller;
        
		if($this->Session->check('Cart.id')){
            $this->CART = $this->Session->read('Cart.id');
        } else {
            $this->CART = false;
        }
	}
	
	function get_items(){
		$items = $this->Session->read('Cart.item');
		return $items;
	}
	
	function get_order(){
		$order = $this->Session->read('Cart.order');
		return $order;
	}
	
	function clearCart(){
		return ($this->Session->delete('Cart'));
	}
}

?>