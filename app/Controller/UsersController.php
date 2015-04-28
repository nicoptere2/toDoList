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
      /*  $this->User->save(array(
                                'username' => 'umut',
                                'password' => $this->Auth->password('umut')
                          ));*/
       // debug($this->User->findByUsername('akkulak'));
        
        //Cas ou l'on est déja connecté
        if($this->Session->check('Auth.User')){
                $this->redirect('/');	
        }
                
        if(!empty($this->data)){
            if($this->Auth->login()){           //si l'utilisateur est logé
                $this->Session->setFlash('<strong>Félicitation</strong> Vous vous etes Identifié avec succes', 'flash_success');
                return $this->redirect('/');            
            }
            else{
               $this->Session->setFlash('<strong>Attention</strong> utisateur inexistant ou mot de passe incorecte', 'flash_warning');
               $this->redirect('/Users/inscription');
            }
        }
    }
    
    public function logout(){  
        if($this->Auth->logout()){ 
            $this->Session->setFlash('<strong>Deconnecté(e)</strong> En espérant vous revoir', 'flash_success');
            return $this->redirect('/');
        }
    }


	/*public function profil($id = null)
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
							'User.id' => $id
						)
					)
				);
			$avertissement = "Vous avez été déconnecté";
	
			$this->set('test',$id);		
	}*/
	
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
	
	public function monprofile($user)
	{
		//$id = $this->Auth->user('id');
		//$this->set('test',$id);	
		$busername = false;
		$bemail = false;
		$bage = false;
		
		$id = $this->User->find('all',array(
		'conditions' => array('username' => $user),
		'fields'=>array('username','email','age')
		));
		if (!$id) {
            throw new NotFoundException(__('Utilisateur inexistant'));
        }
		//$avertissement = "Vous avez été déconnecté";
		$this->set('test',$id);	
		
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
