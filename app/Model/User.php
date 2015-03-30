<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
	
	public $avatarUploadDir = 'img/avatars';
	
	public $hasMany = array(
        'SocialProfile' => array(
            'className' => 'SocialProfile',
        )
    );
    
	public $hasOne = 'Friend';
        
    public $validate = array(
        'username' => array(
			'rule'  => 'notEmpty',
			'message' => 'Entrer un pseudo !'
		),
		'password' => array(
			'rule' => 'notEmpty',
			'message' => 'Entrer un mot de passe !'
		),
		'email'    => array(
			'rule' => 'email',
			'message' => 'Entrer un email !'
		),
		'age'      => array(
			'rule' => 'notEmpty',
			'message' => 'Entrer votre date de naissance !'
		)
	);
	
	public function createFromSocialProfile($incomingProfile){
		// On regarde si l'email n'est pas déja utilisé
		$existingUser = $this->find('first', array(
			'conditions' => array('email' => $incomingProfile['SocialProfile']['email'])));
		
		if($existingUser){
			return $existingUser;
		}
		
		// Nouvel Utilisateur
		$socialUser['User']['email'] = $incomingProfile['SocialProfile']['email'];
		$socialUser['User']['username'] = str_replace(' ', '_',$incomingProfile['SocialProfile']['display_name']);
		$socialUser['User']['password'] = date('Y-m-d h:i:s'); // necessaire même si inutile
		$socialUser['User']['created'] = date('Y-m-d h:i:s');
		$socialUser['User']['modified'] = date('Y-m-d h:i:s');
		
		// Sauvegarde de l'ID du réseau social
		$this->save($socialUser);
		$socialUser['User']['id'] = $this->id;
		
		return $socialUser;
	}
}

?>