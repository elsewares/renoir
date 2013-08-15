<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 * @property SecurityComponent $Security
 * @property AuthComponent $Auth
 */
class UsersController extends AppController {

	public $layout = 'matisse';
	
/**
 * Components
 *
 * @var array
 */

    public function beforeFilter(){
        parent::beforeFilter();
		// Does not require being logged in
		$this->Auth->allow('add', 'login', 'logout', 'activate', 'inactive', 'existing_user', 'ui_user', 'password');
		
		// If logged in, these pages require logout
		if ($this->Auth->user() && in_array($this->params['action'], array('add'))) {
			//$this->Auth->authError = "You're logged in as a user already.";
			$this->redirect(array('action' => 'existing_user', $this->Auth->user('role')));
		}
    }

    public function beforeRender(){
        parent::beforeRender();
    }
	
	public function isAuthorized(){
		if($this->Auth->loggedIn()){
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
		$this->User->recursive = 1;
		$this->set('users', $this->paginate());
		$this->redirect(array('action' => 'view'));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view() {
		
		$this->User->id = $this->Auth->user('id');
		
		if (!$this->Auth->loggedIn()) {
			$this->Matisse->wordpressRedirect('/oops/');
		} else {
			$user = $this->User->read(null, $this->User->id);
			$this->set('user', $user);
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add($role = '') {
		
		$this->set('role', $role);
		$_data = $this->request->data;
		
		if ($this->request->is('post') && $role !== '') {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
			    $this->__sendActivationEmail($this->User->getLastInsertID());
				$Model = ucfirst($role);
				$this->loadModel($Model);
				$this->$Model->create();
				$this->$Model->set('email', $this->User->field('username'));
				$this->$Model->set('user_id', $this->User->field('id'));
				
				if($this->$Model->save()){
					$this->Email->registerEmail($_data);
					$this->set(array('rel' => '/user-registered/'));
					$this->render('/Elements/redirect');
					
				} else {
					$this->Session->setFlash(__('The user\'s profile could not be saved. Please, try again.'));					
				}
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		
		if($this->request->is('get') && $role == ''){
			$this->redirect('/user/add/client');
		}
		
	}
	
	public function password($hash = ''){
		$reset_password = $this->Matisse->random_string(8);
		if($this->request->is('post')){
			$user = $this->User->find('first', array('conditions' => array('username' => $this->request->data['User']['username'])));
			if($user){
				$this->User->read(null, $user['User']['id']);
				$this->User->set('password', $reset_password);
				if($this->User->save()){
					$this->set('password_sent', $this->__sendPasswordEmail($reset_password, $user['User']['username']));
				}
			} else {
				$this->Matisse->hardWordpressRedirect('/oops/');
			}
		}
		
		if($this->request->is('get')){
			$this->set('get', true);
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
    
    public function login() {
		
		if ($this->request->is('get')){
			if($this->Auth->loggedIn()){
				$uri = $this->Auth->user('role') . "-profile";
				$this->Matisse->wordpressRedirect($uri);
			}
		}
		
		if ($this->request->is('post')){
			if ($this->Auth->login()) {
				$uri = $this->Auth->user('role') . "-profile";
				$this->Matisse->wordpressRedirect($uri);
			} else {
				$this->Session->setFlash(__('Oops.  Invalid username or password, try again.'));
			}
		}
	}
	
    public function admin_login() {
		
		if ($this->request->is('get')){
			if($this->Auth->loggedIn() && $this->Auth->user('role') == 'admin'){
				$this->redirect(array('controller' => 'admin', 'action' => 'index'));
			} else {
				$this->Matisse->wordpressRedirect('oops');
			}
		} 
		
		if ($this->request->is('post')){
			if ($this->Auth->login()) {
				$uri = $this->Auth->user('role') . "-profile";
				$this->Matisse->wordpressRedirect($uri);
			} else {
				$this->Session->setFlash(__('Oops.  Invalid username or password, try again.'));
			}
		}
	}

    public function logout() {
		if($this->Auth->logout()){
			$this->Matisse->hardWordpressRedirect('');
		}
    }
    
    function activate($user_id = null, $hash = null) {
	
		$this->User->id = $user_id;
	
		if ($this->User->exists() && ($hash == $this->User->getActivationHash()))
		{
			// Update the active flag in the database
			if($this->User->saveField('active', 1)){

				$user = $this->User->find('first', array('conditions' => array('id' => $this->User->id)));
				
				if($this->Auth->login($user['User'])){
					$wpUrl = sprintf('/new-%s-profile/', $user['User']['role']);
					$this->Matisse->hardWordpressRedirect($wpUrl);
					return true;
				}
			}
		} else {
			$this->Matisse->hardWordpressRedirect('/inactive-user/');
		}
    }
	
	function inactive(){
		
		if($this->request->is('post')){
			if(!empty($this->request->data['User']['username'])){
				$user = $this->User->find('first', array('conditions' => array('User.username' => $this->request->data['User']['username'])));
				$sent = $this->__sendActivationEmail($user['User']['id']);
				if ($sent){
					$role = $user['User']['role'];
					$this->Session->setFlash('Another activation email sent to ' . $this->request->data['User']['username'] . '.');
					$this->set('rel', '/thanks-' . $role . '/');
				} else {
					$this->Session->setFlash('A user for email address ' . $this->request->data['User']['username'] . ' wasn\'t found.');
				}
			} else {
				$this->Session->setFlash('Enter an email address, please.');
				//debug($data);
			}
		}
	}
	
	function change_password(){
		
		if($this->request->is('post')){
			$this->User->id = $this->Auth->user('id');
			if($this->User->exists()){
				$user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id'))));
				$user['User']['password'] = $this->request->data['password'];
				
				if($this->User->save($user)){
					$this->set('success', true);
				} else {
					$this->set('success', false);
				}
			} else {
				$this->Matisse->hardWordpressRedirect('/oops/');
			}	
		}
	}
	
	function thanks(){
		
	}
	
	function existing_user($role = 'neutral'){
		$this->set('role', $role);	
	}
	
	function ui_user(){
		$this->autoRender = false;
		
		if($this->Auth->user()){
			return json_encode(array('username' => $this->Auth->user('username')));
		} else {
			return json_encode(array('username' => false));
		}
	}
    
    function __sendActivationEmail($user_id) {
	
		$user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
		$this->log('$user is ' . $user['User']['username'] . ' and requesting another activation email.' . PHP_EOL);
		
		if ($user === false) {
			$this->log(__METHOD__." failed to retrieve User data for user.id: {$user_id}");
			return false;
		}
 
		$email = new CakeEmail();
		$email->to($user['User']['username']);
		$email->subject('Please activate your HangItUp Chicago account.');
		$email->from(array('admin@[PRODUCTION_URL]' => 'HangItUp Chicago'));
		$email->template('user_confirm');
		$email->emailFormat('html'); 
		$email->viewVars(array('activate_url' => 'http://' . Configure::read('Matisse.host') . '/matisse/users/activate/' . $user['User']['id'] . '/' . $this->User->getActivationHash()));
		return $email->send();
    }
	
    function __sendPasswordEmail($password, $eml) {
	
		$this->log('$user is ' . $eml . ' and requesting a change of password.' . PHP_EOL);
		//debug($password, true, true); debug($email, true, true);
		
		$email = new CakeEmail();
		$email->to($eml);
		$email->subject('New Password for HangItUp CHICAGO');
		$email->from(array('admin@[PRODUCTION_URL]' => 'HangItUp Chicago'));
		$email->template('user_password');
		$email->emailFormat('html'); 
		$email->viewVars(array('password' => $password));
		return $email->send();
    }
	
	function __checkProfile($role, $id){
		
		if ($role !== 'admin'){
			
			$Ctrl = Inflector::pluralize($role);
			
			if(!$this->User->$Ctrl->id){
				
				$this->set('rel', '/{$Ctrl}/add');
				$this->render('/Elements/redirect');
	
			} else {
	
				$this->Auth->redirect();
	
			}
		}
		
		$this->Auth->redirect();
	}
}
