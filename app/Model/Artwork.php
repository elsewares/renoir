<?php
App::uses('AppModel', 'Model');
/**
 * Artwork Model
 *
 * @property Artist $Artist
 * @property Image $Image
 * @property Rental $Rental
 */
class Artwork extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
    
    public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array */
 
	public $validate = array(
		'artist_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title cannot be empty.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Description cannot be empty.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price' => array(
        	'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Original price cannot be empty.'
            ),
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'Please enter only numbers and a decimal.  Do not enter a dollar sign.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notzero' => array(
				'rule' => array('notZeroPrice'),
				'message' => 'Price cannot be zero.',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'print_price' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'Please enter only numbers and a decimal.  Do not enter a dollar sign.',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'custom' => array(
			'boolean' => array(
				'rule' => array('boolean'),
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
		'Artist' => array(
			'className' => 'Artist',
			'foreignKey' => 'artist_id',
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
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'artwork_id',
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
			'foreignKey' => 'artwork_id',
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
		'OrderItem' => array(
			'className' => 'OrderItem',
			'foreignKey' => 'artwork_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
            'finderQuery' => '',
			//'finderQuery' => 'SELECT * FROM order_items AS oi RIGHT JOIN orders as o ON oi.order_id = o.order_id WHERE o.paid = true',
			'counterQuery' => ''
		),
	);

    public function beforeSave(){
        parent::beforeSave();
    }
    
    public function beforeValidate(){
        parent::beforeValidate();
        if(isset($this->data['price'])){
            $this->data['Artwork']['price'] = $this->data['price'];
            $this->data['Artwork']['print_price'] = $this->data['print_price'];
        }
        return true;
    }
    
    public function afterFind($results, $primary = false){
        foreach ($results as $key => $val) {
            if (isset($val['Artwork']['dimensions'])) {
                $results[$key]['Artwork']['size_category'] = $this->sizeCategory($val['Artwork']['dimensions']);
            }
        }

        if(isset($results['Rental']) && !empty($results['Rental'])){
            foreach($results as $res){
                $res['Rental'] = $this->cleanRentals($res['Rental']);
            }
        }
        return $results;
    }
    
    public function isRented($rentals = array()){
        $rental = false;
        if(!empty($rentals)){
            $today = strtotime(date('Y-m-d') . " 00:00:00");
            foreach($rentals as $rental){
                $rental = ($rental['on_hold'] == false && strtotime($rental['end_date']) < $today)? false : true;
            }
        }
        return $rental;
    }
    
    public function isPurchased($orderItem = array()){
        $purchased = false;
        foreach($orderItem as $item){
            if($item['item_type'] == 'purchase' && (!empty($item['Order']) && $item['Order']['paid'] == true)){
                $purchased = true;
            }
        }
        return $purchased;
    }
    
    public function cleanRentals($rentals = array()){
        $today = strtotime(date('Y-m-d') . " 00:00:00");
        foreach($rentals as $k => $rental){
            if($rental['on_hold'] == true || $rental['on_hold'] == false && ($rental['start_date'] < $today && $rental['end_date'] < $today)){
                unset($rentals[$k]);
            }
        }
        
        return $rentals;
    }
    
    public function notZeroPrice($check){
        //debug($check, true, true);
        if ($check['price'] == '0.00')
            return false;
        
        return true;
    }
    
    //Note: $_dimS = 'dimensions string' format is: h##:w##:d##
    
    public function sizeCategory($dimS){
        $h = $this->extractDimension($dimS, 'h');
        $w = $this->extractDimension($dimS, 'w');
        $d = $this->extractDimension($dimS, 'd');
        $categories = Configure::read('Matisse.size_categories');

        $a = intval($h) * intval($w);

        $ret = '';
        if($a > $categories['large']){
            $ret = "x-large";
        } else {
            if ($a < intval($categories['large'])) $ret = "large";
            if ($a < intval($categories['medium'])) $ret = "medium";
            if ($a < intval($categories['small'])) $ret = "small";
        }
        
        return $ret;
    }
    
    public function findArtworkBySize($cat){
        
        $all = $this->find('list', array('fields' => array('Artwork.id', 'Artwork.dimensions'), 'conditions' => array('Artwork.active' => true)));
        $cat = $this->sizeString($cat);
        $ret = array();
        
        foreach($all as $id => $dim){
            $test = $this->sizeCategory($dim);
            if ($test == $cat) array_push($ret, $id);
        }
        
        return $ret;
    }
    
    public function sizeString($int){
        $ret = 'small';
        
        switch($int){
            case 0:
                $ret = 'small';
                break;
            case 1:
                $ret = 'medium';
                break;
            case 2:
                $ret = 'large';
                break;
            case 3:
                $ret = 'x-large';
                break;
            default:
                $ret = 'small';
        }
        
        return $ret;
    }
    
    function extractDimension($dimS = '', $which = ''){
	  $regex = "/(\d*)/";
	  $str = '';
	  $out = array();
	  preg_match_all($regex, $dimS, $match);
	  foreach($match[0] as $d){
		if (empty($match[0])) return $str;
		if ($d !== ''){
			array_push($out, $d);
		}
	  }
	  
	  switch($which){
        case 'h':
            return (!empty($out[0]))? $out[0] : 1;
        case 'w':
            return (!empty($out[1]))? $out[1] : 1;
        case 'd':
            return (!empty($out[2]))? $out[2] : 1;
      }
	  
	}
}
