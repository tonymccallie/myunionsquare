<?php
App::uses('AppController', 'Controller');
class GreetingsController extends AppController {
	function admin_index() {
		$paginate = array(
			'conditions' => array(),
			'contain' => array(
			)
		);
		
		if(!empty($this->request->data['Greeting']['search'])) {
			$paginate['conditions']['OR'] = array(
				'Greeting.title LIKE' => '%'.$this->request->data['Greeting']['search'].'%',
			);
		}
		
		$this->paginate = $paginate;
		$this->set('greetings', $this->paginate());
	}
	
	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Greeting->save($this->request->data)) {
				$this->Session->setFlash('The greeting has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The greeting could not be saved. Please, try again.','error');
			}
		}
	}
	
	public function admin_edit($id = null) {
		if (!$this->Greeting->exists($id)) {
			throw new NotFoundException(__('Invalid greeting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Greeting->save($this->request->data)) {
				$this->Session->setFlash('The greeting has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The greeting could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Greeting.' . $this->Greeting->primaryKey => $id));
			$this->request->data = $this->Greeting->find('first', $options);
		}
	}
	
	public function admin_delete($id = null) {
		$this->Greeting->id = $id;
		if (!$this->Greeting->exists()) {
			throw new NotFoundException(__('Invalid greeting'));
		}
		if ($this->Greeting->delete()) {
			$this->Session->setFlash('Greeting deleted','success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Greeting was not deleted','error');
		$this->redirect(array('action' => 'index'));
	}
}
?>