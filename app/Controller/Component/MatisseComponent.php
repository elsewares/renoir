<?php

class MatisseComponent extends Component {
    
	var $components = array('Session');
	var $Ctrl = '';
	
	function initialize(&$controller){
		
		$this->Ctrl = $controller;
		
	}
	
	function today(){
		return date('Y-m-d');
	}
	
	//Necessary for generating gallery seeds.
	function random_float($min, $max, $round = 10){

		$randomfloat = $min + mt_rand() / mt_getrandmax() * ($max - $min);
		if($round > 0)
			$randomfloat = round($randomfloat,$round);
	 
		return $randomfloat;
	}
	
	//Renders a modal dialog, detected by Javascript on the client side.
	//Button rels should be WORDPRESS slugs, not Cake URLs.  No leading slash!
	
	function modal($flash_msg = '', $btn = false){
		$this->__setFlash(__($flash_msg));
		
		if($btn){
			$this->Ctrl->set('btn', $btn);
		}
        
        $this->Ctrl->render('/Elements/flash', 'matisse');
	}
    
	// Takes a Wordpress slug and passes it as the rel attribute on an empty div.
	// NO leading slash in the slug!
	
    function wordpressRedirect($rel = '/'){
        $this->Ctrl->set(array('rel' => $rel));
        $this->Ctrl->render('/Elements/redirect');
    }
	
	function renderIframe($href = ''){
		$this->Ctrl->set(array('href' => $href));
		$this->Ctrl->render('/Elements/iframe');
	}
	
	function jsonResponse($success = true, $additional_keys = array(), $msg = "Success."){
		$echo = array('success' => $success, 'message' => $msg);
		foreach($additional_keys as $key => $val) $echo[$key] = $val;
		echo json_encode($echo);
		exit(0);
	}
	
	function __setFlash($msg = '', $type = 'default'){
		$this->Ctrl->set(array('message' => $msg, 'type' => 'flash-' . $type));
		return true;
	}
	
	function formatDimensions($data){
		return 'h' . $data['Artwork']['dimensions-h'] . ':w' . $data['Artwork']['dimensions-w'] . ':d' . $data['Artwork']['dimensions-d'];
	}
		
	function regexDimensions($dimS = '', $doString = true){
	  $regex = "/(\d*)/";
	  $str = '';
	  $out = array();
	  preg_match_all($regex, $dimS, $match);
	  foreach($match[0] as $d){
		if (empty($match[0])) return $str;
		if ($d !== ''){
			array_push($out, $d);
		}
	  }
	  
	  if(count($out) == 2){
		  $str = sprintf("%s in  x  %s in", $out[0], $out[1]);
	  } else {
		  $str = sprintf("%s in  x  %s in  x  %s in", $out[0], $out[1], $out[2]);   
	  }
	  
	  return ($doString)? $str : $out;
	  
	}
	
	function cleanPrices($price){
		if(preg_match("^\$", $price)){
			return substr(trim($price), 1);
		} else {
			return trim($price);
		}
	}
	
	function formatFileName($name, $field, $file) {
		return md5($name . time());
	}
	
	function hardWordpressRedirect($rel = ''){
		$this->Ctrl->redirect(Configure::read('Matisse.front') . $rel);
	}
	
	function hardHashRedirect($rel = '', $hash_value = '', $do = true){
		if($do){
		$this->Ctrl->redirect(Configure::read('Matisse.front') . $rel . '/#' . Configure::read('Matisse.appName') . ":" . $hash_value);
		} else {
			echo Configure::read('Matisse.front') . $rel . '#' . Configure::read('Matisse.appName') . ":" . $hash_value;
		}
	}
	
	function setClientType($int = 0){
		switch($int){
			case 0:
				return 'Business';
			case 1:
				return 'Personal';
			default:
				return 'Personal';
		}
		return true;
	}
	
	function getRandomSeed(){
		$seed = 0;
		if ($this->Session->check('randomSeed')) { 
			$seed = $this->Session->read('randomSeed'); 
		} else { 
			$seed = mt_rand(); 
			$this->Session->write('randomSeed', $seed); 
		}
		return $seed;
	}
	
	function makeTransactionHash($time, $total){
		$store = Configure::read('Matisse.storeName');
		$secret = Configure::read('Matisse.storeSecret');
		return hash("sha256", $store . $time . $total . $secret);
	}
	
	function shuffleGallery(&$array){

		if(!is_array($array) || empty($array)) {
			return false;
		}
		$tmp = array();
		foreach($array as $key => $value) {
			$tmp[] = array('k' => $key, 'v' => $value);
		}
		shuffle($tmp);
		$array = array();
		foreach($tmp as $entry) {
			$array[$entry['k']] = $entry['v'];
		}
		return true;
	}
	
	function random_string($l = 10){
		$c = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxwz0123456789";
		$s = '';
		for(;$l > 0;$l--) $s .= $c{rand(0,strlen($c))};
		return str_shuffle($s);
	}
	
}

?>
