<?php
App::uses('AppModel', 'Model');
class Department extends AppModel {
	var $order = array('title');

	public $hasMany = array(
		'User'
	);
}
?>