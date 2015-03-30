<?php 
class UsersController extends AppController {
	
	public function profil($id = null)
	{
		//il faudra le mettre autre part
		//$id = $this->Auth->user('id');

		if($id == null)
			$this->redirect('/');
		else
			$id = $this->User->find(
				'all',
				array(
					'fields' => array(
						'username',
						'email',
						'age'
						),
					'conditions' => array(
							'id' => $id
						)
					)
				);
			$avertissement = "Vous avez été déconnecté";
	
			$this->set('test',$id);	
	
		
	}

 

}
