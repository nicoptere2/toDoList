<?php 
class MembersController  extends AppController {
	public $scaffold;


	public function modif_droit_ajax($idUtil, $idList, $idDroit, $status) {
		if(($idUtil == null) || ($idList == null) || ($idDroit == null)){
			$error = 'erreur1';
//			return false;
		}

		$member = $this->Member->find(
			'first',
			array(
				'conditions' => array(
					'user_id' => $idUtil,
					'to_do_id' => $idList
					)
				)
			);
		if($member == null || $member == array()){
			$error = 'erreur2';
//			return false;
		}

		$this->loadModel('Right');
		$droit = $this->Right->find(
			'first',
			array(
				'conditions' => array(
					'id' => $idDroit
					)
				)
			);
		if($droit == null || $droit == array()){
			$error = 'erreur3: droit = ' . $idDroit;
//			return false;
		}

		$owner = $this->Member->find(
			'first',
			array(
				'conditions' =>array(
					'right_id' => 2,
					'user_id' => AuthComponent::user('id'),
					'to_do_id' => $idList
					)
				)
			);

		if($owner == null || $owner == array()){
			$error = 'erreur4';
//			return false;
		}

		if($member['Member']['right_id'] == 5){
			if($idDroit == 4)
				$idDroit = 3;
			else
				$idDroit = 4;
		}
		else if($member['Member']['right_id'] == 3 && $idDroit == 4)
			$idDroit = 5;
		else if($member['Member']['right_id'] == 4 && $idDroit == 3)
			$idDroit = 5;
		else if($member['Member']['right_id'] == 4 && $idDroit == 4)
			$idDroit = 1;
		else if($member['Member']['right_id'] == 3 && $idDroit == 3)
			$idDroit = 1;

		if(!isset($error)){
			$ret = $this->Member->updateAll(
				array('right_id' => $idDroit),
				array(
					'user_id' => $idUtil,
					'to_do_id' => $idList
					)
				);
		}

		if(isset($error))
			$this->set($error);
		

		if($this->RequestHandler->isAjax())
			$this->layout = 'ajax';

	}


	public function show_members($to_do_id){
		$this->loadModel('Task');

		$users = $this->Member->find(
			'all',
			array(
				'conditions' => array(
					'to_do_id' => $to_do_id
					)
				)
			);

		$owner = $this->Member->find(
			'first',
			array(
				'conditions' => array(
					'user_id' => AuthComponent::user('id'),
					'to_do_id' => $to_do_id,
					'right_id' => 2
					)
				)
			);

		if($owner == null)
			$this->set(array('ownerShip' => false));
		else
			$this->set(array('ownerShip' => true));

		foreach($users as $key => $value){
			if($value['Right']['id'] == 3 || $value['Right']['id'] == 5)
				$users[$key]['Right']['item'] = true;
			else
				$users[$key]['Right']['item'] = false;

			if($value['Right']['id'] == 4 || $value['Right']['id'] == 5)
				$users[$key]['Right']['user'] = true;
			else
				$users[$key]['Right']['user'] = false;
		}

		$this->set(array('users' =>$users));

		$this->loadModel('ToDo');
    	$list = $this->ToDo->find(
			'first',
			array(
				'conditions' => array(
					'ToDo.id' => $to_do_id
					)
				)
			);
    	//debug($list['ToDo']);
    	if(!empty($list)){
    		$this->set(array ('list' => $list['ToDo']));
    	}

    	if($to_do_id != null)
    		$this->set(array ('idToDo' => $to_do_id));


    	$id = AuthComponent::user('id');
		$members = $this->Member->find('all', 
			array('conditions' => array( 'Member.to_do_id' => $to_do_id)));
		//debug($members);
    	$myself = $this->Member->find('first', 
            array('conditions' => array( 'Member.user_id' => $id, 'Member.to_do_id' => $to_do_id)));
    	//debug($myself);
	}

