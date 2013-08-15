<?php
App::uses('AppModel', 'Model');
/**
 * Order Model
 *
 * @property Client $Client
 * @property OrderItem $OrderItem
 */
class Order extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'order_id';
    public $primaryKey = 'order_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => array('Client.active' => true),
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
		'OrderItem' => array(
			'className' => 'OrderItem',
			'foreignKey' => 'order_id',
			'dependent' => true,
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
			'foreignKey' => 'order_id',
			'dependent' => true,
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
    
    public function getAmountTotal($_items = array()){
        $ret = 0;
        //debug($_items, true, true);
        //Function is being passed ORM array from 'find' on an existing order, which is $_items[OrderItem][0..n]
        if(isset($_items['Order']) && !empty($_items['Order'])){
            foreach($_items['OrderItem'] as $item){
                $ret += $item['amount'];
            }
            ////debug($ret, true, true); exit();
        }
        //Function is being passed my crappy array from constructing the new order, which is $_items[0..n][OrderItem]
        if(isset($_items[0]['OrderItem']) && !empty($_items[0]['OrderItem'])){
            foreach($_items as $item){
                $ret += $item['OrderItem']['amount'];
            }
            //debug($ret, true, true);
        }
        //And finally, it might get passed just an array of items.
        if(isset($_items[0]['amount'])){
            foreach($_items as $item){
                $ret += $item['amount'];
            }
            ////debug($ret, true, true); exit();
        }
        //debug($ret)
        return ($ret > 0)? $ret : false;
    }
    
    public function getTaxesTotal($_items = array()){
        $ret = 0;
        ////debug($_items, true, true);
        //Function is being passed ORM array from 'find' on an existing order, which is $_items[OrderItem][0..n]
        if(isset($_items['Order']) && !empty($_items['Order'])){
            foreach($_items['OrderItem'] as $item){
                $ret += $item['charges'];
            }
            ////debug($ret, true, true); exit();
        }
        //Function is being passed my crappy array from constructing the new order, which is $_items[0..n][OrderItem]
        if(isset($_items[0]['OrderItem']) && !empty($_items[0]['OrderItem'])){
            foreach($_items as $item){
                $ret += $item['OrderItem']['charges'];
            }
            //debug($ret, true, true);
        }
        
        //And finally, it might get passed just an array of items.
        if(isset($_items[0]['charges'])){
            foreach($_items as $item){
                $ret += $item['charges'];
            }
            ////debug($ret, true, true); exit();
        }
        
        return ($ret > 0)? $ret : false;
    }
    
    public function calculateAmount($item = array(), $type){
        ////debug($item, true, true); //debug($type, true, true);
        switch($type){
            case 'purchase':
                return $item['Artwork']['price'];
                break;
            case 'print':
                return $item['Artwork']['print_price'];
                break;
            case 'rental':
                return $this->_findRentalRate($item['Artwork']['price']);
            default:
                return $item['Artwork']['price'];
                break;
        }
    }

    function calculateCharges($item = array(), $type){
        ////debug($price, true, true); //debug($type, true, true);
        switch($type){
            case "rental":
                return 0.00;
                break;
            default:
                return $item['Artwork']['price'] * Configure::read('Matisse.sales_tax_rate');
                break;
        } 
    }
    
    function _findRentalRate($oprice){
        $_fees = Configure::read('Matisse.fee_schedule');
        foreach($_fees as $_range => $fee){
            $_low = substr($_range, 0, strpos($_range, "."));
            $_high = substr($_range, strpos($_range, ".") + 1);
            if ($oprice >= $_low && $oprice <= $_high){
                return $fee * 3;
            }
        }
        return false;
    }
    
    function rentalOrders($order){
        $_rentals = array();
        foreach($order['OrderItem'] as $orderItem){
            if($orderItem['item_type'] == 'rental'){
                array_push($_rentals, $orderItem['id']);
            }
        }
        
        return (!empty($_rentals))? $_rentals : false;
    }
    
    function checkClient($id, $user_id){
        $client = $this->Client->findByUserId($user_id);
        return $client['id'] == $this->client_id;
    }
}
