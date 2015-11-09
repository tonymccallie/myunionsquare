<?php
App::uses('AppModel', 'Model');
class Gallery extends AppModel {
	public $hasMany = array(
		'Picture'
	);

	
}
?>