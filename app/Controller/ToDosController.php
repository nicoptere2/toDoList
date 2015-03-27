<?php 
class ToDosController  extends AppController {
	public $scaffold;

	//public $uses = 'ToDo';

//	public $components = array('RequestHandler');

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

		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/ToDos/index_ajax');
		}
	}

	public function tasks($list_id = null) {
		if($list_id == null)
			$this->redirect('/toDos');

		$list = $this->ToDo->find(
			'first',
			array(
				'conditions' => array(
					'ToDo.id' => $list_id
					)
				)
			);

		if($list == array()){
			$this->Session->setFlash('ToDo inconnu');
			$this->redirect('/toDos');
		}



		$listView = $list['ToDo'];
		$tasks = $list['Task'];

		$this->loadModel('Task');
		foreach ($list['Task'] as $key => $value) {
			$tasks[$key] = $this->Task->find(
				'first',
				 array(
				 	'conditions' => array(
				 		'Task.id' => $value['id']
				 		),
				 	'recursive' => 2
				 	)
				 );

			$totalQte = $tasks[$key]['Task']['quantity'];
			//debug($totalQte);

			$qte = 0;
			foreach($tasks[$key]['Checked'] as $cKey => $cValue)
				$qte += $cValue['quantity'];

			//debug($qte);

			$tasks[$key]['Task']['qteCompleted'] = (int) $qte;

			$tasks[$key]['Task']['completed'] = $qte == $totalQte;

			unset($tasks[$key]['ToDo']);

		}
		//debug($tasks);


		$this->set(array(
			'list' => $listView,
			'tasks' => $tasks
			));

		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/ToDos/tasks_ajax');
		}
	}



}