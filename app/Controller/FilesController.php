<?php
App::uses('AppController', 'Controller');
class FilesController extends AppController {
	
	function download($id, $category = 3) {
		$file = $this->File->findById($id);
		if(!$file) {
			$this->Session->setFlash('No file with that id found','error');
			$this->redirect(array('controller'=>'folders','action' => 'view',$category));
		}
		$file['File']['downloads']++;
		$this->File->save($file);
		Configure::write('debug', 0);
		$this->layout = "ajax";
		$this->set(compact('file'));
	}
	
	function view($id, $category = 3) {
		$file = $this->File->findById($id);
		if(!$file) {
			$this->Session->setFlash('No file with that id found','error');
			$this->redirect(array('controller'=>'folder','action' => 'view',$category));
		}
		$this->set(compact('file'));
	}
	
	public function admin_upload($id = null) {
		if (!$this->File->Folder->exists($id)) {
			throw new NotFoundException(__('Invalid folder'));
		}
		$boolSave = false;
		if($this->request->is('post') || $this->request->is('put')) {
			if(!$this->request->data['File']['file']['error'] == 4) {
				$targetPath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$id.'/';
				if(is_dir($targetPath) || mkdir($targetPath)) {
					$fileparts = pathinfo($this->request->data['File']['file']['name']);
					$filename = Common::slug($fileparts['filename'],false).date('_m-d-Y_His.').$fileparts['extension'];
					move_uploaded_file($this->request->data['File']['file']['tmp_name'], $targetPath.$filename);
					$this->request->data['File']['filename'] = $filename;
					$this->request->data['File']['size'] = $this->request->data['File']['file']['size'];
					$this->request->data['File']['mime'] = $this->request->data['File']['file']['type'];
					$boolSave = true;
				}
			} else {
				$this->Session->setFlash('There was a problem uploading the file. Make sure you selected a file.','error');
			}
			
			if($boolSave) {
				if($this->File->save($this->request->data)) {
					$this->Session->setFlash('The file has been saved','success');
					$this->redirect(array('controller'=>'folders','action' => 'view',$this->request->data['File']['folder_id']));
				} else {
					$this->Session->setFlash('The file could not be saved. Please, try again.','error');
				}
			}
		}
		
		$folder = $this->File->Folder->findById($id);
		$this->set(compact('folder'));
	}
	
	public function admin_edit($id = null) {
		if (!$this->File->exists($id)) {
			throw new NotFoundException(__('Invalid file'));
		}
		
		if($this->request->is('post') || $this->request->is('put')) {
			if(!$this->request->data['File']['file']['error'] == 4) {
				$filepath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$this->request->data['File']['folder_id'].'/'.$this->request->data['File']['filename'];
				if(file_exists($filepath)) {
					unlink($filepath);
				}
				$targetPath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$this->request->data['File']['folder_id'].'/';
				$fileparts = pathinfo($this->request->data['File']['file']['name']);
				$filename = Common::slug($fileparts['filename'],false).date('_m-d-Y_His.').$fileparts['extension'];
				move_uploaded_file($this->request->data['File']['file']['tmp_name'], $targetPath.$filename);
				$this->request->data['File']['filename'] = $filename;
				$this->request->data['File']['size'] = $this->request->data['File']['file']['size'];
				$this->request->data['File']['mime'] = $this->request->data['File']['file']['type'];
				$boolSave = true;
			}
			
			if($this->File->save($this->request->data)) {
				$this->Session->setFlash('The file has been saved','success');
				$this->redirect(array('controller'=>'folders','action' => 'view',$this->request->data['File']['folder_id']));
			} else {
				$this->Session->setFlash('The file could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('File.' . $this->File->primaryKey => $id));
			$this->request->data = $this->File->find('first', $options);
		}
		
		$folders = $this->File->Folder->find('list');
		$this->set(compact('folders'));
	}
	
	public function admin_delete($id = null) {
		$file = $this->File->findById($id);
		if(!$file) {
			$this->Session->setFlash('No file with that id found','success');
			$this->redirect('/');
		}
		$this->File->id = $id;
		if ($this->File->delete()) {
			$filepath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$file['File']['folder_id'].'/'.$file['File']['filename'];
			if(file_exists($filepath)) {
				unlink($filepath);
			}
			$this->Session->setFlash('File deleted','success');
			$this->redirect(array('controller'=>'folders','action' => 'view',$file['File']['folder_id']));
		}
		$this->Session->setFlash('File was not deleted','error');
		$this->redirect(array('controller'=>'folders','action' => 'view',$file['File']['folder_id']));
	}
}
?>