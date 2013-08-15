<?php
App::uses('AppModel', 'Model');
/**
 * AccountItem Model
 *
 * @property Account $Account
 * @property TransactionItem $TransactionItem
 */
class AccountItem extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'amount';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TransactionItem' => array(
			'className' => 'TransactionItem',
			'foreignKey' => 'transaction_item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
