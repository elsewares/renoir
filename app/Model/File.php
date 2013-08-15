<?php
App::uses('AppModel', 'Model');
/**
 * File Model
 *
 * @property Artwork $Artwork
 */
class File extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'uri';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Artwork' => array(
			'className' => 'Artwork',
			'foreignKey' => 'artwork_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
