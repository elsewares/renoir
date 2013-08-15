<?php
App::uses('AppModel', 'Model');
/**
 * TransactionItem Model
 *
 * @property Transaction $Transaction
 * @property Artwork $Artwork
 * @property AccountItem $AccountItem
 * @property Rental $Rental
 */
class TransactionItem extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'transaction_type';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Transaction' => array(
			'className' => 'Transaction',
			'foreignKey' => 'transaction_id',
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'AccountItem' => array(
			'className' => 'AccountItem',
			'foreignKey' => 'transaction_item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Rental' => array(
			'className' => 'Rental',
			'foreignKey' => 'transaction_item_id',
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
