<?php 
class ToDosController  extends AppController {

	public $scaffold;
	
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

		$this->set('idToDo',$list_id);


		$this->set('title_for_layout', 'Liste d\'item');

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

	public function create() {                
			//verifie si l'utilisteur a entre qqchose
			if($this->request->is('post')){

                $list = $this->request->data;
				
				$this->ToDo->create($this->request->data, TRUE);
				
				// Test de la fréquence
				if($list['ToDo']['frequency'] == '') {
					$list['ToDo']['frequency'] = 0;
				}
				else if($list['ToDo']['frequency'] == '0') {
					$list['ToDo']['frequency'] = 1;
				}
				else if($list['ToDo']['frequency'] == '1') {
					$list['ToDo']['frequency'] = 7;
				}
					else if($list['ToDo']['frequency'] == '2') {
					$list['ToDo']['frequency'] = 30;
				}
 
                if($this->ToDo->save(array(
                                'name' => $list['ToDo']['name'],
                                'frequency'    => $list['ToDo']['frequency'],
                                'expirationDate'      => $list['ToDo']['expirationDate']
                          ))){

                        $this->Auth->login();        
                        return $this->redirect('/');
                }                
			}
		}
}