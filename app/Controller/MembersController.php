<?php 
class MembersController  extends AppController {
	public $scaffold;
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
					echo "SERIEUX ";
					$friend = $this->User->find('first',
						array('conditions' => array('User.id' => $friend_id)));
					debug($friend);
					if(!empty($friend))

						$tableau[$friend_id] = $friend['User']['username'];
				}
			}
			//debug($tableau);
			if(!empty($tableau)){
				$this->set(array ('tableau' => $tableau));
			}
		}else{
			$this->set(array ('tableau' => ''));
		}
		//debug($tableau);
		if($this->request->is('post')){
			$member = $this->User->find('first', array('conditions' => array('User.username' => $this->request->data['Member']['pseudo'])));
			//debug($member);
			if(!(empty($member))){
			//debug($member_id);
			$member_id = $member['User']['id'];
			debug($member_id);
			$membersList = $this->Member->find('all', array('conditions' => array('to_do_id' => $to_do_id)));
			foreach ($membersList as $key => $value) {
				debug($value['Member']['user_id']);
				if($member_id == $value['Member']['user_id']){
					echo "DEJA ENTRER";
					$this->Session->setFlash('Cet utilisateur appartient deja à la liste', 'flash_danger');
					$this->redirect('/ToDos/tasks/'.$to_do_id);
				}
			}
			//debug($membersList['']);
			if($this->Member->save(array(
                            'user_id'     => $member_id,
                            'to_do_id' => $to_do_id,
                            'right_id'      => '3'
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
			//$this->redirect('/ToDos/tasks/'.$to_do_id);
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
		debug($members);
    	$myself = $this->Member->find('first', 
            array('conditions' => array( 'Member.user_id' => $id, 'Member.to_do_id' => $to_do_id)));
    	//debug($myself);
    	if(!empty($myself)){
    		$this->set(array ('myself' => $myself));
    	}
		if(!empty($members)){
				$this->set(array ('members' => $members));
			}
	}
}