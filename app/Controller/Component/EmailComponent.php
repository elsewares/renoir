<?php

App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class EmailComponent extends Component {
    
	var $components = array('Matisse');
	var $CTRL = '';
    var $EMAIL = '';
    
    
	function initialize(&$controller){
		
		$this->CTRL = $controller;
        
		$this->EMAIL = new CakeEmail();
        $this->EMAIL->to(Configure::read('Matisse.admin_email'));
        $this->EMAIL->subject('Admin email: ');
        $this->EMAIL->from(array('admin@[PRODUCTION_URL]' => 'Automated Email'));
        $this->EMAIL->template('admin/admin');
        $this->EMAIL->emailFormat('html');
	}
    
    function rentalEmail($rental = array(), $subj = 'Rental Order'){
        $this->EMAIL->subject .= $subj;
        $this->EMAIL->template('admin/rental');
        $this->EMAIL->viewVars(array('rental' => $rental));
        $this->log('Rental email sent for rental_id: ' . $rental['Rental']['id']);
        if($this->EMAIL->send()){ return true; } else { return false; }
    }
	
	function registerEmail($user = array(), $subj = 'User Registered'){
        $this->EMAIL->subject .= $subj;
        $this->EMAIL->template('admin/registration');
        $this->EMAIL->viewVars(array('user' => $user));
        $this->log('Registration email sent for user id: ' . $user['User']['username']);
        if($this->EMAIL->send()){ return true; } else { return false; }
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
    
}

?>