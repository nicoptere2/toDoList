<?php 
class FriendsController  extends AppController {
	public $scaffold;

	public function show_friends(){
		$id = AuthComponent::user('id');
    	//debug($id);

    	$friends = $this->Friend->find('all', 
			array('conditions' => array( 'Friend.user_id' => $id)));
		//debug($friends);


		$this->loadModel("User");

		foreach ($friends as $key => $value) {
			$friend_id = $value['Friend']['friend_id'];

			$friend = $this->User->find('first',
						array('conditions' => array('User.id' => $friend_id)));

			if(!empty($friend))
				$tableau[$friend_id] = $friend['User']['username'];
		}
		//debug($tableau);

		if(!empty($tableau)){
			$this->set(array ('tableau' => $tableau));
		}else{
			$this->set(array ('tableau' => ''));
		}

	}

	public function add_friends(){
		$id = AuthComponent::user('id');

		$this->loadModel("User");

		if($this->request->is('post')){
			$user = $this->User->find('first', array('conditions' => 
				array('User.username' => $this->request->data['Friend']['nom d\'utilisateur'])));

			debug($id);
			debug($user['User']);
			if($user['User']['id'] == $id){
				$this->Session->setFlash('Vous ne pouvez pas vous ajouter vous même', 'flash_danger');
						$this->redirect('/Friends/show_friends/');
			}

			//debug($user['User']['id']);
			if(empty($user)){
				$this->Session->setFlash('Cet utilisateur n\'existe pas', 'flash_danger');
				$this->redirect('/Friends/show_friends/');
			}else{
				
				$friendsList = $this->Friend->find('all', array('conditions' => array('user_id' => $id)));
				debug($friendsList);

				foreach ($friendsList as $key => $value) {
					debug($value['Friend']['friend_id']);
					if($user['User']['id'] == $value['Friend']['friend_id']){
						$this->Session->setFlash('Cet utilisateur appartient deja à votre cercle d\'amis', 'flash_danger');
						$this->redirect('/Friends/show_friends/');
					}
				}

				if($this->Friend->save(array(
	                            'user_id'     => $id,
	                            'friend_id' => $user['User']['id']
	                      ))){

					$this->Session->setFlash('ami ajouté', 'flash_info');
	                $this->redirect('/Friends/show_friends/');
	            }else{
	                $this->Session->setFlash('ami non ajouté', 'flash_danger');
	            }
	            
	                      	
			}
		}


	}

	public function del_friends(){
    	$id = AuthComponent::user('id');
    	//debug($id);
		$friends = $this->Friend->find('all', 
			array('conditions' => array('Friend.user_id' => $id)));
		//debug($friends);

		$this->loadModel("User");
		foreach ($friends as $key => $value) {
			$friend_id = $value['Friend']['friend_id'];

			$friend = $this->User->find('first',
						array('conditions' => array('User.id' => $friend_id)));

			if(!empty($friend))
				$tableau[$friend_id] = $friend['User']['username'];
		}
		//debug($tableau);

		if(!empty($tableau)){
				$this->set(array ('tableau' => $tableau));
			}
		/*
    	$myself = $this->Member->find('first', 
            array('conditions' => array( 'Member.user_id' => $id, 'Member.to_do_id' => $to_do_id)));
    	//debug($myself);
    	if(!empty($myself)){
    		$this->set(array ('myself' => $myself));
    	}
    	*/
    	/*
		if(!empty($friends)){
			$this->set(array ('friends' => $friends));
		}
		*/

		
		if($this->request->is('post')){
			$member = $this->User->find('first', array('conditions' => 
				array('User.username' => $this->request->data['Friend']['nom d\'utilisateur'])));
			//debug($this->request->data['Member']['pseudo']);
			//debug($member);
			//debug($to_do_id);
			if(!empty($member)){
			//debug($member_id);
				$friend_id = $member['User']['id'];
				//debug($friend_id);
				
				$delete = $this->Friend->find('first', array('conditions' =>
					array('user_id' => $id, 'friend_id' => $friend_id)));
				//debug($delete['Friend']);

				if($this->Friend->delete($delete['Friend']['id'])){
					$this->Session->setFlash('ami supprimé', 'flash_info');
                    $this->redirect('/Friends/show_friends/');
                }else{
                	$this->Session->setFlash('ami non supprimé', 'flash_danger');
                    $this->redirect('/Friends/show_friends/');
                }
                
				//$delete = $this->Member->find('first', array('conditions' => array('user_id' => $member_id, 'to_do_id' => $to_do_id)));
				//debug($delete);
				//$this->Member->deleteAll('first', array('conditions' => array('user_id' => $member_id, 'to_do_id' => $to_do_id)));
			}

		}
		
	}
	
}