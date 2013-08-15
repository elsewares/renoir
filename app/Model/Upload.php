<?php
App::uses('AppModel', 'Model');
/**
 * Upload Model
 *
 * @property Image $Image
 */
class Upload extends AppModel {

    var $name = "Upload";
    
    var $actsAs = array('MeioUpload');

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'image_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
