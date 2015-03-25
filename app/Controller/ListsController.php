<?php 
class ListsController  extends AppController {
	public $scaffold;

	public $uses = 'Liste';

	public $components = array('RequestHandler');

	public function index() {
		$lists = $this->Liste->find('all');

		$listView = array();

		foreach ($lists as $key => $value) {
			$listView[$key] = array(
				'id' => $value['Liste']['id'],
				'name' => $value['Liste']['name'],
				'created' => $value['Liste']['created']
				);
		}

		$this->set(array('lists' => $listView));
	}

	public function listAjax() {
		$this->layout = 'ajax';

		$lists = $this->Liste->find('all');

		$listView = array();

		foreach ($lists as $key => $value) {
			$listView[$key] = array(
				'id' => $value['Liste']['id'],
				'name' => $value['Liste']['name'],
				'created' => $value['Liste']['created']
				);
		}

		$this->set(array('lists' => $lists));
	}

	public function tasks($list_id = null) {
		if($list_id == null)
			$this->redirect('/Lists');

		$list = $this->Liste->find('first', array('conditions' => array('Liste.id' => $list_id)));
		if($list == array()){
			$this->Session->setFlash('Liste inconnu');
			$this->redirect('/lists');
		}

		$this->loadModel('Task');
		//$this->Task->find('all', array('conditions' => array('id' => $value['id'])));

		$listView = $list['Liste'];
		$tasks = $list['Task'];

		$this->loadModel('Checked');
		foreach ($list['Task'] as $key => $value) {
			/*$checked = $this->Checked->find('all',
				array(
					'conditions' => array(
						'task_id' => $value['id']
						)
					)
				);*/
			debug($this->Task->find('all', array('conditions' => array('id' => $value['id']))));
			//$tasks[$key] = $checked;
		}
		debug($tasks);


		$this->set(array(
			'list' => $listView,
			'tasks' => $tasks
			));
	}



}