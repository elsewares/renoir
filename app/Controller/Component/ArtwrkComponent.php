<?php

App::uses('Component', 'Controller');

class ArtwrkComponent extends Component {
    
	var $components = array('Matisse');
	var $CTRL = '';
    
    
	function initialize(&$controller){
		
		$this->CTRL = $controller;
		//$this->loadModel('Site');
        
	}
    
    function setGallerySeed(){
        if(!SessionComponent::read('Gallery.seed')){
            $seed = $this->Matisse->random_float(0,1);
            SessionComponent::write('Gallery.seed');
        }
    }
	
}

?>