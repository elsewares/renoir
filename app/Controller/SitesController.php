<?php

class SitesController extends AppController {
    
    public $layout = 'default';
	
    public function beforeFilter(){
        parent::beforeFilter();
		$this->Auth->allow();
    }
	
    public function beforeRender(){
        $this->set('user', $this->Auth->user());
        if ((isset($this->params['admin']) && $this->params['admin'] == true)) {
            $this->layout = 'default';
        }
    }
	
	function _getLayout(){
		if($this->request->action == 'submission'){
			$this->layout = 'iframe';
		}
	}

    public function isAuthorized() {
        if ($this->Auth->user() && $this->Auth->user('role') == 'admin') {
            return true; 
        }
        return false;
    }
    
    public function admin_change_featured(){
        
        $list = $this->Site->find('first', array('conditions' => array('key' => 'featured')));
		
        if($this->request->is('get')){
            $this->loadModel('Artwork');
			$list = explode(",", $list['Site']['metadata']);
			$artworks = $this->Artwork->find('all', array('conditions' => array('Artwork.id' => $list)));
			$this->set(array('artworks' => $artworks, 'list' => $list));
        }
        
        if($this->request->is('post')){
			$list['Site']['metadata'] = $this->request->data('Site.metadata');
			$this->Site->save($list);
			$this->setFlash('Saved.');
        }
    }
	
	//Returns indexed array of artwork ids.
	public function get_featured(){

	}
	
}