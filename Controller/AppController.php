<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array(
		'Auth' => array( 
			'loginRedirect' => array('controller' => 'items', 'action' => 'index'),
	        'logoutRedirect' => array('controller' => 'items', 'action' => 'index'),
	        'authorize' => array('Controller'),
	        'authenticate' => array('Form' => array('fields' => array('username' => 'email')))
	    ), 
		'Session'
	);

	public function beforeFilter() {
		//$this->Auth->authenticate = array('Form');
	}

	public function isAuthorized() {
		return true;
	}

}
