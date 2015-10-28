<?php
App::uses('AppModel', 'Model');
class File extends AppModel {
	var $order = array('File.title'=>'asc');
	public $belongsTo = array(
		'Folder' => array(
			'counterCache' => true
		)
	);
	
}
?>