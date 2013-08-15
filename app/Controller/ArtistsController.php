<?php
App::uses('AppController', 'Controller');
/**
 * Artists Controller
 *
 * @property Artist $Artist
 */
class ArtistsController extends AppController {

	public $layout = 'matisse';
	
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'existing_user');
		
		if ($this->Auth->user('role') == "client" && in_array($this->params['action'], array('add', "edit"))) {
			//$this->Auth->authError = "You have a client account.";
			$this->redirect(array('action' => 'existing_user'));
		}
    }

    public function isAuthorized() {
        if ($this->Auth->user()) {
            return true; 
        }
        return false;
    }
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$list = $this->Artist->find('list', array('conditions' => array('Artist.active' => true, 'Artist.name !=' => ''), 'recursive' => 0, 'fields' => array('Artist.name', 'Artist.id'), 'order' => 'Artist.name', 'ASC'));
		$this->set('list', $list);
		
		if($this->Auth->user('role') == 'artist'){
			$artist = $this->Artist->find('first', array('conditions' => array('user_id' => $this->Auth->user('id'))));
			$this->set('artist', $artist);
		} else{
			$this->set('artist', false);
		}
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {

		$this->loadModel('Artwork');
		$this->Artwork->contain(array('Image', 'Rental' => array('Client' => 'Location'), 'OrderItem' => 'Order'));
		
		if(($id == null || $id == 0) && $this->Auth->user()){
			$artist = $this->Artist->find('first', array('conditions' => array('user_id' => $this->Auth->user('id'))));
			$artworks = $this->Artwork->find('all', array('conditions' => array('artist_id' => $artist['Artist']['id'])));
			foreach ($artworks as $k => $artwork){
				$artworks[$k]['Artwork']['is_rented'] = $this->Artwork->isRented($artwork['Rental']);
				$artworks[$k]['Artwork']['is_purchased'] = $this->Artwork->isPurchased($artwork['OrderItem']);
			}
			$this->set('artist', $artist);
			$this->set('artworks', $artworks);
			$this->set('owner', $this->Auth->user('username'));
			$this->render();
			return true;
		} 

		$this->Artist->id = $id;
		
		if ($this->Artist->exists()) {
			$artist = $this->Artist->read(null, $id);
			$this->set('artist', $artist);
			$artworks = $this->Artwork->find('all', array('conditions' => array('artist_id' => $artist['Artist']['id'])));
			foreach ($artworks as $k => $artwork){
				$artworks[$k]['Artwork']['is_rented'] = $this->Artwork->isRented($artwork['Rental']);
				$artworks[$k]['Artwork']['is_purchased'] = $this->Artwork->isPurchased($artwork['OrderItem']);
			}
			$this->set('artworks', $artworks);

			if ($this->Auth->user() && $artist['Artist']['user_id'] == $this->Auth->user('id')){
				$this->set('owner', $this->Auth->user('username'));
			} else {
				$this->set('owner', false);
			}
		} else {
			$this->Matisse->wordpressRedirect('/oops/');
		}
	}
	
	public function public_view($id = null){
		$this->Artist->recursive = 2;
		$this->Artist->id = $id;
		
		if ($this->Artist->exists()) {
			$artist = $this->Artist->read(null, $id);
			$this->set('artist', $artist);
			if ($this->Auth->user() && $artist['Artist']['user_id'] == $this->Auth->user('id')){
				$this->set('owner', $this->Auth->user('username'));
			}
		} else {
			$this->Matisse->wordpressRedirect('/oops/');
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
				$artist = $this->Artist->findByUserId($this->Auth->user('id'));
				$this->set('artist', $artist);
			}
		}
		
		if ($this->request->is('post')) {
			$this->Artist->create();
			$artist = $this->Artist->find('first', array('conditions' => array('user_id' => $this->Auth->user('id'))));
			$this->request->data['Artist']['id'] = $artist['Artist']['id'];
			$this->request->data['Artist']['user_id'] = $this->Auth->user('id');
			
			if ($this->Artist->save($this->request->data)) {
				$this->Session->setFlash(__('Your profile has been saved.'));
				$this->Matisse->wordpressRedirect('artwork-submission');
			} else {
				$this->set('artist', $artist);
				$this->Session->setFlash(__('The artist could not be saved. Please, try again.'));
			}
		}
	}
	
	function existing_user(){
		$this->render();
		return true;
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit() {
		
		$artist = $this->Artist->find('first', array('conditions' => array('user_id' => $this->Auth->user('id'))));
		
		if (!$artist || empty($artist)) {
			$this->Matisse->hardWordpressRedirect('/oops/');
		}
		
		if ($this->request->is('get')){
			$this->set('artist', $artist);
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Artist->save($this->request->data)) {
				$this->Session->setFlash(__('The artist has been saved'));
				$this->Matisse->wordpressRedirect('artist-profile');
			} else {
				$this->Session->setFlash(__('The artist could not be saved. Please, try again.'));
			}
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
		$this->Artist->id = $id;
		if (!$this->Artist->exists()) {
			throw new NotFoundException(__('Invalid artist'));
		}
		if ($this->Artist->delete()) {
			$this->Session->setFlash(__('Artist deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Artist was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Artist->recursive = 0;
		$this->set('artists', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Artist->id = $id;
		if (!$this->Artist->exists()) {
			throw new NotFoundException(__('Invalid artist'));
		}
		$this->set('artist', $this->Artist->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Artist->create();
			if ($this->Artist->save($this->request->data)) {
				$this->Session->setFlash(__('The artist has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The artist could not be saved. Please, try again.'));
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
		$this->Artist->id = $id;
		if (!$this->Artist->exists()) {
			throw new NotFoundException(__('Invalid artist'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Artist->save($this->request->data)) {
				$this->Session->setFlash(__('The artist has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The artist could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Artist->read(null, $id);
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
		$this->Artist->id = $id;
		if (!$this->Artist->exists()) {
			throw new NotFoundException(__('Invalid artist'));
		}
		if ($this->Artist->delete()) {
			$this->Session->setFlash(__('Artist deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Artist was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function finish(){
		if ($this->request->is('post')){
			$this->Artist->create();
			if($this->Artist->save($this->request->data)){
				$this->Session->setFlash(__('Your artist profile has been saved.'));
				$this->redirect(array('action' => 'profile'));
			} else {
				$this->Session->setFlash(__('Your profile wasn\'t saved.  Please try again.'));
			}
		}
	}
}
