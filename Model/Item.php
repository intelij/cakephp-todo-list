<?php
App::uses('AppModel', 'Model');

class Item extends AppModel {

	public function beforeSave($options = array()) {
		if (!empty($this->data['Item']['content'])) {
			$this->data['Item']['priority'] = $this->setPriority($this->data['Item']['content']);
			$this->data['Item']['content'] = $this->removeExtras($this->data['Item']['content']);
			$this->data['Item']['order'] = $this->setOrder();
		}

		return true;
	}

	public function setPriority($str) {
		$priority = 'low';
		if ( (substr($str, 0, 2) == 'm ') || (substr($str, (strlen($str)-1), 1) == '.') ) {
			$priority = 'medium';
		} elseif ( (substr($str, 0, 2) == 'h ') || (substr($str, (strlen($str)-1), 1) == '!') ) {
			$priority = 'high';
		} else {
			$priority = 'low';
		}

		return $priority;
	}

	public function removeExtras($str) {
		$final = $str;
		if (in_array(substr(strtolower($final), 0, 2), array('m ', 'h '))) {
			$final = substr($final, 2, (strlen($final)-1));
		}
		if (in_array(substr($final, (strlen($final)-1), 1), array('.', '!'))) {
			$final = substr($final, 0,  (strlen($final)-1));
		}

		return $final;
	}

	public function setOrder() {
		if (!isset($this->data['Item']['id'])) {
			$last = $this->find('first', array( 'conditions' => array('Item.user_id' => $this->data['Item']['user_id']), 'order' => 'Item.id DESC' ));
			return $last['Item']['order'] + 1;
		}
	}

	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'priority' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);


	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
