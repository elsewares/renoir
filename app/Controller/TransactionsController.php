<?php
App::uses('AppController', 'Controller');
/**
 * Transactions Controller
 *
 * @property Transaction $Transaction
 */
class TransactionsController extends AppController {

	function beforeFilter(){
		parent::beforeFilter();
		$this->loadModel('Client');
		$this->loadModel('Order');
		$this->loadModel('OrderItems');
		$this->Auth->allow('finish');
	}

	public function isAuthorized(){
        if ($this->Auth->user() && $this->Auth->user('role') == 'admin') {
            return true; 
        }
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Transaction->recursive = 2;
		$this->set('transactions', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Transaction->id = $id;
		if (!$this->Transaction->exists()) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		$this->set('transaction', $this->Transaction->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function finish($ok = false) {
		$_data = array('Transaction' => array());
		//$this->request->data['order_id'] = $this->request->data('oid');
		$this->request->data['status'] = strtolower($this->request->data['status']);
		$this->Transaction->create($this->request->data);
		if ($ok == "approved" && $this->request->data['status'] == 'approved') {
			$order = $this->Transaction->Order->find('first', array('conditions' => array('order_id' => $this->request->data['order_id']), 'recursive' => 2));
			$this->Transaction->Order->read(null, $order['Order']['id']);
			$this->Transaction->Order->set('paid', true);
			$hasRental = $this->Transaction->Order->rentalOrders($order);			
			if ($this->Transaction->save() && $this->Transaction->Order->save()) {
				$this->Cart->clearCart();
				//debug($this->Session->read());
				//exit(0);
				if($hasRental){
					$this->Matisse->hardHashRedirect('assign-rentals', $order['Order']['order_id'], false);
				} else {
					$this->redirect(array('controller' => 'orders', 'action' => 'view', array('order_id' => $order['Order']['id'], 'paid' => true)));
				}
			} else {
				$this->log('Transaction save error: ' . debug($this->request->data));
				$this->Session->setFlash(__('An error has occurred in saving the transaction.  Please contact the site administrator.'));
				$this->redirect(array('controller' => 'orders', 'action' => 'list', 0));
			}
		} else {
			if($this->Transaction->save()){
				$this->redirect(array('controller' => 'orders', 'action' => 'view', array('order_id' => $order['Order']['id'], 'paid' => false)));
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
		$this->Transaction->id = $id;
		if (!$this->Transaction->exists()) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Transaction->save($this->request->data)) {
				$this->Session->setFlash(__('The transaction has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Transaction->read(null, $id);
		}
		$orders = $this->Transaction->Order->find('list');
		$clients = $this->Transaction->Client->find('list');
		$this->set(compact('orders', 'clients'));
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
		$this->Transaction->id = $id;
		if (!$this->Transaction->exists()) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		if ($this->Transaction->delete()) {
			$this->Session->setFlash(__('Transaction deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Transaction was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Transaction->recursive = 0;
		$this->set('transactions', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Transaction->id = $id;
		if (!$this->Transaction->exists()) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		$this->set('transaction', $this->Transaction->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Transaction->create();
			if ($this->Transaction->save($this->request->data)) {
				$this->Session->setFlash(__('The transaction has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
			}
		}
		$orders = $this->Transaction->Order->find('list');
		$clients = $this->Transaction->Client->find('list');
		$this->set(compact('orders', 'clients'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Transaction->id = $id;
		if (!$this->Transaction->exists()) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Transaction->save($this->request->data)) {
				$this->Session->setFlash(__('The transaction has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Transaction->read(null, $id);
		}
		$orders = $this->Transaction->Order->find('list');
		$clients = $this->Transaction->Client->find('list');
		$this->set(compact('orders', 'clients'));
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
		$this->Transaction->id = $id;
		if (!$this->Transaction->exists()) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		if ($this->Transaction->delete()) {
			$this->Session->setFlash(__('Transaction deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Transaction was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
