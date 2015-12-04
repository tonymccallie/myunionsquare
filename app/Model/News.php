<?php
App::uses('AppModel', 'Model');
class News extends AppModel {
	var $order = array('News.created'=>'desc');
	var $actsAs = array('Like.Likeable');
	var $primaryKey = 'id';

	public $belongsTo = array(
		'User'
	);
	
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'parent_id',
			'order' => '',
			'conditions' => array(
				'Comment.model' => 'News'
			),
			'dependent' => true //true = delete child records on delete
		),
	);
	
	var $validate = array(
		'title' => array(
			'ruleName' => array(
				'rule' => array('notBlank'),
				'message' => 'Title is required'
			)
		)
	);
}
?>