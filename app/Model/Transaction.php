<?php
App::uses('AppModel', 'Model');
/**
 * Transaction Model
 *
 * @property Order $Order
 * @property Client $Client
 */
class Transaction extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'uuid';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'order_id',
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
}
