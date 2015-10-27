<?php
App::uses('AppModel', 'Model');
class Accolade extends AppModel {
	var $order = array('Accolade.created'=>'desc');
	var $actsAs = array('Like.Likeable');
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
	);
}
?>