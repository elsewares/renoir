<?php
App::uses('AppController', 'Controller');
/**
 * AccountItems Controller
 *
 * @property AccountItem $AccountItem
 */
class AccountItemsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AccountItem->recursive = 0;
		$this->set('accountItems', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->AccountItem->id = $id;
		if (!$this->AccountItem->exists()) {
			throw new NotFoundException(__('Invalid account item'));
		}
		$this->set('accountItem', $this->AccountItem->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AccountItem->create();
			if ($this->AccountItem->save($this->request->data)) {
				$this->Session->setFlash(__('The account item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account item could not be saved. Please, try again.'));
			}
		}
		$accounts = $this->AccountItem->Account->find('list');
		$transactionItems = $this->AccountItem->TransactionItem->find('list');
		$this->set(compact('accounts', 'transactionItems'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->AccountItem->id = $id;
		if (!$this->AccountItem->exists()) {
			throw new NotFoundException(__('Invalid account item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AccountItem->save($this->request->data)) {
				$this->Session->setFlash(__('The account item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account item could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->AccountItem->read(null, $id);
		}
		$accounts = $this->AccountItem->Account->find('list');
		$transactionItems = $this->AccountItem->TransactionItem->find('list');
		$this->set(compact('accounts', 'transactionItems'));
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
		$this->AccountItem->id = $id;
		if (!$this->AccountItem->exists()) {
			throw new NotFoundException(__('Invalid account item'));
		}
		if ($this->AccountItem->delete()) {
			$this->Session->setFlash(__('Account item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Account item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->AccountItem->recursive = 0;
		$this->set('accountItems', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->AccountItem->id = $id;
		if (!$this->AccountItem->exists()) {
			throw new NotFoundException(__('Invalid account item'));
		}
		$this->set('accountItem', $this->AccountItem->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AccountItem->create();
			if ($this->AccountItem->save($this->request->data)) {
				$this->Session->setFlash(__('The account item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account item could not be saved. Please, try again.'));
			}
		}
		$accounts = $this->AccountItem->Account->find('list');
		$transactionItems = $this->AccountItem->TransactionItem->find('list');
		$this->set(compact('accounts', 'transactionItems'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->AccountItem->id = $id;
		if (!$this->AccountItem->exists()) {
			throw new NotFoundException(__('Invalid account item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AccountItem->save($this->request->data)) {
				$this->Session->setFlash(__('The account item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account item could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->AccountItem->read(null, $id);
		}
		$accounts = $this->AccountItem->Account->find('list');
		$transactionItems = $this->AccountItem->TransactionItem->find('list');
		$this->set(compact('accounts', 'transactionItems'));
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
		$this->AccountItem->id = $id;
		if (!$this->AccountItem->exists()) {
			throw new NotFoundException(__('Invalid account item'));
		}
		if ($this->AccountItem->delete()) {
			$this->Session->setFlash(__('Account item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Account item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
