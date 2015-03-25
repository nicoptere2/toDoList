<?php 
class ToDosController  extends AppController {
	public $scaffold;

	//public $uses = 'ToDo';

	public $components = array('RequestHandler');

	public function index() {
		$toDos = $this->ToDo->find('all');

		$listView = array();

		foreach ($toDos as $key => $value) {
			$listView[$key] = array(
				'id' => $value['ToDo']['id'],
				'name' => $value['ToDo']['name'],
				'created' => $value['ToDo']['created']
				);
		}

		$this->set(array('toDos' => $listView));
	}

	public function listAjax() {
		$this->layout = 'ajax';

		$toDos = $this->ToDo->find('all');

		$listView = array();

		foreach ($toDos as $key => $value) {
			$listView[$key] = array(
				'id' => $value['ToDo']['id'],
				'name' => $value['ToDo']['name'],
				'created' => $value['ToDo']['created']
				);
		}

		$this->set(array('toDos' => $toDos));
	}

	public function tasks($list_id = null) {
		if($list_id == null)
			$this->redirect('/toDos');

		$list = $this->ToDo->find('first', array('conditions' => array('ToDo.id' => $list_id)));
		if($list == array()){
			$this->Session->setFlash('ToDo inconnu');
			$this->redirect('/toDos');
		}

		$this->loadModel('Task');
		//$this->Task->find('all', array('conditions' => array('id' => $value['id'])));

		$listView = $list['ToDo'];
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
			debug($this->Task->find('all', array('conditions' => array('Task.id' => $value['id']))));
			//$tasks[$key] = $checked;
		}
		debug($tasks);


		$this->set(array(
			'list' => $listView,
			'tasks' => $tasks
			));
	}



}