<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('index');
	}

	public function index() {

		if ($this->Auth->user()) {

			$this->Item->recursive = -1;

			$sort = (isset($this->request->query['sort'])) ? $this->request->query['sort'] : 'priority';

			$order = 'Item.created DESC';

			switch ($sort) {
				case 'priority':
					$order = 'FIELD (Item.priority, "high", "medium", "low") ASC';
				break;
				
				case 'order':
					$order = 'Item.order DESC';
				break;
			}

			$items = $this->Item->find('all', array( 'condiitions' => array('Item.user_id' => $this->Auth->user('id')), 'order' => $order ));

			if($this->request->is("ajax")) {
				$this->autoRender = false;
				echo json_encode($items);
			} else {
				$this->set('items', $items);
			}

			$this->set('title_for_layout', 'My items');
			
		} else {
			$this->set('title_for_layout', 'Super simple TODO list');
			$this->render('/Pages/home');
		}
	}

	public function add() {
		if ($this->request->is('post')) {

			$this->request->data['Item']['user_id'] = 1;

			$this->Item->create();
			if ($this->Item->save($this->request->data)) {

				if (!$this->request->is('ajax')) {
					$this->Session->setFlash(__('The item has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->autoRender = false;
					$this->Item->recursive = -1;
					$data = $this->Item->read(null, $this->Item->id);
					echo json_encode($data);
				}
			}
		}
		$users = $this->Item->User->find('list');
		$this->set(compact('users'));
	}

	public function reorder() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->request->data["item"] = array_reverse($this->request->data["item"]);
			foreach($this->request->data["item"] as $k => $v) {
				$this->Item->id = $v;
				$this->Item->saveField('order', $k);
			}
		}
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->Item->delete()) {
			$this->Session->setFlash(__('Item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
