<?php

class UsersController extends AppController {

	var $uses = array('User','SocialProfile');

	public $components = array('Hybridauth');
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','inscription','social_login','social_endpoint'); 
		
    }

	public function login() {
		//Cas ou l'on est déja connecté
		if($this->Session->check('Auth.User')){
			$this->redirect('/');	
		}
		
		//Authentification
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$status = $this->Auth->user('status');
				if($status != 0){
					$this->Session->setFlash(__('Bienvenue, '. $this->Auth->user('username')));
					$this->redirect('/');
				}else{
					$this->Auth->logout();
					$this->Session->setFlash(__('Utilisateur supprime'));
				}
			} else {
				$this->Session->setFlash(__('Nom d\'utilisateur ou mot de pase incorrect'));
			}
		} 
	}

	public function logout() {
		if($this->Auth->logout()){
			$this->Session->setFlash('<strong>Deconnecté</strong> En espérant vous revoir', 'flash_success');
			return $this->redirect('/');
		}
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
				'conditions' => array('id' => $existingProfile['SocialProfile']['user_id'])
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
				$this->Session->setFlash(__('Inscription via facebook effectuée, bienvenue, '. $this->Auth->user('username')));
			}
			$this->redirect('/'); 	
		
		} else {
			$this->Session->setFlash(__('Erreur lors de la connexion '. $this->Auth->user('username')));
		}
	}

	public function inscription(){ 
        $this->Auth->allow('inscription');
                
        //verifie si l'utilisteur a entre qqchose
        if($this->request->is('post')){

            //  verifie si l'utilisteur existe dans la base
            $user = $this->User->findByUsername($this->request->data['User']['username']);
            if(empty($user)){       //si il existe pas on l'enregistre 

                $user = $this->request->data;

                $pass = $user['User']['password'];
                $rePass = $user['User']['re_password'];
                
                if($pass==$rePass){
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
                else{
                    $this->Session->setFlash('le second mot de passe ne correspond pas au premier', 'flash_info');
                    $this->redirect('/Users/inscription');
                }
              }
              else {
                $this->Session->setFlash('Utilisateur existant', 'flash_info');
                $this->redirect('/Users/inscription');
              }
            }
    }
}

?>