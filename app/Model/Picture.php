<?php
App::uses('AppModel', 'Model');
class Picture extends AppModel {
	public $belongsTo = array(
		'Gallery' => array(
			'counterCache' => true
		)
	);
}
?>