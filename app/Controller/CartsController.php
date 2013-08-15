<?php
App::uses('AppController', 'Controller');
/**
 * Carts Controller
 *
 * @property Cart $Cart
 */
class CartsController extends AppController {


	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow();
		$this->autoRender = false;
		
		$this->loadModel('Client');
		$this->loadModel('OrderItem');
		
		if(!$this->Session->check('Cart.id')){
			$this->_startCart();
		}
	}
	
	public function isAuthorized(){
		return true;
	}
	
	function _startCart(){

		if($this->Auth->user() && $this->Auth->user('role') == 'client'){
			$client_id = $this->Client->field('id', array('user_id' => $this->Auth->user('id')));
			$this->Session->write('Cart.client', $client_id);
		}
	
		$uuid = Security::hash(time() . Configure::read('Security.salt'));
		$this->Session->write('Cart.id', $uuid);
	}
	
	function _stopCart(){
		$this->Session->delete('Cart');
	}
	
	public function rental($id = null){
		if($this->request->data('undo') && $this->request->data('undo') > 0){
			$this->Session->delete('Cart.item.' . $id);
			return json_encode(array('success' => true, 'undo' => true, 'cnt' => count($this->Session->read('Cart.item')), 'cart' => $this->Session->read('Cart')));			
		}
		
		if ($this->Session->write('Cart.item.' . $id, 'rental')){
			return json_encode(array('success' => true, 'cnt' => count($this->Session->read('Cart.item')), 'cart' => $this->Session->read('Cart')));
		}
		
		echo json_encode(array('success' => false));
		return false;
	}
	
	public function purchase($id = null){
		if($this->request->data('undo') && $this->request->data('undo') > 0){
			$this->Session->delete('Cart.item.' . $id);
			return json_encode(array('success' => true, 'undo' => true, 'cnt' => count($this->Session->read('Cart.item')), 'cart' => $this->Session->read('Cart')));			
		}
		
		if($this->Session->write('Cart.item.' . $id, 'purchase')){
			return json_encode(array('success' => true, 'cnt' => count($this->Session->read('Cart.item')), 'cart' => $this->Session->read('Cart')));
		}
		
		echo json_encode(array('success' => false));
		return false;
	}
	
	public function prints($id = null){
		if($this->request->data('undo') && $this->request->data('undo') > 0){
			$this->Session->delete('Cart.item.' . $id);
			return json_encode(array('success' => true, 'undo' => true, 'cnt' => count($this->Session->read('Cart.item')), 'cart' => $this->Session->read('Cart')));			
		}
		
		if($this->Session->write('Cart.item.' . $id, 'print')){
			return json_encode(array('success' => true, 'cnt' => count($this->Session->read('Cart.item')), 'cart' => $this->Session->read('Cart')));
		}
		
		echo json_encode(array('success' => false));
		return false;
	}
	
	public function ui_cart(){
		$count = (!$this->Session->check('Cart'))? count($this->Session->read('Cart.item')) : 0;
		return json_encode(array('cnt' => $count, 'cart' => $this->Session->read('Cart')));	
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Cart->recursive = 0;
		$this->set('carts', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view() {
		$cart = $this->Session->read('Cart');
		
		if (!$cart) {
			die('No cart here!');
		} else {
			echo print_r($cart, true);
		}

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cart->create();
			if ($this->Cart->save($this->request->data)) {
				$this->Session->setFlash(__('The cart has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cart could not be saved. Please, try again.'));
			}
		}
		$sessions = $this->Cart->Session->find('list');
		$clients = $this->Cart->Client->find('list');
		$this->set(compact('sessions', 'clients'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Cart->id = $id;
		if (!$this->Cart->exists()) {
			throw new NotFoundException(__('Invalid cart'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cart->save($this->request->data)) {
				$this->Session->setFlash(__('The cart has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cart could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Cart->read(null, $id);
		}
		$sessions = $this->Cart->Session->find('list');
		$clients = $this->Cart->Client->find('list');
		$this->set(compact('sessions', 'clients'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function remove($id = null) {
		
		if ($this->Session->check('Cart')){
			$this->_removeDbItem($this->Session->read('Cart.order'), $id);
			$this->Session->delete('Cart.item.' . $id);
		}
		
		$items = $this->Session->read('Cart.item');
		if (empty($items) && $items == false){
			$this->_stopCart();
			$this->Matisse->hardWordpressRedirect('gallery');
		}
		
		$this->Matisse->hardWordpressRedirect('order-review');
	}
	
	public function clear(){
		$this->autoRender = false;
		if($this->Session->check('Cart')){
			$this->Session->delete('Cart');
			$this->Session->write('Cart');
		}
		$this->Matisse->hardWordpressRedirect();
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Cart->recursive = 0;
		$this->set('carts', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Cart->id = $id;
		if (!$this->Cart->exists()) {
			throw new NotFoundException(__('Invalid cart'));
		}
		$this->set('cart', $this->Cart->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Cart->create();
			if ($this->Cart->save($this->request->data)) {
				$this->Session->setFlash(__('The cart has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cart could not be saved. Please, try again.'));
			}
		}
		$sessions = $this->Cart->Session->find('list');
		$clients = $this->Cart->Client->find('list');
		$this->set(compact('sessions', 'clients'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Cart->id = $id;
		if (!$this->Cart->exists()) {
			throw new NotFoundException(__('Invalid cart'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cart->save($this->request->data)) {
				$this->Session->setFlash(__('The cart has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cart could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Cart->read(null, $id);
		}
		$sessions = $this->Cart->Session->find('list');
		$clients = $this->Cart->Client->find('list');
		$this->set(compact('sessions', 'clients'));
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
		$this->Cart->id = $id;
		if (!$this->Cart->exists()) {
			throw new NotFoundException(__('Invalid cart'));
		}
		if ($this->Cart->delete()) {
			$this->Session->setFlash(__('Cart deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Cart was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	function _removeDbItem($order, $artwork_id){
		$item = $this->OrderItem->find('first', array('conditions' => array('OrderItem.order_id' => $order, 'OrderItem.artwork_id' => $artwork_id)));
		if(!empty($item)){
			return $this->OrderItem->delete($item['OrderItem']['id']);
		}
		return true;
	}
}
