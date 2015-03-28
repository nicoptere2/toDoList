<?php 
class UsersController  extends AppController {
	public $scaffold;
	
	public function profil()
	{
		
		$id = $this->User->find('all',array(
		'fields'=>array('username','email','age')
		));
		$avertissement = "Vous avez été déconnecté";
			$this->set('test',$id);	
		
	}

}
