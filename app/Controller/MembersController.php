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
			array('conditions' => array( 'Friend.user_id' => $id)));
		//debug($friend);
		$this->loadModel("User");
		if(!empty($friend)){
			foreach ($friend as $key => $value) {
				//debug($key);
				$friend_id = $value['Friend']['friend_id'];
				//debug($value['Friend']['friend_id']);
				$members = $this->Member->find('first', array('conditions' => array('user_id' => $friend_id)));
				debug($members['Member']['user_id']);

				if(empty($members)){
					$friend = $this->User->find('first',
					array('conditions' => array('User.id' => $friend_id)));
					//debug($friend['User']['username']);
					$tableau[$friend_id] = $friend['User']['username'];
				}
			}
			debug($tableau);
			$this->set(array ('tableau' => $tableau));
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

			if($this->Member->save(array(
                            'user_id'     => $member_id,
                            'to_do_id' => $to_do_id,
                            'right_id'      => '0'
                      ))){
    
                    $this->Session->setFlash('membre ajouté', 'flash_info');
                    $this->redirect('/Todos/tasks/'.$to_do_id);
                }else{
                	$this->Session->setFlash('membre non ajouté', 'flash_error');
                }

				if($this->Member->save(array(
								'user_id'     => $member_id,
								'to_do_id' => $to_do_id,
								'right_id'      => '0'
						  ))){
		
						$this->Session->setFlash('Membre ajouté', 'flash_info');
						$this->redirect('/Todos/tasks/'.$to_do_id);
					}else{
						$this->Session->setFlash('Membre non ajouté', 'flash_error');
						$this->redirect('/Todos/tasks/'.$to_do_id);
					}

			//$this->redirect('/Todos/tasks/'.$to_do_id);
			} else {
				//L'utilisateur qu'on veut ajouter n'existe pas en BD. Redirection + Msg Erreur
					$this->Session->setFlash('Utilisateur inexistant', 'flash_danger');
					$this->redirect('/Todos/tasks/'.$to_do_id);
			}
		}
	}
}