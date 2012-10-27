<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('register', 'login');
	}

	public function register() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {

				$tmp_items = array( 
					'medium' => 'Add a new item on your list', 
					'medium' => 'Use your mouse to reorder items', 
					'low' => 'Sort depending on your mood', 
					'high' => "What ever you do, don't delete all the items!", 
					'low' => 'And maybe try prioritizing your items using shortcuts M, H or "." and "!"'
				);

				foreach($tmp_items as $p => $item) {
					$data['Item'] = array( 'user_id' => $this->User->id, 'content' => $item, 'priority' => $p );
					$this->User->Item->create($data);
					$this->User->Item->save($data);
				}

				$this->redirect(array( 'controller' => 'items', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}

		$this->set('title_for_layout', 'Register an account');
	}

	public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash(__('Invalid username or password, try again'));
	        }
	    }

	    $this->set('title_for_layout', 'Log into your account');
	}

	public function logout() {
	    $this->redirect($this->Auth->logout());
	}

}
