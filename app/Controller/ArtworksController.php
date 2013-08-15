<?php
App::uses('AppController', 'Controller');
/**
 * Artworks Controller
 *
 * @property Artwork $Artwork
 */
class ArtworksController extends AppController {

	public $layout = 'matisse';

	public $paginate = array('conditions' => array('Artwork.active' => true),
							 'order' => 'RAND()',
							 'limit' => 15);
	
	protected $artist = '';
	protected $count = 0;
	
    public function beforeFilter(){
        parent::beforeFilter();
		$this->Uploader = new Uploader(Configure::read('Matisse.uploadConfig'));
		$this->Auth->allow('view', 'index', 'search', 'search_form', 'nonartist_submission', 'featured', 'schmindex');
		$this->loadModel('Artist');
		
		//Gallery randomization + persistence.
		$this->Artwrk->setGallerySeed();
		$this->paginate['order'] = sprintf('RAND(%f)', $this->Session->read('Gallery.seed'));
    }
	
    public function beforeRender(){
        $this->set('user', $this->Auth->user());
        if ((isset($this->params['admin']) && $this->params['admin'] == true)) {
            $this->layout = 'default';
        }
		
		if($this->request->action == 'submission'){
			$this->layout = 'iframe';
		}
    }
	
	function _getLayout(){
		if($this->request->action == 'submission'){
			$this->layout = 'iframe';
		}
	}

    public function isAuthorized() {
        if ($this->Auth->user()) {
            return true; 
        }
        return false;
    }
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Artwork->recursive = 1;
		$this->Artwork->contain(array('Artist', 'Image', 'Rental', 'OrderItem' => 'Order'));
		$artworks = $this->paginate();
		foreach ($artworks as $k => $artwork){
			$artworks[$k]['Artwork']['is_rented'] = $this->Artwork->isRented($artwork['Rental']);
			$artworks[$k]['Artwork']['is_purchased'] = $this->Artwork->isPurchased($artwork['OrderItem']);
		}
		
