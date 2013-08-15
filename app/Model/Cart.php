<?php
App::uses('AppModel', 'Model');
/**
 * Cart Model
 *
 * @property Session $Session
 * @property Client $Client
 * @property CartItem $CartItem
 */
class Cart extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Session' => array(
			'className' => 'CakeSession',
			'foreignKey' => 'cake_session_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CartItem' => array(
			'className' => 'CartItem',
			'foreignKey' => 'cart_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
