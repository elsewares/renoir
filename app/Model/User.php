<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    
    public $name = 'User';
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'An email address is required.'
            ),
            'email' => array(
				'rule' => array('email'),
                'message' => 'This must be a valid email address.'
            ),
            'unique' => array(
                'rule' => array('unique'),
                'message' => 'This email address has already been registered with the site.'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required.'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'artist', 'client')),
                'message' => 'Please enter a valid role.',
                'allowEmpty' => false
            )
        )
    );
    
    public function beforeSave() {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
    function getActivationHash(){
        
		if (!isset($this->id)) {
			return false;
		}
		return substr(Security::hash(Configure::read('Security.salt') . $this->field('username')), 0, 20);
    }
    
    function unique(){
        return $this->isUnique(array('username' => $this->data['User']['username']));
    }
    
}
?>
