<?php
App::uses('AppController', 'Controller');
class CommentsController extends AppController {
	public function add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Comment']['body'] = Common::filter($this->request->data['Comment']['body']);
			if ($this->Comment->save($this->request->data)) {
				$message = array(
					'STATUS' => 'SUCCESS',
					'DATA' => $this->params->data
				);
			}
		}
		$this->redirect(array(
			'controller'=>$this->request->data['Comment']['controller'],
			'action'=>$this->request->data['Comment']['action'],
			$this->request->data['Comment']['parent_id']));
	}
}
?>