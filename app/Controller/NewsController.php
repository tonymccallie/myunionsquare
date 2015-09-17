<?php
App::uses('AppController', 'Controller');
class NewsController extends AppController {
	function admin_index() {
		$paginate = array(
			'conditions' => array(),
			'contain' => array(
				'User'
			)
		);
		
		if(!empty($this->request->data['News']['search'])) {
			$paginate['conditions']['OR'] = array(
				'News.title LIKE' => '%'.$this->request->data['News']['search'].'%',
				'News.body LIKE' => '%'.$this->request->data['News']['body'].'%',
			);
		}
		
		$this->paginate = $paginate;
		$this->set('articles', $this->paginate());
	}
	
	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			die(debug($this->request));
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash('The announcement has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The announcement could not be saved. Please, try again.','error');
			}
		}
	}
}
?>