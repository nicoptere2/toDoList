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
			}

	}

}