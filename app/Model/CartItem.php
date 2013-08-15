<?php
App::uses('AppModel', 'Model');
/**
 * CartItem Model
 *
 * @property Cart $Cart
 * @property Artwork $Artwork
 */
class CartItem extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Cart' => array(
			'className' => 'Cart',
			'foreignKey' => 'cart_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Artwork' => array(
			'className' => 'Artwork',
			'foreignKey' => 'artwork_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
