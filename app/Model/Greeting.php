<?php
App::uses('AppModel', 'Model');
class Greeting extends AppModel {
	var $order = array('Greeting.title'=>'asc');
	
	public function get() {
		return $this->Greeting->find('first',array('order'=>'rand()'));
	}
}
?>