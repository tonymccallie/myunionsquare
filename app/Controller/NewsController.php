<?php
App::uses('AppController', 'Controller');
class NewsController extends AppController {
	public $components = array(
		'Paginator',
/*
        'Comments.Comments' => array(
            'userModelClass' => 'User' // Customize the User class
        ),
*/
    );

	function like($article,$user) {
		Configure::write('debug', 2);
		$this->layout = "ajax";
		$this->view = "ajax";
		$this->News->like($article,$user);
		$count = $this->News->Like->find('count',array(
			'conditions' => array(
				'Like.model' => 'News',
				'Like.foreign_id' => $article
			)
		));
		echo $count;
	}
	
	function dislike($article,$user) {
		Configure::write('debug', 2);
		$this->layout = "ajax";
		$this->view = "ajax";
		$this->News->dislike($article,$user);
		$count = $this->News->Like->find('count',array(
			'conditions' => array(
				'Like.model' => 'News',
				'Like.foreign_id' => $article
			)
		));
		echo $count;
	}
	
	function marketing() {
		$this->set('title_for_layout','Marketing');
		$paginate = array(
			'conditions' => array(
				'News.category_id' => 2
			),
			'contain' => array(
				'User','Like'
			)
		);
		
		
		$user_id = Authsome::get('User.id');
		$this->paginate = $paginate;
		$articles = $this->paginate();
		
		foreach($articles as $k=>$v) {
			$articles[$k]['News']['liked'] = $this->News->isLikedBy($v['News']['id'],$user_id);
		}
		
		$this->set(compact('articles'));
	}
	
	function classifieds() {
		$this->set('title_for_layout','Classifieds');
		$paginate = array(
			'conditions' => array(
				'News.category_id' => 3,
				'News.created >' => date('Y-m-d',strtotime('-30 days'))
			),
			'contain' => array(
				'User','Like'
			)
		);
		
		
		$user_id = Authsome::get('User.id');
		$this->paginate = $paginate;
		$articles = $this->paginate();
		
		foreach($articles as $k=>$v) {
			$articles[$k]['News']['liked'] = $this->News->isLikedBy($v['News']['id'],$user_id);
		}
		
		$this->set(compact('articles'));
	}
	
	function view($id = null) {
		$news = $this->News->find('first', array(
			'conditions'=> array(
				'News.id' => $id
			),
			'contain' => array(
				'Like','User',
				'Comment' => array(
					'User'
				)
			)
		));
		if(!$news) {
			$this->Session->setFlash('There was no article with taht','success');
			$this->redirect('/classifieds');
		}
		
		$user_id = Authsome::get('User.id');
		$news['News']['liked'] = $this->News->isLikedBy($news['News']['id'],$user_id);
		
		$this->set(compact('news'));
	}
	
	public function add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['News']['user_id'] = Authsome::get('id');
			$this->request->data['News']['body'] = Common::filter($this->request->data['News']['body']);
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash('The post has been saved','success');
				$this->redirect('/classifieds');
			} else {
				$this->Session->setFlash('The post could not be saved. Please, try again.','error');
			}
		}
	}
	
	function admin_index() {
		$paginate = array(
			'conditions' => array(
				'News.category_id' => 1
			),
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
	
	function admin_marketing() {
		$paginate = array(
			'conditions' => array(
				'News.category_id' => 2
			),
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
				$filename = 'news_'.date('Y.m.d_His').'_'.$this->request->data['News']['image']['name'];
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
	
	public function admin_marketing_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['News']['user_id'] = Authsome::get('id');
			if(!$this->request->data['News']['image']['error'] == 4) {
				$targetPath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/';
				$filename = 'news_'.date('Y.m.d_His').'_'.$this->request->data['News']['image']['name'];
				move_uploaded_file($this->request->data['News']['image']['tmp_name'], $targetPath.$filename);
				$this->request->data['News']['photo'] = $filename;
			}
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash('The post has been saved','success');
				$this->redirect(array('action' => 'marketing'));
			} else {
				$this->Session->setFlash('The post could not be saved. Please, try again.','error');
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
				$filename = 'news_'.date('Y.m.d_His').'_'.$this->request->data['News']['image']['name'];
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
	
	public function admin_marketing_edit($id = null) {
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if(!$this->request->data['News']['image']['error'] == 4) {
				$targetPath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/';
				$filename = 'news_'.date('Y.m.d_His').'_'.$this->request->data['News']['image']['name'];
				move_uploaded_file($this->request->data['News']['image']['tmp_name'], $targetPath.$filename);
				$this->request->data['News']['photo'] = $filename;
			}
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash('The post has been saved','success');
				$this->redirect(array('action' => 'marketing'));
			} else {
				$this->Session->setFlash('The post could not be saved. Please, try again.','error');
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
	
	public function admin_marketing_delete($id = null) {
		$this->News->id = $id;
		if (!$this->News->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
		$news = $this->News->find('first', $options);
		if((!empty($news['News']['photo']))&&(file_exists($_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$news['News']['photo']))) {
			unlink($_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$news['News']['photo']);
		}
		if ($this->News->delete()) {
			$this->Session->setFlash('Post deleted','success');
			$this->redirect(array('action' => 'marketing'));
		}
		$this->Session->setFlash('Post was not deleted','error');
		$this->redirect(array('action' => 'marketing'));
	}
}
?>