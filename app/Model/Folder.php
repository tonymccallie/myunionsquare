<?php
App::uses('AppModel', 'Model');
class Folder extends AppModel {
	var $order = array('Folder.title'=>'asc');
	public $hasMany = array(
		'File' => array(
			'className' => 'File',
			'foreignKey' => 'folder_id',
			'order' => '',
			'dependent' => true //true = delete child records on delete
		),
	);
	
}
?>