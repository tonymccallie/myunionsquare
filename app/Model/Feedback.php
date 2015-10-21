<?php
App::uses('AppModel', 'Model');
class Feedback extends AppModel {
	var $order = array('Feedback.created'=>'desc');
	
	
}
?>