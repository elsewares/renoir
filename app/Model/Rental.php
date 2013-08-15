<?php
App::uses('AppModel', 'Model');
/**
 * Rental Model
 *
 * @property Artwork $Artwork
 * @property Location $Location
 */
class Rental extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = '';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'alias' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'artwork_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

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
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
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
		),
 		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),       
        
	);
    
    public $cleanRentals = true;
    
    public function afterFind($result = array(), $primary = false){
        /*CakeLog::write('error', 'afterFind fired!');
        $this->log('afterFind -> ' . var_export($result, true), 'debug');
        if($primary == true && $cleanRentals == true){
            foreach($result as $k => $r){
                if($this->cleanRental($r))
                    unset($result[$k]);
            }
        }
        
        if($primary == false && $cleanRentals == true){
            if($this->cleanRental($result)){
                $result = null;
            }
        }
        
        return $result; */
    }
    
    public function cleanRental($r){
        $this->log('afterFind -> ' . var_export($r, true), 'debug');
        $today = strtotime(date('Y-m-d') . " 00:00:00");
        if(isset($r['Rental'])){
            if($r['Rental']['on_hold'] == true || ($r['Rental']['on_hold'] == false && $r['Rental']['end_date'] < $today)){
                return true;
            }
        }
        
        if(isset($r['on_hold'])){
            if($r['on_hold'] == true || ($r['on_hold'] == false && $r['end_date'] < $today)){
                return true;
            }
        }
        
        return false;
    }
    
}
