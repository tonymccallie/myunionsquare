<?php
App::uses('AppModel', 'Model');
class Folder extends AppModel {
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