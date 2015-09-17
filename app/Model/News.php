<?php
App::uses('AppModel', 'Model');
class News extends AppModel {
	var $order = array('News.created DESC');

	public $belongsTo = array(
		'User'
	);
}
?>