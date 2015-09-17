<?php
App::uses('AppController', 'Controller');
class DepartmentsController extends AppController {
	function admin_index() {
		$paginate = array(
			'conditions' => array(),
			'contain' => array(
			)
		);
		
		if(!empty($this->request->data['Department']['search'])) {
			$paginate['conditions']['OR'] = array(
				'Department.title LIKE' => '%'.$this->request->data['Department']['search'].'%',
			);
		}
		
		$this->paginate = $paginate;
		$this->set('departments', $this->paginate());
	}
	
	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Department->save($this->request->data)) {
				$this->Session->setFlash('The department has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The department could not be saved. Please, try again.','error');
			}
		}
	}
	
	public function admin_edit($id = null) {
		if (!$this->Department->exists($id)) {
			throw new NotFoundException(__('Invalid department'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Department->save($this->request->data)) {
				$this->Session->setFlash('The department has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The department could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
			$this->request->data = $this->Department->find('first', $options);
		}
	}
}
?>