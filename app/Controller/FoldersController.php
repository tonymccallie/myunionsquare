<?php
App::uses('AppController', 'Controller');
class FoldersController extends AppController {
	
	public function beforeRender() {
		parent::beforeRender();
		$categories = array(
			1 => 'Resources',
			2 => 'Board',
		);
		$this->set('categories',$categories);
	}
	
	public function view($id = null) {
		$folder = $this->Folder->findById($id);
		if(!$folder) {
			$this->Session->setFlash('No folder with that id found','error');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('title_for_layout',$folder['Folder']['title']);
		
		$conditions = array(
			'File.folder_id' => $id
		);
		
		if(!empty($this->request->data['Folder']['search'])) {
			$conditions['OR'] = array(
				'File.title LIKE' => '%'.$this->request->data['Folder']['search'].'%',
				'File.descr LIKE' => '%'.$this->request->data['Folder']['search'].'%',
				'File.filename LIKE' => '%'.$this->request->data['Folder']['search'].'%',
			);
		}
		
		$paginate = array(
			'File'=>array(
				'limit' => 20,
				'conditions' => $conditions
			),
		);
		
		$this->paginate = $paginate;
		$files = $this->paginate('File');
		
		$this->Folder->recursive = 0;
		$folder = $this->Folder->findById($id);
		$this->set(compact('folder','files'));
	}
	
	public function board() {
		$conditions = array(
			'Folder.category_id' => 2
		);
		
		if(!empty($this->request->data['Folder']['search'])) {
			debug($this->request->data['Folder']['search']);
			$conditions['OR'] = array(
				'Folder.title LIKE' => '%'.$this->request->data['Folder']['search'].'%',
			);
		}
		
		$folders = $this->Folder->find('all',array(
			'conditions' => $conditions
		));
		
		$this->set(compact('folders'));
	}
	
	public function resources() {
		$conditions = array(
			'Folder.category_id' => 1
		);
		
		$folders = $this->Folder->find('all',array(
			'conditions' => $conditions
		));
		
		if(!empty($this->request->data['Folder']['search'])) {
			$available_folders = Set::extract('/Folder/id',$folders);
			$this->view = 'results';
			$conditions['OR'] = array(
				'Folder.title LIKE' => '%'.$this->request->data['Folder']['search'].'%',
			);
			$this->paginate = array(
				'File' => array(
					'conditions' => array(
						'File.folder_id' => $available_folders,
						'OR' => array(
							'File.title LIKE' => '%'.$this->request->data['Folder']['search'].'%',
							'File.descr LIKE' => '%'.$this->request->data['Folder']['search'].'%',
							'File.filename LIKE' => '%'.$this->request->data['Folder']['search'].'%',
						)
					),
					'order' => array(
						'Folder.title' => 'asc'
					)
				)
			);
			
			$files = $this->paginate('File');
			$this->set(compact('files'));
		}
		
		$this->set(compact('folders'));
	}
	
	public function search() {
		
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
				'Folder.descr LIKE' => '%'.$this->request->data['Folder']['search'].'%',
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
	
	public function admin_view($id = null) {
		if (!$this->Folder->exists($id)) {
			throw new NotFoundException(__('Invalid folder'));
		}
		
		$conditions = array(
			'File.folder_id' => $id
		);
		
		if(!empty($this->request->data['Folder']['search'])) {
			$conditions['OR'] = array(
				'File.title LIKE' => '%'.$this->request->data['Folder']['search'].'%',
				'File.descr LIKE' => '%'.$this->request->data['Folder']['search'].'%',
				'File.filename LIKE' => '%'.$this->request->data['Folder']['search'].'%',
			);
		}
		
		$paginate = array(
			'File'=>array(
				'limit' => 20,
				'conditions' => $conditions
			),
		);
		
		$this->paginate = $paginate;
		$files = $this->paginate('File');
		
		$this->Folder->recursive = 0;
		$folder = $this->Folder->findById($id);
		$this->set(compact('folder','files'));
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