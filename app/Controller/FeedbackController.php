<?php
App::uses('AppController', 'Controller');
class FeedbackController extends AppController {
	public function add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Feedback']['body'] = Common::filter($this->request->data['Feedback']['body']);
			if ($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash('The feedback has been saved','success');
				$this->redirect('/dashboard');
			} else {
				$this->Session->setFlash('The feedback could not be saved. Please, try again.','error');
			}
		}
	}
	
	function admin_index() {
		$paginate = array(
			'conditions' => array(),
			'contain' => array(
			)
		);
		
		if(!empty($this->request->data['Feedback']['search'])) {
			$paginate['conditions']['OR'] = array(
				'Feedback.title LIKE' => '%'.$this->request->data['Feedback']['search'].'%',
			);
		}
		
		$this->paginate = $paginate;
		$this->set('feedbacks', $this->paginate());
	}
	
	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash('The feedback has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The feedback could not be saved. Please, try again.','error');
			}
		}
	}
	
	public function admin_edit($id = null) {
		if (!$this->Feedback->exists($id)) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash('The feedback has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The feedback could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Feedback.' . $this->Feedback->primaryKey => $id));
			$this->request->data = $this->Feedback->find('first', $options);
		}
	}
	
	public function admin_delete($id = null) {
		$this->Feedback->id = $id;
		if (!$this->Feedback->exists()) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		if ($this->Feedback->delete()) {
			$this->Session->setFlash('Feedback deleted','success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Feedback was not deleted','error');
		$this->redirect(array('action' => 'index'));
	}
}
?>