<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends AppController {

	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('review');
		
		$this->loadModel('Artwork');
		$this->loadModel('Client');
	}
	
	public function isAuthorized(){
        if ($this->Auth->user() && $this->Auth->user('role') == 'admin') {
            return true; 
        }
	}
	
    public function beforeRender(){
        $this->set('user', $this->Auth->user());
        if ((isset($this->params['admin']) && $this->params['admin'] == true)) {
            $this->layout = 'default';
        }
		if($this->request->action == 'review'){
			$this->layout = "iframe";
		}
    }
	
	function _getLayout(){
		if($this->request->action == 'review'){
			$this->layout = 'iframe';
		}
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Order->recursive = 1;
		$this->set('orders', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this->set('order', $this->Order->read(null, $id));
	}

/**
 * add method :: renamed 'review'
 *
 * @return void
 */
	public function review() {
		$this->layout = 'iframe';
		$this->Order->contain(array('OrderItem' => array('Artwork'), 'Client'));
		//debug($this->Session->read('Cart'), true, true);
		$items = array();

		if($this->request->is('get')){
			$cart = $this->_checkCartForOrder();
			//debug($cart, true, true);
			if(!$cart['has_order']){ // If there's no order number saved in the session, create one in db.
				//echo "NO order present";
				$order = $this->_createNewCartOrder();
				//debug($order, true, true);
				if($this->_getCartItems()){ //If there are items in the cart, add to db, setup form and render.
					$items = $this->_createOrderItems($this->Session->read('Cart.item'), $order['Order']['order_id']);
					//debug($items, true, true);
					$this->_setupOrderForm($order, $items);
					$this->render();
				} else { // If there's an order with no items, show empty cart.
					$this->set('cart_empty', true);
					$this->render();
				}
			} elseif ($cart['has_order'] && !$cart['has_items']){ //If there's an order number but no items, check db for existing order.
				//echo "Order and NO items present.";
				$order = $this->Order->find('first', array('conditions' => array('Order.order_id' => $this->Session->read('Cart.order'))));
				////debug($order, true, true);
				if(!empty($order['OrderItem'])){ //We got items from db, so display form.
					$this->_setupOrderForm($order, $items);
				} else { //Nothing in db, so empty cart.
					$this->set('cart_empty', true);
					$this->render();
				}
			} elseif ($cart['has_order'] && $cart['has_items']) { //If both are present, make sure items are saved.
				$order = $this->Order->find('first', array('conditions' => array('Order.order_id' => $this->Session->read('Cart.order'))));
				//echo "Order and items present.";
				////debug($order, true, true);
				if(empty($order['OrderItem'])){
					$items = $this->_createOrderItems($this->Session->read('Cart.item'), $order['Order']['order_id']);
					////debug($items, true, true);
				}
				if($this->_checkCartCount($order)){
					$items = $this->_addOrderItems($this->Session->read('Cart.item'), $order['Order']['order_id']);
				}
				
				$this->_setupOrderForm($order, $items);
				$this->render();
			} else { //If all else fails, show the empty cart.
				$this->set('cart_empty', true);
				$this->render();
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('The order has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Order->read(null, $id);
		}
		$clients = $this->Order->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->Order->delete()) {
			$this->Session->setFlash(__('Order deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Order was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this->set('order', $this->Order->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->Order->contain(array('OrderItem' => 'Rental'), 'Client', 'Artwork');
		$order_id = substr(Security::hash(time(), 'sha1', true), 0, 10);
		$artwork_id = 0;
		
		if ($this->request->is('post')) {
			$this->Order->create();
			$this->Order->OrderItem->create();
			$this->Order->order_id = $this->Order->OrderItem->order_id = $order_id;
			$this->Order->client_id = $client_id = ($this->request->data('Order.admin_client'))? $this->Order->client_id = Configure::read('Matisse.admin_userid') : $this->request->data('Order.client_id');
			$this->Order->paid = true;
			
			$artwork = $this->Artwork->read(null, $this->request->data('Order.OrderItem.artwork_id'));
			$this->Order->OrderItem->artwork_id = $artwork_id = $artwork['Artwork']['id'];
			$this->Order->OrderItem->item_type = $this->request->data('Order.OrderItem.item_type');
			$this->Order->OrderItem->amount = $this->Order->calculateAmount($artwork, $this->request->data('Order.OrderItem.item_type'));
			$this->Order->OrderItem->charges = $this->Order->calculateCharges($this->Order->OrderItem->amount, $this->request->data('Order.OrderItem.item_type'));
			
			//$this->Order->OrderItem->item_type = ($this->request->data('Order.OrderItem.item_type') == 0)? 'purchase' : 'rental';
			
			if ($this->Order->save($this->Order) && $this->Order->OrderItem->save($this->Order->OrderItem)) {
				if($this->request->data('Order.OrderItem.item_type') == 'rental'){
					$this->redirect(array('controller' => 'rentals', 'action' => 'add', 'admin' => true, $order_id, $client_id, $artwork_id));
				} else {
					$this->Session->setFlash('Purchase order ' . $order_id . ' set for ' . $artwork['Artwork']['title']);
					$this->set('order', $this->Order->order_id);
					$this->set('title', $artwork['Artwork']['title']);
					////debug($this->Order, true, true);
				}
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
				//debug($this->request->data, true, true);
				//debug($this->Order, true, true);
				//debug($this->Order->OrderItem, true, true);
			}
		}
		
		$artworks = $this->Artwork->find('list', array('fields' => array('Artwork.id', 'Artwork.title'), 'conditions' => array('Artwork.active' => true)));
		$clients = $this->Order->Client->find('list', array('conditions' => array('Client.active' => true)));
		$this->set(compact('artworks', 'clients', 'order_id'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('The order has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Order->read(null, $id);
		}
		$clients = $this->Order->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->Order->delete()) {
			$this->Session->setFlash(__('Order deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Order was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	function _checkCartForOrder(){
		return array('has_order' => $this->Session->check('Cart.order'), 'has_items' => $this->Session->check('Cart.item'));
	}
	
	function _checkCartCount($order){
		$o_count = count($order['OrderItem']);
		$c_count = count($this->Session->read('Cart.item'));
		return $c_count > $o_count;
	}
	
	function _retrieveOrder($order_id){
		return $this->Order->find('first', array('conditions' => array('Order.order_id' => $order_id)));
	}
	
	function _createNewCartOrder(){
		$order = $this->Order->create();
		$order['Order']['order_id'] = substr(Security::hash(time(), 'sha1', true), 0, 10);
		$this->Session->write('Cart.order', $order['Order']['order_id']);
		////debug($this->Session->read('Cart'));
		if($this->Auth->user() && $this->Auth->user('role') == 'client'){
			$client = $this->Client->find('first', array('conditions' => array('user_id' => $this->Auth->user('id'))));
			$order['Order']['client_id'] = $client['Client']['id'];
		} else {
			$order['Order']['client_id'] = false;
		}
		return ($this->Order->save($order))? $order : false;
	}
	
	function _getCartItems(){
		$ret = $this->Session->read('Cart.item');
		return (!empty($ret))? $ret : false;
	}
	
	function _createOrderItems($_cartItems, $order_id){

		$order_items = array();
		////debug($_cartItems, true, true);
		foreach ($_cartItems as $artwork_id => $item_type){
			$_item = $this->Order->OrderItem->create();
			$artwork = $this->Artwork->find('first', array('conditions' => array('Artwork.id' => $artwork_id)));
			////debug($artwork, true, true);
			$amount = $this->Order->calculateAmount($artwork, $item_type);
			$charges = $this->Order->calculateCharges($artwork, $item_type);
			//echo $artwork_id . PHP_EOL; //debug($amount); //debug($charges);
			$_item['OrderItem']['order_id'] = $order_id;
			$_item['OrderItem']['artwork_id'] = $artwork_id;
			$_item['OrderItem']['item_type'] = $item_type;
			$_item['OrderItem']['amount'] = $amount;
			$_item['OrderItem']['charges'] = $charges;
			$_item['OrderItem']['title'] = $artwork['Artwork']['title']; //Display only.
			array_push($order_items, $_item);
		}
		
		return ($this->Order->OrderItem->saveAll($order_items))? $order_items : false;
	}
	
	function _addSingleOrderItem($artwork_id, $order_id){
		$_item = $this->Order->OrderItem->create();
		$artwork = $this->Artwork->find('first', array('conditions' => array('Artwork.id' => $artwork_id)));
		$_key = 'Cart.item.' . $artwork_id;
		$item_type = $this->Session->read($_key);
		////debug($artwork, true, true);
		$amount = $this->Order->calculateAmount($artwork, $item_type);
		$charges = $this->Order->calculateCharges($artwork, $item_type);
		//echo $artwork_id . PHP_EOL; //debug($amount); //debug($charges);
		$_item['OrderItem']['order_id'] = $order_id;
		$_item['OrderItem']['artwork_id'] = $artwork_id;
		$_item['OrderItem']['item_type'] = $item_type;
		$_item['OrderItem']['amount'] = $amount;
		$_item['OrderItem']['charges'] = $charges;
		$_item['OrderItem']['title'] = $artwork['Artwork']['title'];
		
		return $this->Order->OrderItem->save($_item);
		
	}
	
	function _addOrderItems($_cart = array(), $order_id){
		foreach($_cart as $art_id => $type){
			if(!$this->Order->OrderItem->find('first', array('conditions' => array('OrderItem.artwork_id' => $art_id, 'OrderItem.order_id' => $order_id)))){
				$single = $this->_addSingleOrderItem($art_id, $order_id);
				if(!$single) return false;
			}
		}
		return $this->Order->find('first', array('conditions' => array('Order.order_id' => $order_id)));
	}
	
	function _setupOrderForm($_order, $order_items = array()){
		//debug($_order, true, true);
		//debug($order_items, true, true);
		$is_client = (!$this->Auth->user() || $this->Auth->user('role') !== 'client')? false : true;
		if(empty($order_items)) $order_items = $_order['OrderItem'];
		$time = date('F jS, Y h:i A');
		$taxes = $this->Order->getTaxesTotal($order_items);
		$subtotal = $this->Order->getAmountTotal($order_items);
		$total = $subtotal + $taxes;
		debug($taxes, true, true);
		debug($total, true, true);
		debug($subtotal, true, true);
		
		$taxes = number_format($taxes, 2);
		$subtotal = number_format($subtotal, 2);
		$total = number_format($total, 2);
		
		debug($taxes, true, true);
		debug($total, true, true);
		debug($subtotal, true, true);
		
		$this->set('is_client', $is_client);
		$this->set('url', Configure::read('Matisse.transactionURL'));
		$this->set('storename', Configure::read('Matisse.storeName'));
		$this->set('order', $_order);
		$this->set('order_id', $_order['Order']['order_id']);
		$this->set('client_id', $_order['Order']['client_id']);
		$this->set('order_items', $order_items);
		$this->set('subtotal', $subtotal);
		$this->set('total', $total);
		$this->set('total_taxes', $taxes);
		return true;
	}
}
