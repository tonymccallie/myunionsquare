<?php
App::uses('AppModel', 'Model');
class File extends AppModel {
	var $order = array('File.title'=>'asc');
	public $belongsTo = array(
		'Folder' => array(
			'counterCache' => true
		)
	);
	var $validate = array(
		'title' => array(
			'ruleName' => array(
				'rule' => array('notBlank'),
				'message' => 'A Title is required'
			)
		),
	);
}
?>