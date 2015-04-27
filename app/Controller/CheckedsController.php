<?php 
class CheckedsController  extends AppController {
	public $scaffold;

	public function remove($userId = null, $taskId = null) {

		$delete = true;

		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
		}

		if($userId == null || $taskId == null){
			$this->set(array('error' => 'Erreur inconnu'));
			$delete = false;
		}

		$check = $this->Checked->find(
			'first',
			array(
				'conditions' => array(
					'user_id' => $userId,
					'task_id' => $taskId
					)
				)
			);

		if(empty($check)){
			$this->set(array('error' => 'Vous n\'avez pas le droit de décocher une element coché par quelqu\'un d\'autre'));
			$delete = false;
		}

		if(!isset($check['Checked'])){
			$this->set(array('error' => 'Vous n\'avez pas le droit de décocher une element coché par quelqu\'un d\'autre'));
			$delete = false;

		}

		if($delete)
			$this->Checked->delete($check['Checked']['id']);

		//debug($check);

		$this->loadModel('Task');
		$todo_id = $this->Task->find(
			'first',
			array(
				'conditions' => array('Task.id' => $taskId),
				'fields' => array('to_do_id')
				)
			);

		//debug($todo_id);

		$this->loadModel('ToDo');
		$list = $this->ToDo->find(
			'first',
			array(
				'conditions' => array(
					'ToDo.id' => $todo_id['Task']['to_do_id']
					)
				)
			);
		if($list == array()){
			$this->Session->setFlash('ToDo inconnu');
			$this->redirect('/toDos');
		}
		$listView = $list['ToDo'];
		$tasks = $list['Task'];
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
			if($totalQte > 1)
				$tasks[$key]['Task']['quantitatif'] = true;
			else
				$tasks[$key]['Task']['quantitatif'] = false;
			//debug($totalQte);
			$qte = 0;
			foreach($tasks[$key]['Checked'] as $cKey => $cValue)
				$qte += $cValue['quantity'];
			//debug($qte);
			$tasks[$key]['Task']['qteCompleted'] = (int) $qte;
			$tasks[$key]['Task']['completed'] = $qte == $totalQte;
			$tasks[$key]['Task']['empty'] = false;
			$tasks[$key]['Task']['half'] = false;

			if(!$tasks[$key]['Task']['completed'] && $qte > 0) {
				$tasks[$key]['Task']['empty'] = false;
				$tasks[$key]['Task']['half'] = true;
			} elseif(!$tasks[$key]['Task']['completed']){
				$tasks[$key]['Task']['empty'] = true;
				$tasks[$key]['Task']['half'] = false;
			}

			unset($tasks[$key]['ToDo']);
		}
		//debug($tasks);
		$this->set(array(
			'list' => $listView,
			'tasks' => $tasks
			));
		
		$this->render('/Checkeds/remove_ajax');

	}


	public function add($userId = null, $taskId = null, $qte = null){
		$add = true;

		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
		}

		if($userId == null || $taskId == null || $qte == null){
			$this->set(array('error' => 'Erreur inconnu'));
			$add = false;
		}

		$check = $this->Checked->find(
			'first',
			array(
				'conditions' => array(
					'user_id' => $userId,
					'task_id' => $taskId
					)
				)
			);

		if(!empty($check)){
			$this->set(array('error' => 'Vous n\'avez pas le droit de décocher une element coché par quelqu\'un d\'autre'));
			$add = false;
		}

		if(isset($check['Checked'])){
			$this->set(array('error' => 'Vous n\'avez pas le droit de décocher une element coché par quelqu\'un d\'autre'));
			$add = false;

		}

		$this->loadModel('Task');
		$task = $this->Task->find(
			'first',
			array(
				'conditions' => array('Task.id' => $taskId),
				)
			);


		$qteChecked = 0;
		foreach ($task['Checked'] as $key => $value) {
			$qteChecked += $value['quantity'];
		}

		
		if($task['Task']['quantity'] - $qteChecked - $qte  < 0){
			$this->set(array('error' => 'il y a plus de place pour ton gros cul!'));
			$add = false;
		}

		if($add){
			$this->Checked->create();
			$this->Checked->save(array(
				'user_id' => $userId,
				'task_id' => $taskId,
				'quantity'=> $qte
				)
			);
		}


		$this->loadModel('ToDo');
		$list = $this->ToDo->find(
			'first',
			array(
				'conditions' => array(
					'ToDo.id' => $task['Task']['to_do_id']
					)
				)
			);
		if($list == array()){
			$this->Session->setFlash('ToDo inconnu');
			$this->redirect('/toDos');
		}
		$listView = $list['ToDo'];
		$tasks = $list['Task'];
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

			if($totalQte > 1)
				$tasks[$key]['Task']['quantitatif'] = true;
			else
				$tasks[$key]['Task']['quantitatif'] = false;

			//debug($totalQte);
			$qte = 0;
			foreach($tasks[$key]['Checked'] as $cKey => $cValue)
				$qte += $cValue['quantity'];
			//debug($qte);
			$tasks[$key]['Task']['qteCompleted'] = (int) $qte;
			$tasks[$key]['Task']['completed'] = $qte == $totalQte;
			$tasks[$key]['Task']['empty'] = false;
			$tasks[$key]['Task']['half'] = false;

			if(!$tasks[$key]['Task']['completed'] && $qte > 0) {
				$tasks[$key]['Task']['empty'] = false;
				$tasks[$key]['Task']['half'] = true;
			} elseif(!$tasks[$key]['Task']['completed']){
				$tasks[$key]['Task']['empty'] = true;
				$tasks[$key]['Task']['half'] = false;
			}

			unset($tasks[$key]['ToDo']);
		}
		//debug($tasks);
		$this->set(array(
			'list' => $listView,
			'tasks' => $tasks
			));
		
		$this->render('/Checkeds/remove_ajax');


	}

}