		$this->set('artworks', $artworks);
		//debug($artworks, true, true);
	}
	
	public function schmindex() {
		$this->Artwork->recursive = 1;
		$this->Artwork->contain(array('Artist', 'Image', 'Rental', 'OrderItem' => 'Order'));
		$artworks = $this->paginate();
		foreach ($artworks as $k => $artwork){
			if($this->Artwork->isRented($artwork['Rental'])) $artwork[$k]['Artwork']['is_rented'] = true;
			if($this->Artwork->isPurchased($artwork['OrderItem'])) $artwork[$k]['Artwork']['is_purchased'] = true;
		}
		
		$this->set('artworks', $artworks);
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Artwork->id = $id;
		$this->Artwork->recursive = 1;
		$this->Artwork->contain(array('Artist', 'Image', 'Rental', 'OrderItem' => 'Order'));
		
		if (!$this->Artwork->exists()) {
			throw new NotFoundException(__('Invalid artwork'));
		}
		
		$artwork = $this->Artwork->find('first', array('conditions' => array('Artwork.id' => $id)));
		if($this->Artwork->isRented($artwork['Rental'])) $artwork['Artwork']['is_rented'] = true;
		if($this->Artwork->isPurchased($artwork['OrderItem'])) $artwork['Artwork']['is_purchased'] = true;
		//debug($artwork, true, true);
		$this->set('artwork', $artwork);
	}
	
	public function featured(){
		$artworks = array();
		$this->Artwork->recursive = 1;
		foreach(Configure::read('Matisse.featuredArtworks') as $art_id){
			$artwork = $this->Artwork->find('first', array('conditions' => array('Artwork.id' => $art_id)));
			array_push($artworks, $artwork);
		}

		$this->set('artworks', $artworks);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Artwork->create();
			if ($this->Artwork->save($this->request->data)) {
				$this->Session->setFlash(__('The artwork has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The artwork could not be saved. Please, try again.'));
			}
		}
		$artists = $this->Artwork->Artist->find('list');
		$this->set(compact('artists'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Artwork->id = $id;
		if (!$this->Artwork->exists()) {
			throw new NotFoundException(__('Invalid artwork'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Artwork']['dimensions'] = $this->Matisse->formatDimensions($this->request->data);
			$this->request->data['Artwork']['price'] = $this->request->data['price'];
			$this->request->data['Artwork']['print_price'] = $this->request->data['print_price'];
			
			if ($this->Artwork->save($this->request->data)) {
				$this->Session->setFlash(__('The artwork has been saved'));
				$this->Matisse->wordpressRedirect('/artist-profile/');
			} else {
				$this->Session->setFlash(__('The artwork could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Artwork->read(null, $id);
			$dimensions = $this->Matisse->regexDimensions($this->request->data('Artwork.dimensions'), false);
			//debug($dimensions);
			$this->request->data['Artwork']['dimensions-h'] = $dimensions[0];
			$this->request->data['Artwork']['dimensions-w'] = $dimensions[1];
			$this->request->data['Artwork']['dimensions-d'] = $dimensions[2];
		}
		
		//$artists = $this->Artwork->Artist->find('list');
		//$this->set(compact('artists'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Artwork->id = $id;
		if (!$this->Artwork->exists()) {
			throw new NotFoundException(__('Invalid artwork'));
		}
		if ($this->Artwork->delete()) {
			//$this->Session->setFlash(__('Artwork deleted'));
			$this->Matisse->wordpressRedirect('/artist-profile/');
			return true;
		}
		$this->Session->setFlash(__('Artwork was not deleted'));
		$this->Matisse->wordpressRedirect('/artist-profile/');
		return false;
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Artwork->recursive = 0;
		$this->set('artworks', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Artwork->id = $id;
		if (!$this->Artwork->exists()) {
			throw new NotFoundException(__('Invalid artwork'));
		}
		$this->set('artwork', $this->Artwork->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Artwork->create();
			if ($this->Artwork->save($this->request->data)) {
				$this->Session->setFlash(__('The artwork has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The artwork could not be saved. Please, try again.'));
			}
		}
		$artists = $this->Artwork->Artist->find('list');
		$this->set(compact('artists'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Artwork->id = $id;
		
		if (!$this->Artwork->exists()) {
			throw new NotFoundException(__('Invalid artwork'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Artwork->save($this->request->data)) {
				$this->Session->setFlash(__('The artwork has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The artwork could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Artwork->read(null, $id);
		}
		$artists = $this->Artwork->Artist->find('list');
		$this->set(compact('artists'));
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Artwork->id = $id;
		if (!$this->Artwork->exists()) {
			throw new NotFoundException(__('Invalid artwork'));
		}
		if ($this->Artwork->delete()) {
			$this->Session->setFlash(__('Artwork deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Artwork was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function submission() {

		//NOTE: This action uses the iframe.ctp layout.
		$this->layout = "iframe";
		
		if($this->request->is('get')){
			if($this->Auth->user()){
				if($this->Auth->user('role') == 'artist'){
					$this->_getArtworkCount();
				} else {
					$this->redirect(array('action' => 'nonartist_submission'));
					//debug($this->Auth->user());
				}
			} else {
				$this->Auth->redirect(array('controller' => 'users', 'action' => 'login'));
			}
		}
		
		if ($this->request->is('post')) {
			$this->_getArtworkCount();
			$this->Artwork->create();
			$this->Artwork->Image->create();
			
			$this->request->data['Artwork']['dimensions'] = $this->Matisse->formatDimensions($this->request->data);
			$this->request->data['Artwork']['price'] = $this->request->data['price'];
			$this->request->data['Artwork']['print_price'] = $this->request->data['print_price'];
			unset($this->request->data['price']);
			unset($this->request->data['print_price']);
			
			$data = '';
//				$this->request->data['Artwork']['price'] = $this->Matisse->cleanPrices($this->request->data['Artwork']['price']);
//				$this->request->data['Artwork']['print_price'] = $this->Matisse->cleanPrices($this->request->data['Artwork']['print_price']);
			
			if($this->Artwork->save($this->request->data)){
				
				if($data = $this->Uploader->upload($this->request->data('Artwork.image'))){

					$span3 = $this->Uploader->resize(array('width' => 240));
					$this->Artwork->Image->set(array('uri' => $data['path']));
					$this->Artwork->Image->set(array('filetype' => $data['type']));
					$this->Artwork->Image->set(array('filesize' => $data['size']));
					$this->Artwork->Image->set(array('width' => $data['width']));
					$this->Artwork->Image->set(array('height' => $data['height']));
					$this->Artwork->Image->set(array('uri_span3' => $span3));
					$this->Artwork->Image->set(array('artwork_id' => $this->Artwork->id));
					
					if($this->Artwork->Image->save()){
						$this->Session->setFlash('Artwork submitted!', 'flash-success');
					} else {
						$this->Session->setFlash('Artwork image did not save properly, please try again.', 'flash-failure');				
					}
					
				} else {
					
						$this->Session->setFlash('The file upload failed.  Please try again.', 'flash-failure');
						$this->set('errors', $this->Artwork->validationErrors);
				}
					
			} else {
				
				if(!empty($this->Artwork->validationErrors)){
					$this->set('errors', $this->Artwork->validationErrors);
				}
			}
		}
	}
	
	public function nonartist_submission(){
		
	}
	
	public function search($param =''){
		$this->Artwork->contain(array('Artist', 'Image', 'Rental', 'OrderItem' => 'Order'));
		$conditions = array();
		
		if($this->request->is('get') && $param == ''){
			$this->render();
		}
		
		if($this->request->is('get') && $this->request->data('Artwork.from') == 'searchbar'){
			$type = "keyword";
			
			if($type == "keyword"){
				$keywords = explode("-", $param);
				foreach($keywords as $keyword){
					if (!empty($keyword)) {
						$kwd = sprintf('%%%s%%', $keyword);
						$conditions[] = array('OR' => array('Artwork.title LIKE' => $kwd,
															'Artwork.description LIKE' => $kwd));
					}
				}
				$result = $this->Artwork->find('all', array('conditions' => $conditions, 'order' => 'RAND()'));
				$this->set('result', $result);
			}
		}
		
		if($this->request->is('post')){
			//debug($this->request->data);
			if($this->request->data('Artwork.searchtype') == 'price'){
				$conditions[] = sprintf('Artwork.price BETWEEN %s AND %s', $this->request->data('Artwork.low_price'),$this->request->data('Artwork.high_price'));
			}
			
			if($this->request->data('Artwork.searchtype') == 'size'){
				$conditions[] = array();
				//returns array of artwork ids.
				$size = $this->Artwork->sizeString($this->request->data('Artwork.size'));
				$_results = $this->Artwork->findArtworkBySize($this->request->data('Artwork.size'));
				//construct conditions array.
				$conditions[] = array('Artwork.id' => $_results);
			}
			
			if($this->request->data('Artwork.searchtype') == 'keyword'){
				$keywords = explode(" ", $this->request->data('Artwork.keywords'));
				foreach($keywords as $keyword){
					if (!empty($keyword)) {
						$kwd = sprintf('%%%s%%', $keyword);
						$conditions[] = array('OR' => array('Artwork.title LIKE' => $kwd,
															'Artwork.description LIKE' => $kwd));
					}
				}
			}
			$result = $this->Artwork->find('all', array('conditions' => $conditions, 'order' => 'RAND()'));
			$this->set('result', $result);
		}
	}
	
	public function search_form(){
		$this->autoRender = false;
		$this->render('/Elements/Artworks/search_form');
	}
	
	public function admin_approve(){
		$this->Artwork->create();
		$ret = array();
		$rej = array();
		if($this->request->is('post')){
			foreach($this->request->data('approve') as $approval_id => $val){
				if($approval_id == $val){
					$approved = $this->Artwork->read(null, $val);
					$approved['Artwork']['is_submission'] = false;
					$approved['Artwork']['active'] = true;
					if($this->Artwork->save($approved)){
						//debug($approved, true, true);
						$val = "Artwork " . $approved['Artwork']['title'] . " approved for the site." . PHP_EOL;
						array_push($ret, $val);
					} else {
						debug($approved, true, true);
						$val = "Artwork " . $approved['Artwork']['title'] . " failed to approve correctly.  Call Brian if this keeps up." . PHP_EOL;
						array_push($ret, $val);
					}
				}
			}
			foreach($this->request->data('reject') as $reject_id => $val){
				if($reject_id == $val){
					$rejected = $this->Artwork->read(null, $val);
					$rejected['Artwork']['is_submission'] = false;
					$rejected['Artwork']['active'] = false;
					if($this->Artwork->save($rejected)){
						//debug($approved, true, true);
						$val = "Artwork " . $rejected['Artwork']['title'] . " rejected from the site." . PHP_EOL;
						array_push($rej, $val);
					} else {
						debug($approved, true, true);
						$val = "Artwork " . $rejected['Artwork']['title'] . " failed to reject correctly.  Call Brian if this keeps up." . PHP_EOL;
						array_push($rej, $val);
						
					}
				}
			}
			
			$this->set('approvals', $ret);
			$this->set('rejections', $rej);
			$limit = $this->_updateRestrictions();
			$this->set('unlimited', $limit);
			$this->render('../Admin/art_approval', 'default');
		}
		$artworks = $this->Artwork->find('all', array('conditions' => array('Artwork.is_submission' => true, 'Artwork.active' => false)));
		$this->set('artworks', $artworks);
		
	}
	
	public function make_thumbnails_now_gabba_gabba(){
		$artworks = $this->Artwork->find('all', array('recursive' => 2));
		foreach($artworks as $artwork){
			$_image = $artwork['Image'];
			debug($_image);
			$image = $this->Artwork->Image->find('first', array('conditions' => array('Image.id' => $_image[0]['id'])));
			debug($image);
			$thmb = $this->Artwork->Image->makeExistingThumb();
			$image['uri_span3'] = $thmb;
			if ($this->Artwork->Image->save($image)){
				echo $image['Image']['id'] . " : " . $image['Image']['uri'] . " : " . $image['Image']['uri_span3'] . PHP_EOL;
			} else {
				echo $image['id'] . " thumbnail failed." . PHP_EOL;
			}
		}
	}
	
	function _updateRestrictions(){
        $ret = array();
		$artist = $this->Artist->create();
        $this->Artist->recursive = 0;
        $list = $this->Artist->find('list', array('conditions' => array('Artist.active' => true, 'Artist.restricted' => true), 'fields' => array('Artist.id')));

		foreach($list as $a_id){
			$count = $this->Artwork->find('count', array('conditions' => array('Artwork.active' => true, 'is_submission' => false, 'Artwork.artist_id' => $a_id)));
			$html = '';
			if ($count == 5){
				$artist = $this->Artist->read(null, $a_id);
				$artist['Artist']['restricted'] = false;
				if($this->Artist->save($artist)){
					$html .= 'Artist ' . $artist['Artist']['id'] . ' was made unlimited.' . PHP_EOL;
					return $html;
				}
			}
		}
	}
	
	function _getArtworkCount(){
		$this->loadModel('Artist');
		$this->artist = $this->Artist->find('first', array('conditions' => array('user_id' => $this->Auth->user('id'))));
		$this->count = $this->Artwork->find('count', array('conditions' => array('artist_id' => $this->artist['Artist']['id'])));
		$this->set('count', $this->count);
		$this->set('artist', $this->artist);
	}

}
