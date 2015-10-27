<?php
App::uses('AppController', 'Controller');
class FoldersController extends AppController {
	public function board() {
		
	}
	
	public function resources() {
		
	}
	
	public function training() {
		
	}

	function admin_index() {
		$paginate = array(
			'conditions' => array(),
			'contain' => array(
			)
		);
		
		if(!empty($this->request->data['Folder']['search'])) {
			$paginate['conditions']['OR'] = array(
				'Folder.title LIKE' => '%'.$this->request->data['Folder']['search'].'%',
			);
		}
		
		$this->paginate = $paginate;
		$this->set('folders', $this->paginate());
	}
	
	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Folder->save($this->request->data)) {
				$this->Session->setFlash('The folder has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The folder could not be saved. Please, try again.','error');
			}
		}
	}
	
	public function admin_edit($id = null) {
		if (!$this->Folder->exists($id)) {
			throw new NotFoundException(__('Invalid folder'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Folder->save($this->request->data)) {
				$this->Session->setFlash('The folder has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The folder could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Folder.' . $this->Folder->primaryKey => $id));
			$this->request->data = $this->Folder->find('first', $options);
		}
	}
	
	public function admin_delete($id = null) {
		$this->Folder->id = $id;
		if (!$this->Folder->exists()) {
			throw new NotFoundException(__('Invalid folder'));
		}
		if ($this->Folder->delete()) {
			$this->Session->setFlash('Folder deleted','success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Folder was not deleted','error');
		$this->redirect(array('action' => 'index'));
	}
}
?>