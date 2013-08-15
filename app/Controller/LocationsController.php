<?php
App::uses('AppController', 'Controller');
/**
 * Locations Controller
 *
 * @property Location $Location
 */
class LocationsController extends AppController {
    
    public function beforeFilter(){
        parent::beforeFilter();
		$this->Auth->allow('add');
    }
    
    public function isAuthorized($user) {

        if (in_array($this->action, array('edit', 'delete'))) {
            $idhash = $this->request->params['pass'][0];
			$auth = $this->Location->isOwnedBy($idhash);
			//exit();			
			return $auth;
        }

        return false;
    }
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Location->recursive = 1;
		$this->set('locations', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		$this->set('location', $this->Location->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
		if ($this->request->is('post')) {
			$this->Location->create();
			if ($this->Location->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved'));
				$this->Matisse->wordpressRedirect('client-profile');
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		}
		$client_id = $id;
		$this->set(compact('client_id'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Location->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved'));
				$this->Matisse->wordpressRedirect('client-profile');
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Location->read(null, $id);
		}
		$client = $this->Location->Client->id;
		$this->set(compact('client'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Location->id = substr($id, 0, strpos($id, '~'));
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		if ($this->Location->delete()) {
			$this->Session->setFlash(__('Location deleted'));
			$this->Matisse->wordpressRedirect('client-profile');
		} else {
			$this->Session->setFlash(__('Location was not deleted'));
			$this->Matisse->wordpressRedirect('client-profile');
		}
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Location->recursive = 0;
		$this->set('locations', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		$this->set('location', $this->Location->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Location->create();
			if ($this->Location->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		}
		$clients = $this->Location->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Location->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Location->read(null, $id);
		}
		$clients = $this->Location->Client->find('list');
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
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		if ($this->Location->delete()) {
			$this->Session->setFlash(__('Location deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Location was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
