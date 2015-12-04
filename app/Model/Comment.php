<?php
App::uses('AppModel', 'Model');
class Comment extends AppModel {
	var $order = array('Comment.created' => 'desc');

	public $belongsTo = array(
		'User',
		'News' => array(
			'className' => 'News',
			'counterCache' => true,
			'foreignKey' => 'parent_id',
			'conditions' => array(
				'Comment.model' => 'News'
			)
		),
	);
}
?>