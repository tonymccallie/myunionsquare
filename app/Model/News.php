<?php
App::uses('AppModel', 'Model');
class News extends AppModel {
	var $order = array('News.created'=>'desc');

	public $belongsTo = array(
		'User'
	);
	
	var $validate = array(
		'title' => array(
			'ruleName' => array(
				'rule' => array('notBlank'),
				'message' => 'Title is required'
			)
		)
	);
}
?>