<?php
App::uses('AppController', 'Controller');
class ImagesController extends AppController {
	var $helpers = array('Cache');
	function thumb($url = "") {
		Configure::write('debug', 1);
		$this->layout = "image";
	}
}
?>