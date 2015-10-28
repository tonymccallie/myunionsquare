<?php
App::uses('AppController', 'Controller');
class NewsController extends AppController {
	function like($article,$user) {
		$this->News->like($article,$user);
	}
	
	function admin_index() {
		$paginate = array(
			'conditions' => array(),
			'contain' => array(
				'User','Like'
			)
		);
		
		if(!empty($this->request->data['News']['search'])) {
			$paginate['conditions']['OR'] = array(
				'News.title LIKE' => '%'.$this->request->data['News']['search'].'%',
				'News.body LIKE' => '%'.$this->request->data['News']['search'].'%',
			);
		}
		
		$this->paginate = $paginate;
		$articles = $this->paginate();
		$this->set(compact('articles'));
	}
	
	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['News']['user_id'] = Authsome::get('id');
			if(!$this->request->data['News']['image']['error'] == 4) {
				$targetPath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/';
				$filename = date('Y.m.d_His').'_news_'.$this->request->data['News']['image']['name'];
				move_uploaded_file($this->request->data['News']['image']['tmp_name'], $targetPath.$filename);
				$this->request->data['News']['photo'] = $filename;
			}
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash('The announcement has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The announcement could not be saved. Please, try again.','error');
			}
		}
	}
	
	public function admin_edit($id = null) {
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid announcement'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if(!$this->request->data['News']['image']['error'] == 4) {
				$targetPath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/';
				$filename = date('Y.m.d_His').'_news_'.$this->request->data['News']['image']['name'];
				move_uploaded_file($this->request->data['News']['image']['tmp_name'], $targetPath.$filename);
				$this->request->data['News']['photo'] = $filename;
			}
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash('The announcement has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The announcement could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
			$this->request->data = $this->News->find('first', $options);
		}
	}
	
	public function admin_delete($id = null) {
		$this->News->id = $id;
		if (!$this->News->exists()) {
			throw new NotFoundException(__('Invalid announcement'));
		}
		$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
		$news = $this->News->find('first', $options);
		if((!empty($news['News']['photo']))&&(file_exists($_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot'.$news['News']['photo']))) {
			unlink($_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot'.$news['News']['photo']);
		}
		if ($this->News->delete()) {
			$this->Session->setFlash('Announcement deleted','success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Announcement was not deleted','error');
		$this->redirect(array('action' => 'index'));
	}
}
?>