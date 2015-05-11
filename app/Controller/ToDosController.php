<?php 
class ToDosController  extends AppController {

	public $scaffold;
	
	public function index() {

		$this->loadModel('Member');
		$toDos = $this->Member->find(
			'all',
			array(
				'conditions' => array(
					'user_id' => AuthComponent::user('id')
					)
				)
			);

		$listView = array();
		foreach ($toDos as $key => $value) {
			$listView[$key] = array(
				'id' => $value['ToDo']['id'],
				'name' => $value['ToDo']['name'],
				'expirationDate' => $value['ToDo']['expirationDate']
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


		$this->loadModel('Member');
		if(null == 
				$this->Member->find(
					'all',
					array(
						'conditions' => array(
							'user_id' => AuthComponent::user('id'),
							'to_do_id' => $list_id,
							)
						)
					)
				) {
				$this->Session->setFlash('cette list ne vous appartient pas', 'flash_danger');
				$this->redirect('/');
			}


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
			if(!is_numeric($key))
				continue;


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
			

			$qte = 0;
			foreach($tasks[$key]['Checked'] as $cKey => $cValue)
				$qte += $cValue['quantity'];

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
   // Verifie que l'utilisateur a bien entre des donnees
   if($this->request->is('post')){

                $list = $this->request->data;
    
    $this->ToDo->create($this->request->data, TRUE);
    
    // Test de la frequence
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

                  $this->loadModel('Member');

                  $result = $this->ToDo->find( 'all', 
                          array( 'conditions' => array( 'name' => $list['ToDo']['name'])));
                  
                  foreach($result as $id)
                  {
                   $this->Member->create($this->request->data, TRUE);
                   
                   if($this->Member->save(array(
                     'user_id' => AuthComponent::user('id'),
                     'to_do_id'    => $id['ToDo']['id'],
                     'right_id'      => 2
                   ))){

                   }
                   
                  }
                  
                        $this->Auth->login();        
                        return $this->redirect('/');
                } 				

                
   }
  }
		
		public function edit($id = null) {
		// Si l'id de la liste est nul, on retouner à l'accueil
		if($id == null) {
			$this->redirect('/toDos');
		}
		
		// On vérifie que l'utilisateur a bien les droits de modifier la liste
		$this->loadModel('Member');
		if(null == $this->Member->find('all',
					array('conditions' => array(
							'user_id' => AuthComponent::user('id'),
							'to_do_id' => $id,
							)
						)
					)
				) {
				$this->Session->setFlash('Cette liste ne vous appartient pas', 'flash_danger');
				$this->redirect('/toDos');
		}
		
		if($this->request->is('put')){
			if(isset($this->data) && $id !=null){
				if ($this->ToDo->save($this->request->data)) {
					$this->Session->setFlash('La liste a bien été modifiée', 'flash_info');
					$this->redirect('/toDos');
				}
			else
				$this->Session->setFlash('La date est incorrecte', 'flash_danger');
			}
		}
		
		// On récupère les informations de a liste et on les place
		// Dans data pour pouvoir pré-remplir les champs
		if($id != null) {
			$this->ToDo->id = $id;
			$this->data = $this->ToDo->read();
			}
		}
                
        public function delete_todos($to_do_id){
        
            $this->loadModel('Member');
             
            $todo = $this->ToDo->find('all', array('conditions' => array( 'ToDo.id' => $to_do_id)));
            $members_id = $this->Member->find('all',
                                                array('conditions' => array(
                                                    'to_do_id' => $to_do_id)));
            //supprime tout les membres associés a la liste
            foreach ($members_id as $id) {
                $this->Member->delete($id['Member']['id']);
            }
            
            $this->loadModel('Task');
            $task = $this->Task->find('all', array('conditions' => array(
                                                    'Task.to_do_id' => $to_do_id)));   
            $this->loadModel('Checked');
            // pour supprimer la selection
            foreach ($task as $id) {
                $checked_id = $this->Checked->find('first',
                    array('conditions' => array(
                        'task_id' => $id['Task']['id'])));
                if(!empty($checked_id))
                    $this->Checked->delete($checked_id['Checked']['id']);
            }
            // pour supprimer les élément de la todolist
            foreach ($task as $id) {
                $this->Task->delete($id['Task']['id']);
            }            
            //supprimer la todolist
            foreach ($todo as $id) {
                $this->ToDo->delete($id['ToDo']['id']);
            }
            $this->Session->setFlash('TodoListe supprimé', 'flash_info');
            $this->redirect('/');

        }
}