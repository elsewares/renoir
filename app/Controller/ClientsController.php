<?php
App::uses('AppController', 'Controller');
/**
 * Clients Controller
 *
 * @property Client $Client
 */
class ClientsController extends AppController {

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('existing_user', 'index', 'add');
		
		if ($this->Auth->user('role') == "artist" && in_array($this->params['action'], array('add', 'edit'))) {
			//$this->Auth->authError = "You have an artist account.";
			$this->redirect(array('action' => 'existing_user'));
		}
    }
	
	public function isAuthorized() {
        if ($this->Auth->user()) {
            return true; 
        }
        
		$this->Matisse->hardWordpressRedirect('/oops/');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if($this->Auth->user('role') == 'client'){
			$client = $this->Client->find('first', array('conditions' => array('user_id' => $this->Auth->user('id'))));
			$this->set('client', $client);
		} else{
			$this->set('client', false);
		}
	}
	
	public function existing_user(){
		
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Client->recursive = -1;
		$client = $this->Client->find('first', array('contain' =>
													 array('Location'=>
														   array('Rental' =>
																 array('conditions' => array('Rental.on_hold =' => 0,
																							 'AND' => array('Rental.end_date >' => $this->Matisse->today())),
																 'Artwork'))),
													 'conditions' => array('user_id' => $this->Auth->user('id'))));
		if (!$client) {
			throw new NotFoundException(__('Invalid client'));
		} else{
			$this->set('client', $client);
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		
		if ($this->request->is('get')){
			if(!$this->Auth->user() || $this->Auth->user('id') == ''){
				$this->Auth->redirect(array('controller' => 'users', 'action' => 'login'));
			} else {
				$client = $this->Client->findByUserId($this->Auth->user('id'));
				$this->set('client', $client['Client']);
			}
		}
		
		if ($this->request->is('post')) {
			$this->Client->create();
			$client = $this->Client->find('first', array('conditions' => array('user_id' => $this->Auth->user('id'))));
			$this->request->data['Client']['id'] = $client['Client']['id'];
			$this->request->data['Client']['user_id'] = $this->Auth->user('id');
			$this->request->data['Client']['type'] = $this->Matisse->setClientType($this->request->data['Client']['type']);
			
			if($this->request->data('Location.same') == true){
				//$this->_copyLocationData($this->request->data);
			}
			
			if ($this->Client->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Your profile has been saved.'));
				$this->Matisse->wordpressRedirect('client-profile');
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
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
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid artist'));
		}
		if ($this->request->is('get')){
			if ($this->Client->id !== $this->Auth->user('id')){
				$this->redirect(array('action' => 'view', $this->Client->id));
			} else {
				$this->request->data = $this->Client->read(null, $id);
			}
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__('The client profile has been saved'));
				$this->redirect(array('action' => 'view', array($this->Auth->user('id'), true)));
			} else {
				$this->Session->setFlash(__('The client profile could not be saved. Please, try again.'));
			}
		} else {

		}
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
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->Client->delete()) {
			$this->Session->setFlash(__('Client deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Client was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Client->recursive = 0;
		$this->set('clients', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		$this->set('client', $this->Client->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Client->create();
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__('The client has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__('The client has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Client->read(null, $id);
		}
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
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->Client->delete()) {
			$this->Session->setFlash(__('Client deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Client was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	function _copyLocationData(){
		$this->request->data['Location.0.alias'] = "Default";
		$this->request->data['Location.0.address1'] = $this->request->data('Client.address1');
		$this->request->data['Location.0.address2'] = $this->request->data('Client.address2');
		$this->request->data['Location.0.city'] = $this->request->data('Client.city');
		$this->request->data['Location.0.state'] = $this->request->data('Client.state');
		$this->request->data['Location.0.zip'] = $this->request->data('Client.zip');
	}
}
