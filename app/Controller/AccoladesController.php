<?php
App::uses('AppController', 'Controller');
class AccoladesController extends AppController {
	public function add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Accolade']['body'] = Common::filter($this->request->data['Accolade']['body']);
			if ($this->Accolade->save($this->request->data)) {
				$this->Session->setFlash('The high five has been added','success');
				$this->redirect('/dashboard');
			} else {
				$this->Session->setFlash('The high five could not be saved. Please, try again.','error');
			}
		}
	}
	
	function admin_index() {
		$paginate = array(
			'conditions' => array(),
			'contain' => array(
				'User'
			)
		);
		
		if(!empty($this->request->data['Accolade']['search'])) {
			$paginate['conditions']['OR'] = array(
				'Accolade.body LIKE' => '%'.$this->request->data['Accolade']['search'].'%',
			);
		}
		
		$this->paginate = $paginate;
		$this->set('accolades', $this->paginate());
	}
	
	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Accolade->save($this->request->data)) {
				$this->Session->setFlash('The high five has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The high five could not be saved. Please, try again.','error');
			}
		}
	}
	
	public function admin_edit($id = null) {
		if (!$this->Accolade->exists($id)) {
			throw new NotFoundException(__('Invalid accolade'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Accolade->save($this->request->data)) {
				$this->Session->setFlash('The high five has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The high five could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Accolade.' . $this->Accolade->primaryKey => $id));
			$this->request->data = $this->Accolade->find('first', $options);
		}
	}
	
	public function admin_delete($id = null) {
		$this->Accolade->id = $id;
		if (!$this->Accolade->exists()) {
			throw new NotFoundException(__('Invalid high five'));
		}
		if ($this->Accolade->delete()) {
			$this->Session->setFlash('High five deleted','success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('High five was not deleted','error');
		$this->redirect(array('action' => 'index'));
	}
}
?>