	public function add_member($to_do_id){
		//debug($to_do_id);
		//debug($this->Session->read('Auth.User'));
		$this->layout = "ajax";
		
		$id = $this->Session->read('Auth.User.id');
		//debug($id);
		$this->loadModel("Friend");
		$friend = $this->Friend->find('all', 
			array('conditions' => array('Friend.user_id' => $id)));
		//debug($friend);
		$this->loadModel("User");
		if(!empty($friend)){
			foreach ($friend as $key => $value) {
				//debug($key);
				$friend_id = $value['Friend']['friend_id'];
				//debug($value['Friend']['friend_id']);
				$members = $this->Member->find('first', array('conditions' => array('user_id' => $friend_id, 'to_do_id' => $to_do_id)));
				//debug($members);
				if(empty($members)){
					$friend = $this->User->find('first',
						array('conditions' => array('User.id' => $friend_id)));
					//debug($friend);
					if(!empty($friend))
						$tableau[$friend_id] = $friend['User']['username'];
				}
			}
			//debug($tableau);
			if(!empty($tableau)){
				$this->set(array ('tableau' => $tableau));
			}
			$this->set(array ('to_do_id' => $to_do_id));
		}else{
			$this->set(array ('tableau' => ''));
		}
		//debug($tableau);
		if($this->request->is('post')){ 
			$member = $this->User->find('first', array('conditions' => array('User.username' => $this->request->data['Member']['nom d\'utilisateur'])));
			$addItem = $this->request->data['Member']['item'];
			$addUser = $this->request->data['Member']['user'];
			$right = 1;
			if($addItem == 1){
				$right = 3;
			}
			if($addUser == 1){
				$right = 4;
			}
			if($addUser == 1 && $addItem == 1){
				$right = 5;
			}
			debug($addItem);
			//debug($member);
			if(!empty($member)){
				//debug($member_id);
				$member_id = $member['User']['id'];
				$friends = $this->Friend->find('all' , array('conditions' => array('Friend.user_id' => $id)));
				//debug($friends);
				$ok = false;
				foreach ($friends as $key => $value) {
					debug($value['Friend']['friend_id']);
					debug($member_id);
					if($member_id == $value['Friend']['friend_id'])
						$ok = true;
				}
				if($ok == false){
					debug($ok);
					$this->Session->setFlash('Cet utilisateur n\'est pas dans votre liste d\'amis', 'flash_danger');
					$this->redirect('/ToDos/tasks/'.$to_do_id);
				}
				//debug($member_id);
				$membersList = $this->Member->find('all', array('conditions' => array('to_do_id' => $to_do_id)));
				foreach ($membersList as $key => $value) {
					//debug($value['Member']['user_id']);
					if($member_id == $value['Member']['user_id']){
						//debug($value['Member']['user_id']);
						$this->Session->setFlash('Cet utilisateur appartient deja à la liste', 'flash_danger');
						$this->redirect('/ToDos/tasks/'.$to_do_id);
					}
				}
				//debug($membersList['']);
				if($this->Member->save(array(
	                            'user_id'     => $member_id,
	                            'to_do_id' => $to_do_id,
	                            'right_id'      => $right
	                      ))){
	    
	                    $this->Session->setFlash('membre ajouté', 'flash_info');
	                    $this->redirect('/ToDos/tasks/'.$to_do_id);
	                }else{
	                	$this->Session->setFlash('membre non ajouté', 'flash_danger');
	                }
					if($this->Member->save(array(
									'user_id'     => $member_id,
									'to_do_id' => $to_do_id,
									'right_id'      => '0'
							  ))){
			
							$this->Session->setFlash('Membre ajouté', 'flash_info');
							$this->redirect('/ToDos/tasks/'.$to_do_id);
						}else{
							$this->Session->setFlash('Membre non ajouté', 'flash_danger');
							$this->redirect('/ToDos/tasks/'.$to_do_id);
						}
				$this->redirect('/ToDos/tasks/'.$to_do_id);
			} else {
				//L'utilisateur qu'on veut ajouter n'existe pas en BD. Redirection + Msg Erreur
					$this->Session->setFlash('Utilisateur inexistant', 'flash_danger');
					$this->redirect('/ToDos/tasks/'.$to_do_id);
			}
		}
	}
	public function suppr_members($to_do_id){
    	$id = AuthComponent::user('id');
    	//debug($id);
		$members = $this->Member->find('all', 
			array('conditions' => array( 'Member.to_do_id' => $to_do_id)));
		//debug($members);
    	$myself = $this->Member->find('first', 
            array('conditions' => array( 'Member.user_id' => $id, 'Member.to_do_id' => $to_do_id)));
    	//debug($myself);
    	if(!empty($myself)){
    		$this->set(array ('myself' => $myself));
    	}
		if(!empty($members)){
			$this->set(array ('members' => $members));
		}
		$this->loadModel("User");
		if($this->request->is('post')){
			$member = $this->User->find('first', array('conditions' => array('User.username' => $this->request->data['Member']['pseudo'])));
			//debug($this->request->data['Member']['pseudo']);
			//debug($member);
			debug($to_do_id);
			if(!empty($member)){
			//debug($member_id);
				$member_id = $member['User']['id'];
				debug($member_id);
				$delete = $this->Member->find('first', array('conditions' => array('user_id' => $member_id, 'to_do_id' => $to_do_id)));
				debug($delete['Member']['id']);
				if($this->Member->delete($delete['Member']['id'])){
					$this->Session->setFlash('membre supprimé', 'flash_info');
                    $this->redirect('/ToDos/tasks/'.$to_do_id);
                }
				//$delete = $this->Member->find('first', array('conditions' => array('user_id' => $member_id, 'to_do_id' => $to_do_id)));
				//debug($delete);
				//$this->Member->deleteAll('first', array('conditions' => array('user_id' => $member_id, 'to_do_id' => $to_do_id)));
			}
		}
	}
}