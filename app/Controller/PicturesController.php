<?php
App::uses('AppController', 'Controller');
class PicturesController extends AppController {
	public function admin_upload($id = null) {
		if (!$this->Picture->Gallery->exists($id)) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		$boolSave = false;
		if($this->request->is('post') || $this->request->is('put')) {
			$data = array();
			foreach($this->request->data['Picture']['pictures'] as $k => $picture) {
				if(!$picture['error'] == 4) {
					$targetPath = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/';
					$fileparts = pathinfo($picture['name']);
					$filename = 'gallery_'.$id.'_'.Common::slug($fileparts['filename'],false).date('_m-d-Y_His.').$fileparts['extension'];
					move_uploaded_file($picture['tmp_name'], $targetPath.$filename);
					array_push($data, array(
						'Picture' => array(
							'gallery_id' => $id,
							'filename' => $filename,
							'size' => $picture['size'],
							'mime' => $picture['type']
						)
					));
					$boolSave = true;
				} else {
					$this->Session->setFlash('There was a problem uploading the file. Make sure you selected a file.','error');
				}
			}
			
			if($boolSave) {
				if($this->Picture->saveAll($data)) {
					$this->Session->setFlash('The file has been saved','success');
					$this->redirect(array('controller'=>'galleries','action' => 'view',$this->request->data['Picture']['gallery_id']));
				} else {
					$this->Session->setFlash('The file could not be saved. Please, try again.','error');
				}
			}
		}
		
		$gallery = $this->Picture->Gallery->findById($id);
		$this->set(compact('gallery'));
	}
}
?>