<?php
App::uses('AppModel', 'Model');
/**
 * OrderItem Model
 *
 * @property Order $Order
 * @property Artwork $Artwork
 */
class OrderItem extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'item_type';
    
    //public $recursive = 1;

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
		'Artwork' => array(
			'className' => 'Artwork',
			'foreignKey' => 'artwork_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    public function getRentals($order_id){
        $rentals = array();
        $order = $this->find('all', array('conditions' => array('order_id' => $order_id)));
        foreach ($order['OrderItems'] as $item){
            if($item['item_type'] == 'rental'){
                array_push($rentals, $item);
            }
        }
        return (!empty($rentals))? $rentals : false;
    }
}
