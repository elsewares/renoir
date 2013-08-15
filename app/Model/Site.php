<?php

App::uses('AppModel', 'Model');

class Site extends AppModel {

    public $name = "Site";
    public $actsAs = array('Containable');
    public $findMethods = array('key' =>  true);
    
	public function isAuthorized() {
        if ($this->Auth->user() && $this->Auth->user('role') == 'admin') {
            return true; 
        }
        
		$this->Matisse->hardWordpressRedirect('/oops/');
    }
    
    public function get_featured(){
        $list = $this->Site->find('first', array('conditions' => array('key' => 'featured')));
		return explode(',', $list);
    }
    
    protected function _findKey($state, $query, $results = array()) {
        if ($state == 'before') {
            $query['conditions']['Article.published'] = true;
            return $query;
        }
        return $results;
    }
}

?>