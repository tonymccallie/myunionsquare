<?php
App::uses('AppModel', 'Model');
class File extends AppModel {
	public $belongsTo = array(
		'Folder'
	);

	
}
?>