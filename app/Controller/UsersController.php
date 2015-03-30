<?php

class UsersController extends AppController {

	var $uses = array('User','SocialProfile');
	
	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('User.username' => 'asc' ) 
    );
	public $components = array('Hybridauth');
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','inscription','social_login','social_endpoint'); 
		
    }

	public function login() {
		
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('action' => 'index'));		
		}
		
		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {

			if ($this->Auth->login()) {
			
				$status = $this->Auth->user('status');
				if($status != 0){
					$this->Session->setFlash(__('Bienvenue, '. $this->Auth->user('username')));
					$this->redirect($this->Auth->redirectUrl());
				}else{
					// this is a deleted user
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
	
	
	
	/* social login functionality */
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

		// #1 - check if user already authenticated using this provider before
		$this->SocialProfile->recursive = -1;
		$existingProfile = $this->SocialProfile->find('first', array(
			'conditions' => array('social_network_id' => $incomingProfile['SocialProfile']['social_network_id'], 'social_network_name' => $provider)
		));
		
		if ($existingProfile) {
			// #2 - if an existing profile is available, then we set the user as connected and log them in
			$user = $this->User->find('first', array(
				'conditions' => array('id' => $existingProfile['SocialProfile']['user_id'])
			));
			
			$this->_doSocialLogin($user,true);
		} else {
			
			// New profile.
			if ($this->Auth->loggedIn()) {
				// user is already logged-in , attach profile to logged in user.
				// create social profile linked to current user
				$incomingProfile['SocialProfile']['user_id'] = $this->Auth->user('id');
				$this->SocialProfile->save($incomingProfile);
				
				$this->Session->setFlash('Your ' . $incomingProfile['SocialProfile']['social_network_name'] . ' account is now linked to your account.');
				$this->redirect($this->Auth->redirectUrl());

			} else {
				// no-one logged and no profile, must be a registration.
				$user = $this->User->createFromSocialProfile($incomingProfile);
				$incomingProfile['SocialProfile']['user_id'] = $user['User']['id'];
				$this->SocialProfile->save($incomingProfile);

				// log in with the newly created user
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

    public function index() {
		$this->paginate = array(
			'limit' => 10,
			'order' => array('User.username' => 'asc' ),
			'conditions' => array('User.status' => 1),
		);
		$users = $this->paginate('User');
		$this->set(compact('users'));
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