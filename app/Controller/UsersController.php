<?php 
class UsersController extends AppController {

	public $components = array('Hybridauth');

	var $uses = array('User','SocialProfile');
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','inscription'); 
        $this->Auth->allow('login','inscription','social_login','social_endpoint'); 		
    }
    

 public function login(){
        $user = $this->request->data;
        //Cas ou l'on est déja connecté
        if($this->Session->check('Auth.User')){
                $this->redirect('/');	
        }
        else if(!empty ($user)){
            $souvenir = $user['User']['souvenir'];
            
            if ($souvenir == true) {
                    // temps d'expiration du cookie
                    $cookieTime = "2 months"; // on peut aussi mettre : 1 week, 17 weeks, 14 days

                // suppression du "se souvenir de moi"
                unset($this->request->data['User']['souvenir']);

                // on recupere le hashe du mdp
                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);

                // on ecrit le cookie
                $this->Cookie->write('souvenir', $this->request->data['User'], true, $cookieTime);
            }
            
            if ($this->Auth->login()) {
                $this->Session->setFlash('<strong>Bievenu(e) '.$this->Cookie->read('User.username').'</strong> Vous vous etes Identifié avec succes', 'flash_success');
                $this->redirect('/');
            }
            else {
                $this->Session->setFlash('<strong>Désolé</strong> utilisateur inexistant ou mot de passe incorrecte', 'flash_warning');
            //    $this->redirect('/');
            }
            
        }
    }
    
    public function logout(){  
        $this->Cookie->delete('souvenir');
        if($this->Auth->logout()){ 
            $this->Session->setFlash('<strong>Deconnecté(e)</strong> En espérant vous revoir', 'flash_success');
            return $this->redirect('/');
        }
    }
	
	public function delete(){  
		// On supprime si l'on a cliqué sur le bouton "oui"
		if($this->request->is('post')){		
		
			// On supprime les amis du membre et ceux qu'il l'on ajouté en ami
			$id = AuthComponent::user('id');
			$this->loadModel('Friend');            
			$this->Friend->deleteAll(array('user_id' => $id), false);
			$this->Friend->deleteAll(array('friend_id' => $id), false);
		
			// On supprime tout ce que l'utilisateur à coché
			$this->loadModel('Checked');            
			$lists_id = $this->Checked->find('all', array('conditions' => array('user_id' => AuthComponent::user('id'))));
			foreach ($lists_id as $id) {
				$this->Checked->delete($id['Checked']['id']);
			}
			
			$this->loadModel('Member');            
			$lists_id = $this->Member->find('all', array('conditions' => array('user_id' => AuthComponent::user('id'))));
			// On supprime les droits qu'il possède pour chaque liste
			foreach ($lists_id as $id) {
			$todoId = $id['Member']['to_do_id'];
			$rightId = $id['Member']['right_id'];
				$this->loadModel('Member');            
				$this->Member->delete($id['Member']['id']);
				
				// Si il est proprietaire de la liste on supprime les taches et la liste
				if($rightId == 2) {
				$this->loadModel('Task');
				$this->Task->deleteAll(array('to_do_id' => $todoId), false);

				$this->loadModel('ToDo');           
				$this->ToDo->delete($id['ToDo']['id']);
				}
			}
				
			// On supprime l'utilisateur
			$this->loadModel('User');            
			$id = AuthComponent::user('id');
			
			// Suppression du profil associé au réseau social si il existe
			$this->SocialProfile->deleteAll(array('user_id' => $id), false);
			
			if ($this->User->delete($id)) {
				// Deconnexion et redirection si tout s'est bien déroulé
				$this->Session->setFlash('Votre compté a été supprimé !', 'flash_success');
				$this ->logout();
				$this->redirect(array('action' => '/'));
			}
			else {
			  $this->Session->setFlash('Erreur lors de la suppression du compte', 'flash_error');
			}
		}   
    }
	
	public function profil($user)
	{
		$id = $this->User->find('all',array(
		'conditions' => array('username' => $user),
		'fields'=>array('username','email','age')
		));
		if (!$id) {
            throw new NotFoundException(__('Utilisateur inexistant'));
        }
		//$avertissement = "Vous avez été déconnecté";
		$this->set('info',$id);	
		
	}
	
	public function monprofil()
	{
		$id = $this->Auth->user('id');
		
		if($this->request->is('post')){
			
			//$userv = $this->User->findById($id);
			$userv = $this->User->find('all',array(
				'conditions' => array('User.username' => $this->request->data['User']['username']),
				'fields'=>array('username')
			));
			$this->User->id = $id;
			if(empty($userv)){
				if($this->User->save($this->request->data)) {
					$this->Session->setFlash("modifs sauvegardées !");
				}
			}
			else{
				$this->Session->setFlash("Pseudo déjà utilisé !");
			}
			$this->redirect('/users/monprofil');
		}

		
		$user = $this->User->find('all',array(
		'conditions' => array('User.id' => $id),
		'fields'=>array('username','email','age')
		));
		if (!$id) {
            throw new NotFoundException(__('Utilisateur inexistant'));
        }
		//$avertissement = "Vous avez été déconnecté";
		$this->set('info',$user);
		
		
	}
	
	public function monprofile()
	{
		$id = $this->Auth->user('id');
		
		if($this->request->is('post')){
			
			//$userv = $this->User->findById($id);
			$userv = $this->User->find('all',array(
				'conditions' => array('User.username' => $this->request->data['User']['username']),
				'fields'=>array('username')
			));
			$this->User->id = $id;
			if(empty($userv)){
				if($this->User->save($this->request->data)) {
					$this->Session->setFlash("modifs sauvegardées !");
				}
			}
			else{
				$this->Session->setFlash("Pseudo déjà utilisé !");
			}
			$this->redirect('/users/monprofil');
		}

		
		$user = $this->User->find('all',array(
		'conditions' => array('User.id' => $id),
		'fields'=>array('username','email','age')
		));
		if (!$id) {
            throw new NotFoundException(__('Utilisateur inexistant'));
        }
		//$avertissement = "Vous avez été déconnecté";
		$this->set('info',$user);
		
	}
	
	public function monprofilee()
	{
		//verifie si l'utilisateur a entre des donnees ( modification du profil )
		if($this->request->is('post')){
			$userm = $this->request->data;
			$userv = $this->User->find('all',array(
				'conditions' => array('User.username' => $userm),
				'fields'=>array('username','email','age')
			));
			//si le nouveau pseudo n'existe pas en bdd
			if(empty($userv)){/*
                    if($this->User->save(array('Users' => array(
                                'username' => $userm['username'],
                                'email'    => $userm['email'],
                                'age'      => $userm['age']   
								))))
					{       
                        return $this->redirect('/');
                    }  */    
            }
		}
		
		
		
		$id = $this->Auth->user('id');
		//$this->set('test',$id);	
		/*$busername = false;
		$bemail = false;
		$bage = false;*/
		
		$user = $this->User->find('all',array(
		'conditions' => array('User.id' => $id),
		'fields'=>array('username','email','age')
		));
		if (!$id) {
            throw new NotFoundException(__('Utilisateur inexistant'));
        }
		//$avertissement = "Vous avez été déconnecté";
		$this->set('info',$user);
		
		
	}
	

	/* Connexion via réseaux sociaux */
	public function social_login($provider) {
		if( $this->Hybridauth->connect($provider) ){
			$this->_successfulHybridauth($provider,$this->Hybridauth->user_profile);
        }else{
            // error
			$this->Session->setFlash($this->Hybridauth->error);
			$this->redirect($this->Auth->loginAction);
        }
	}

	public function social_endpoint($provider) {
		$this->Hybridauth->processEndpoint();
	}
	
	private function _successfulHybridauth($provider, $incomingProfile){
		// Regarde si l'utilisateur est connecté au réseau
		$this->SocialProfile->recursive = -1;
		$existingProfile = $this->SocialProfile->find('first', array(
			'conditions' => array('social_network_id' => $incomingProfile['SocialProfile']['social_network_id'], 'social_network_name' => $provider)
		));
		
		if ($existingProfile) {
			// Si l'utilisateur a déja un profil dans la base on le connecte directement
			$user = $this->User->find('first', array(
				'conditions' => array('User.id' => $existingProfile['SocialProfile']['user_id'])
			));
			
			$this->_doSocialLogin($user,true);
		} else {
			
			// Nouveau profil
			if ($this->Auth->loggedIn()) {
				$incomingProfile['SocialProfile']['user_id'] = $this->Auth->user('id');
				$this->SocialProfile->save($incomingProfile);
				
				$this->Session->setFlash('Your ' . $incomingProfile['SocialProfile']['social_network_name'] . ' account is now linked to your account.');
				$this->redirect($this->Auth->redirectUrl());

			} else {
				$user = $this->User->createFromSocialProfile($incomingProfile);
				$incomingProfile['SocialProfile']['user_id'] = $user['User']['id'];
				$this->SocialProfile->save($incomingProfile);

				// Connexion
				$this->_doSocialLogin($user);
			}
		}	
	}
	
	private function _doSocialLogin($user, $returning = false) {
		if ($this->Auth->login($user['User'])) {
			if($returning){
				$this->Session->setFlash(__('Bienvenue, '. $this->Auth->user('username')));
			} else {
				$this->Session->setFlash(__('Inscription effectuée, bienvenue, '. $this->Auth->user('username')));
			}
			$this->redirect('/'); 	
		
		} else {
			$this->Session->setFlash(__('Erreur lors de la connexion '. $this->Auth->user('username'), 'flash_error'));
			$this->redirect('/users/login');
		}
	}

    public function inscription(){ 
         //Cas ou l'on est déja connecté
        if($this->Session->check('Auth.User')){
                $this->redirect('/');	
        }
        $d = array(
            'username' => "",
            'password' => "",
            're_password' =>"",
            'email' => "",
            'age' => "");
        $this->set('d',$d);

        //verifie si l'utilisteur a entre qqchose
        if($this->request->is('post')){           
            
            //  verifie si l'utilisteur existe dans la base
            $user = $this->User->findByUsername($this->request->data['User']['username']);
            if(empty($user)){       //si il existe pas on l'enregistre 

                $user = $this->request->data;

                $pass = $user['User']['password'];
                $rePass = $user['User']['re_password'];
                
                if( !preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,35}$/',$this->request->data['User']['password']) ){
                    $this->Session->setFlash('Le mot de passe doit contenir au moins 6 caractéres, avec au minimum une majuscule, une minuscule et 1 chiffre!', 'flash_danger');
                    $d = array(
                        'username' => $user['User']['username'],
                        /*'password' => '',
                        're_password' =>'',*/
                        'email' => $user['User']['email'],
                        'age' => $user['User']['age']);
                   $this->set('d',$d);
                   //$this->redirect('/Users/inscription');
                }
                else{
                    $age = $user['User']['age'];
                    
                    if($pass==$rePass){
                        
                        //  verifie si l'email existe dans la base
                        $email = $this->User->findByEmail($this->request->data['User']['email']);
                        if(!empty($email)){       //si il existe on l'enregistre pas
                            $this->Session->setFlash('email existant', 'flash_danger');
                            $d = array(
                            'username' => $user['User']['username'],
                            'password' => $this->Auth->password($pass),
                            're_password' =>$this->Auth->password($pass),
                            'email' => $user['User']['email'],
                            'age' => $user['User']['age']);
                            $this->set('d',$d); 
                        }                            
                        //verification de l'âge
                        else if($age<5 || $age>150){
                            $this->Session->setFlash('Entrer votre âge', 'flash_danger');
                            $d = array(
                            'username' => $user['User']['username'],
                            'password' => $this->Auth->password($pass),
                            're_password' =>$this->Auth->password($pass),
                            'email' => $user['User']['email'],
                            'age' => '');
                            $this->set('d',$d);                                       
            
                        }
                        else{
                            $this->User->create($this->request->data, TRUE);
                            if($this->User->save(array(
                                        'username' => $user['User']['username'],
                                        'password' => $this->Auth->password($pass),
                                        'email'    => $user['User']['email'],
                                        'age'      => $user['User']['age']
                                  ))){

                                $this->Auth->login();        
                                return $this->redirect('/');
                            }  
                        }

                    }
                    else{
                        $this->Session->setFlash('le second mot de passe ne correspond pas au premier', 'flash_danger');
                        $d = array(
                            'username' => $user['User']['username'],
                            /*'password' => '',
                            're_password' =>'',*/
                            'email' => $user['User']['email'],
                            'age' => $user['User']['age']);
                        $this->set('d',$d);
                    //    $this->redirect('/Users/inscription');
                    }
                }
              }
              else {
                $this->Session->setFlash('Utilisateur existant', 'flash_info');
                $this->redirect('/Users/inscription');
              }
            }
    }
    
}
