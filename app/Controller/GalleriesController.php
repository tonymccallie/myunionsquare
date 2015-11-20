<?php
App::uses('AppController', 'Controller');
class GalleriesController extends AppController {
	public function index() {
		$paginate = array(
			'conditions' => array(),
			'limit' => 9,
			'contain' => array(
				'Picture' => array(
					'limit' => 1,
				),
				
			)
		);
		
		if(!empty($this->request->data['Gallery']['search'])) {
			$paginate['conditions']['OR'] = array(
				'Gallery.title LIKE' => '%'.$this->request->data['Gallery']['search'].'%',
				'Gallery.descr LIKE' => '%'.$this->request->data['Gallery']['search'].'%',
			);
		}
		
		$this->paginate = $paginate;
		$this->set('galleries', $this->paginate());
	}
	
	public function view($id = null) {
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		
		$files = $this->Gallery->Picture->find('all',array(
			'conditions' => array(
				'Picture.gallery_id' => $id
			)
		));
		
		$this->Gallery->recursive = 0;
		$gallery = $this->Gallery->findById($id);
		$this->set(compact('gallery','files'));
	}
	
	
	public function admin_index() {
		$paginate = array(
			'conditions' => array(),
			'contain' => array(
			)
		);
		
		if(!empty($this->request->data['Gallery']['search'])) {
			$paginate['conditions']['OR'] = array(
				'Gallery.title LIKE' => '%'.$this->request->data['Gallery']['search'].'%',
				'Gallery.descr LIKE' => '%'.$this->request->data['Gallery']['search'].'%',
			);
		}
		
		$this->paginate = $paginate;
		$this->set('galleries', $this->paginate());
	}
	
	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Gallery->save($this->request->data)) {
				$this->Session->setFlash('The gallery has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The gallery could not be saved. Please, try again.','error');
			}
		}
	}
	
	public function admin_edit($id = null) {
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Gallery->save($this->request->data)) {
				$this->Session->setFlash('The gallery has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The gallery could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
			$this->request->data = $this->Gallery->find('first', $options);
		}
	}
	
	public function admin_view($id = null) {
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		
		$conditions = array(
			'Picture.gallery_id' => $id
		);
		
		if(!empty($this->request->data['Gallery']['search'])) {
			$conditions['OR'] = array(
				'Picture.title LIKE' => '%'.$this->request->data['Gallery']['search'].'%',
				'Picture.descr LIKE' => '%'.$this->request->data['Gallery']['search'].'%',
				'Picture.filename LIKE' => '%'.$this->request->data['Gallery']['search'].'%',
			);
		}
		
		$paginate = array(
			'Picture'=>array(
				'limit' => 20,
				'conditions' => $conditions
			),
		);
		
		$this->paginate = $paginate;
		$files = $this->paginate('Picture');
		
		$this->Gallery->recursive = 0;
		$gallery = $this->Gallery->findById($id);
		$this->set(compact('gallery','files'));
	}
	
	public function admin_delete($id = null) {
		$this->Gallery->id = $id;
		if (!$this->Gallery->exists()) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		$gallery = $this->Gallery->findById($id);
		foreach($gallery['Picture'] as $picture) {
			$this->__delete_picture($picture['id']);
		}
		if ($this->Gallery->delete()) {
			$this->Session->setFlash('Gallery deleted','success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Gallery was not deleted','error');
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_delete_picture($id = null) {
		$gallery = $this->__delete_picture($id);
		if($gallery) {
			$this->Session->setFlash('Picture deleted','success');
			$this->redirect(array('action' => 'view',$gallery));
		} else {
			$this->Session->setFlash('Picture was not deleted','error');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	private function __delete_picture($id = null) {
		$this->Gallery->Picture->id = $id;
		if (!$this->Gallery->Picture->exists()) {
			throw new NotFoundException(__('Invalid picture'));
		}
		
		$options = array('conditions' => array('Picture.id' => $id));
		$picture = $this->Gallery->Picture->find('first', $options);
		if((!empty($picture['Picture']['filename']))&&(file_exists($_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$picture['Picture']['filename']))) {
			unlink($_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$picture['Picture']['filename']);
		}
		
		if ($this->Gallery->Picture->delete()) {
			return $picture['Picture']['gallery_id'];
		} else {
			return false;
		}
		
	}
	
}
?>