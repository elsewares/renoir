<?php
App::uses('AppController', 'Controller');
/**
 * Rentals Controller
 *
 * @property Rental $Rental
 */
class RentalsController extends AppController {

	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function isAuthorized(){
        if ($this->Auth->user() && ($this->Auth->user('role') == 'client' || $this->Auth->user('role') == 'admin')) {
            return true; 
        }
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rental->recursive = 1;
		$this->set('rentals', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Rental->id = $id;
		if (!$this->Rental->exists()) {
			throw new NotFoundException(__('Invalid rental'));
		}
		$this->set('rental', $this->Rental->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function assign($order_id) {
		$this->loadModel('Order');
		
		if ($this->request->is('post')) {
			$req = $this->request->data;
			$this->Rental->create();
			$a_id = $this->request->data('artwork_id');
			if ($rental = $this->Rental->save($this->request->data)) {
				$this->Rental->contain('Location', 'Client', 'Artwork');
				$rental = $this->Rental->find('first', array('conditions' => array('Rental.id' => $rental['Rental']['id'])));
				$this->Email->rentalEmail($rental);
				$this->Matisse->jsonResponse(true, array('artwork_id' => $a_id, 'type' => 'rental-assign'), 'Rental assigned!');
				return true;
			} else {
				$this->Matisse->jsonResponse(false, array('type' => 'rental-assign'), $this->Rental->validationErrors);
				return true;
			}
		}
		
		if($this->request->is('get')){
			$this->Order->bindModel(array('hasMany' => array('Rental' => array('className' => 'Rental'))));
			$this->Order->contain(array('OrderItem' => 'Artwork', 'Client' => 'Location', 'Rental'));
			$order = $this->Order->find('first', array('conditions' => array('Order.order_id' => $order_id)));
			debug($order);
			
			if($order['Client']['user_id'] !== $this->Auth->user('id') || $this->Auth->user('role') !== 'admin'){			
				$this->Matisse->wordpressRedirect('oops/');
			}
			
			foreach ($order['Rental'] as $rental){
				foreach ($order['OrderItem'] as $k => $item){
					if ($rental['artwork_id'] == $item['artwork_id'] && !empty($rental['location_id'])) unset($order['OrderItem'][$k]);
				}
			}
			debug($order);
			$this->set(compact('order'));	
		}
	}
	
/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Rental->id = $id;
		if (!$this->Rental->exists()) {
			throw new NotFoundException(__('Invalid rental'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rental->save($this->request->data)) {
				$this->Session->setFlash(__('The rental has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rental could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Rental->read(null, $id);
		}
		$artworks = $this->Rental->Artwork->find('list');
		$locations = $this->Rental->Location->find('list');
		$this->set(compact('artworks', 'locations'));
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
		$this->Rental->id = $id;
		if (!$this->Rental->exists()) {
			throw new NotFoundException(__('Invalid rental'));
		}
		if ($this->Rental->delete()) {
			$this->Session->setFlash(__('Rental deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rental was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Rental->recursive = 0;
		$this->set('rentals', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Rental->id = $id;
		if (!$this->Rental->exists()) {
			throw new NotFoundException(__('Invalid rental'));
		}
		$this->set('rental', $this->Rental->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($order_id = 0, $client_id = 0, $artwork_id = 0) {

		if ($this->request->is('post')) {
			$this->Rental->create();
			if ($this->Rental->save($this->request->data)) {
				$this->Session->setFlash(__('The rental has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rental could not be saved. Please, try again.'));
			}
		}
		
		$client_name = $this->Rental->Client->field('name', array('Client.id' => $client_id));
		$artworks = $this->Rental->Artwork->find('first', array('conditions' => array('Artwork.id' => $artwork_id)));
		$locations = $this->Rental->Location->find('list', array('conditions' => array('Location.client_id' => $client_id)));
		$this->set(compact('artworks', 'locations', 'client_name', 'client_id', 'order_id'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Rental->id = $id;
		if (!$this->Rental->exists()) {
			throw new NotFoundException(__('Invalid rental'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rental->save($this->request->data)) {
				$this->Session->setFlash(__('The rental has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rental could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Rental->read(null, $id);
		}
		$artworks = $this->Rental->Artwork->find('list');
		$locations = $this->Rental->Location->find('list');
		$this->set(compact('artworks', 'locations'));
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
		$this->Rental->id = $id;
		if (!$this->Rental->exists()) {
			throw new NotFoundException(__('Invalid rental'));
		}
		if ($this->Rental->delete()) {
			$this->Session->setFlash(__('Rental deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rental was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
