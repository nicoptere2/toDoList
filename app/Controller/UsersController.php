<?php 
class UsersController extends AppController {
	
	public function profil()
	{
		
		//$id = $this->Auth->user('id');
		$id = $this->User->find('all',array(
		'fields'=>array('username','email','age')));
		$avertissement = "Vous avez été déconnecté";
	
			$this->set('test',$id);	
	
		
	}

 

}
