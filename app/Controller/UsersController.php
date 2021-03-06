<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {
	public $uses = array('User','News','Accolade');

	function login() {
		$this->layout = 'blank';
		//Authsome::logout();
		if(empty($this->request->data)) {
			return;
		}
		$user = Authsome::login($this->request->data['User']);

		if (!$user) {
			$this->Session->setFlash('Unable to login with that information. Did you verify the account?','alert');
			$this->redirect(array('action'=>'login'));
			return;
		}
		
		Authsome::persist('1 month');
		
		if(!empty($user['User']['refer_url'])) {
			$this->request->data['User']['url'] = $user['User']['refer_url'];
			$user['User']['refer_url'] = "";
			unset($user['User']['passwd']);
			$this->User->save($user);
			$this->Session->write('User',$this->User->update($this->Session->read('User')));
		}
		$this->Session->delete('dashboard_url');
		if((empty($this->request->data['User']['url']))||($this->request->data['User']['url']=='/users/logout')) {
			$this->request->data['User']['url'] = "/dashboard/";
		}
		

		return $this->redirect($this->request->data['User']['url']);

	}
	
	function logout() {
		Authsome::logout();
		return $this->redirect('/');
	}
	
	function recover($key = null) {
		$this->layout = 'blank';
		if(!empty($key)) {
			if(!empty($this->request->data)) {
				if($this->User->save($this->request->data)) {
					$this->Session->setFlash('Password successfully changed.', 'success');
					$this->redirect(array('action'=>'login'));
				} else {
					$this->Session->setFlash('There was an error changing the password.', 'error');
				}
			}
			$keyArray = explode('-',$key);
			$this->request->data = $this->User->findById($keyArray[0]);
			$this->request->data['User']['passwd'] = '';
			$this->view = 'password';
		} else {
			if(!empty($this->request->data)) {
				
				$user = $this->User->findByEmail($this->request->data['User']['email']);
				if(!$user) {
					$this->Session->setFlash('We were unable to find an account with that email address.', 'alert');
					return true;
				}
				$url = Common::currentUrl().'users/recover/'.$user['User']['id'].'-'.substr($user['User']['passwd'],0,6);
				
				Common::email(array(
					'to' => $this->request->data['User']['email'],
					'subject' => 'Password Reset Instructions',
					'template' => 'recover',
					'variables' => array(
						'url' => $url
					)
				),'');

				$this->Session->setFlash('An email has been sent to '.$this->request->data['User']['email'].' with a link to reset your password.', 'success');
				$this->redirect(array('controller'=>'users','action'=>'login'));
			}
		}
	}
	
	function password() {
		if(!empty($this->request->data)) {
			if($this->User->save($this->request->data)) {
				$this->Session->setFlash('Password successfully changed.', 'success');
				$this->redirect(array('action'=>'dashboard'));
			} else {
				$this->Session->setFlash('There was an error changing the password.', 'error');
			}
		} else {
			$this->request->data = $this->User->findById(Authsome::get('id'));
			$this->request->data['User']['passwd'] = '';
		}
	}
	
	function register($regkey = '') {
		if(!empty($regkey)) {
			$arRegkey = explode('-',$regkey);
			
			$user = $this->User->find('first',array(
				'conditions' => array(
					'User.id' => $arRegkey[0],
					'SUBSTR(User.passwd,1,6)' => $arRegkey[1],
					'User.verified' => null
				)
			));

			if(!$user) {
				$this->Session->setFlash('That user could not be located or has already been verified.','alert');
			} else {
				$this->User->updateAll(
					array(
						'verified' => "'".date('Y-m-d H:i')."'"
					),
					array(
						'User.id' => $user['User']['id']
					)
				);
				$this->Session->setFlash('Thank you for confirming your email. You may now login!', 'success');
				$this->redirect(array('controller'=>'users','action'=>'login'));
			}
		} else {
			if (!empty($this->request->data)) {
				$this->User->create();

				$this->User->validate['passwd'] = array(
					'ruleTitle' => array(
						'rule' => array('notEmpty'),
						'message' => 'A Password is required.'
					)
				);
				
				//Get User Role
				$this->request->data['User']['role_id'] = $this->User->Role->lookup(array(
					'name'=>'User',
					'permissions' => '*:*,!*:admin_*',
				));
								
				if ($this->User->save($this->request->data)) {
					$this->request->data['User']['passwd'] = Authsome::hash($this->request->data['User']['passwd']);
					$url = Common::currentUrl().'users/register/'.$this->User->getLastInsertId().'-'.substr($this->request->data['User']['passwd'],0,6);
					Common::email(array(
						'to' => $this->request->data['User']['email'],
						'subject' => 'New User Registration',
						'template' => 'register',
						'variables' => array(
							'url' => $url
						)
					),'');
					$this->Session->setFlash('Thank you for registering. An email has been sent to '.$this->request->data['User']['email'].'. Please click on the link in the email to verify your account.','success');
					$this->redirect(array('action'=>'login'));
				} else {
					$this->Session->setFlash('There was a problem creating the account, see below.','error');
				}
			}
		}
	}
	
	
	function dashboard() {
		$paginate = array(
			'News' => array(
				'limit' => 5,
				'conditions' => array(
					'News.category_id' => 1
				),
				'contain' => array(
					'User','Like'
				)
			)
		);
		
		$birthdays = $this->User->find('all', array(
			'conditions' => array(
				'User.birthday NOT' => null,
				'WEEKOFYEAR(User.birthday) = WEEKOFYEAR(CURDATE())',
			),
			'contain' => array()
		));
		
		$hires = $this->User->find('all', array(
			'conditions' => array(
				'User.hire_date NOT' => null,
				'WEEKOFYEAR(User.hire_date) = WEEKOFYEAR(CURDATE())',
			),
			'contain' => array()
		));
		
		$user_id = Authsome::get('User.id');
		
		$this->paginate = $paginate;
		$articles = $this->paginate('News');
		
		foreach($articles as $k=>$v) {
			$articles[$k]['News']['liked'] = $this->News->isLikedBy($v['News']['id'],$user_id);
		}
		
		$accolades = $this->User->Accolade->find('all',array(
			'limit' => 10,
			'contain' => array(
				'User','Like'
			)
		));
		foreach($accolades as $k=>$v) {
			$accolades[$k]['Accolade']['liked'] = $this->Accolade->isLikedBy($v['Accolade']['id'],$user_id);
		}

		$this->set(compact('articles','birthdays','hires','accolades'));
	}
	
	public function directory() {
		$paginate = array(
			'conditions' => array(
				'User.email NOT' => 'guest@greyback.net',
				'User.active' => true
			),
		);
		
		if(!empty($this->request->data['User']['search'])) {
			$paginate['conditions']['OR'] = array(
				'User.first_name LIKE' => '%'.$this->request->data['User']['search'].'%',
				'User.last_name LIKE' => '%'.$this->request->data['User']['search'].'%',
				'User.email LIKE' => '%'.$this->request->data['User']['search'].'%',
				'User.phone LIKE' => '%'.$this->request->data['User']['search'].'%',
				'User.position LIKE' => '%'.$this->request->data['User']['search'].'%',
			);
		}
		
		if(!empty($this->request->data['User']['department'])) {
			$paginate['conditions']['User.department_id'] = $this->request->data['User']['department'];
		}
		
		$this->paginate = $paginate;
		$users = $this->paginate();
		$departments = $this->User->Department->find('list');
		$this->set(compact('users','departments'));
	}
	
	public function admin_index() {
		$paginate = array(
			'conditions' => array(
				'User.email NOT' => 'guest@greyback.net'
			),
			'contain' => array(
				'Role'
			)
		);
		
		if(!empty($this->request->data['User']['search'])) {
			$paginate['conditions']['OR'] = array(
				'User.first_name LIKE' => '%'.$this->request->data['User']['search'].'%',
				'User.last_name LIKE' => '%'.$this->request->data['User']['search'].'%',
				'User.email LIKE' => '%'.$this->request->data['User']['search'].'%',
				'User.phone LIKE' => '%'.$this->request->data['User']['search'].'%',
				'User.position LIKE' => '%'.$this->request->data['User']['search'].'%',
			);
		}
		
		$this->paginate = $paginate;
		$this->set('users', $this->paginate());
	}

	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if(!$this->request->data['User']['image']['error'] == 4) {
				$targetPath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/';
				$filename = 'user_'.date('Y.m.d_His').'_'.$this->request->data['User']['image']['name'];
				move_uploaded_file($this->request->data['User']['image']['tmp_name'], $targetPath.$filename);
				$this->request->data['User']['photo'] = $filename;
			}
			$this->request->data['User']['verified'] = date('Y-m-d H:i:s');
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('The user has been create','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be created. Please, try again.','error');
			}
		}
		$roles =  $this->User->Role->find('list');
		$departments = $this->User->Department->find('list');
		$this->set(compact('roles','departments'));
	}

	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if(empty($this->request->data['User']['passwd'])) {
				unset($this->request->data['User']['passwd']);
			}
			if(!$this->request->data['User']['image']['error'] == 4) {
				$targetPath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/';
				$filename = 'user_'.date('Y.m.d_His').'_'.$this->request->data['User']['image']['name'];
				move_uploaded_file($this->request->data['User']['image']['tmp_name'], $targetPath.$filename);
				$this->request->data['User']['photo'] = $filename;
			}
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('The user has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
			$this->request->data['User']['passwd'] = '';
			$this->request->data['User']['passwd_verify'] = '';
		}
		
		$roles =  $this->User->Role->find('list');
		$departments = $this->User->Department->find('list');
		$this->set(compact('roles','departments'));
	}


	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);
		if((!empty($user['User']['photo']))&&(file_exists($_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$user['User']['photo']))) {
			unlink($_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$user['User']['photo']);
		}
		if ($this->User->delete()) {
			$this->Session->setFlash('User deleted','success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('User was not deleted','error');
		$this->redirect(array('action' => 'index'));
	}
}
?>