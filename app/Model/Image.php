<?php
App::uses('AppModel', 'Model');
/**
 * Image Model
 *
 * @property Artwork $Artwork
 */
class Image extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'path' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'featured' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'filetype' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'filesize' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		)
	);
    
    public $actsAs = array( 
        'Uploader.Attachment' => array(
            'fileName' => array(
                'name'		=> '_formatFileName',	// Name of the function to use to format filenames
                'baseDir'	=> '',			// See UploaderComponent::$baseDir
                'uploadDir'	=> 'files/uploads/',			// See UploaderComponent::$uploadDir
                'dbColumn'	=> 'uri',	// The database column name to save the path to
                'importFrom'	=> '',			// Path or URL to import file
                'defaultPath'	=> '',			// Default file path if no upload present
                'maxNameLength'	=> 41,			// Max file name length
                'overwrite'	=> false,		// Overwrite file with same name if it exists
                'stopSave'	=> true,		// Stop the model save() if upload fails
                'allowEmpty'	=> false,		// Allow an empty file upload to continue
                'transforms'	=> array(),		// What transformations to do on images: scale, resize, etc
                's3'		=> array(),		// Array of Amazon S3 settings
                'metaColumns'	=> array(		// Mapping of meta data to database fields
                    'ext' => '',
                    'type' => '',
                    'size' => '',
                    'group' => '',
                    'width' => '',
                    'height' => '',
                    'filesize' => ''
                )
            )
        )
    );
    
    public function beforeSave(){
        parent::beforeSave();
        
    }
    
    public function resize($width = ''){
        
        if($width = 'span7'){
            return Uploader::resize(array('width' => 540, 'aspect' => true, 'append' => '_span7'));
        }
        
        if($width = 'span3'){
            return Uploader::resize(array('width' => 220, 'aspect' => true, 'append' => '_span3'));
        }
    }
}

?>
