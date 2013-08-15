<?php

App::uses('Component', 'Controller');

class AppComponent extends Component {
    
	var $components = array('Matisse');
	var $CTRL = '';
    var $EMAIL = '';
    
    
	function initialize(&$controller){
		
		$this->CTRL = $controller;
		//$this->loadModel('Site');
        
	}
	
}

?>