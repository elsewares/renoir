<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');
CakePlugin::load('Uploader');
App::import('Vendor', 'Uploader.Uploader');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $components = array(
        'Session',
        'AutoLogin',
        'Auth' => array(
            'loginAction' => array('controller' => 'users', 'action' => 'login'),
            'loginRedirect' => array('controller' => 'users', 'action' => 'wp_logout'),
            'logoutRedirect' => array('action' => 'index'),
            'authorize' => array('Controller')
        ),
        'Cookie',
        'Matisse',
        'Cart',
        'Email',
		'App',
		'Artwrk'
    );
    
    public $helpers = array('Matisse', 'Html', 'Form', 'Js', 'Session', 'Thumbnail', 'BootstrapForm');

    public $layout = 'matisse';
    
    function beforeFilter() {		
		// Authenticate settings.
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'view', $this->Auth->user('id'));
		$this->Auth->loginError = 'No username and password was found with that combination.';
		$this->Auth->logoutRedirect = '/';
		
		$_site = $this->loadModel('Site');
		$this->_setFeatured();
        
    }
    
    public function isAuthorized() {
        if ($this->Auth->user() && $this->Auth->user('role') == 'admin') {
            return true; 
        }
        return false;
    }

    public function beforeRender(){
        parent::beforeRender();
        $this->set('user', $this->Auth->user());
        //$layout = $this->_getLayout();
        
        if ((isset($this->params['admin']) && $this->params['admin'] == true)) {
            $this->layout = 'default';
            //debug($this->params);
        } else {
            $this->layout = $this->_getLayout();
        }
    }
    
    function _getLayout(){
        
        return 'matisse';
    }
    
    function wordpress($uri){
        $str = 'Location: ' . Configure::read('Matisse.front') . $uri;
        header($str);
        return true;
    }
	
	function _setFeatured(){
			$featured = $this->Site->findByKey('featured');
			$featured = explode(",", $featured['Site']['metadata']);
			Configure::write('Matisse.featuredArtworks', $featured);
	}


}

?>