<?php

App::uses('File', 'Utility');
App::uses('Folder', 'Utility');


class UploaderBehavior extends ModelBehavior {
  
  var $_imageTypes = array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif', 'image/bmp');
  
  function __construct(&$Model, $data){
    
    if(empty($data)){
      throw new Exception('Request data is empty.', 2048);
    }
  }
  
  function upload(&$Model, $data){
    
    $this->_makeUploadDir($Model->find('first'));
  }
}

?>