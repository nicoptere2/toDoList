<?php 
class UsersController  extends AppController {
	public $scaffold;


    public function login()
    {
      if($this->request->is('post'))
      {
            if($this->Auth->login())
            {          //si l'utilisateur est log√©
                $this->Session->setFlash('<strong>F√©licitation</strong> Vous vous etes Identifi√© avec succes', 'flash_success');
                return $this->redirect('/');            
            }
            else
            {
               $this->Session->setFlash('<strong>Attention</strong> utisateur inexistant ou mot de passe incorecte', 'flash_warning');
            }
      }
    }
    
    public function logout(){  
        if($this->Auth->logout()){ 
            $this->Session->setFlash('<strong>Deconnect√©</strong> En esp√©rant vous revoir', 'flash_success');
            return $this->redirect('/');
        }
    }
    
    function facebook(){
    	require APPLIBS.'Facebook'.DS.'facebook.php';
    	$facebook = new Facebook(array(
    		'appId' => '419331041567720',
    		'secret' => '9c2939b0aed96b12483a8573e8e6c4a7',
    	));
    	
    	$user = $facebook->getUser();
    	
    	if($user)
    	{
    		try
    		{
    			$infos = $facebook->api('/me');
    			
    			if($this->request->is('post')) {
    				$data = $this->request->data['User'];
    				$d = array(
    						'username' => $data['username'],
    						'facebook_id' => $infos['id'],
    						'email' => $infos['email']
    				);
    				
    				if($this->User->save($d)) {
    					$this->Session->setFlash('Vous etes maintenant inscrit', 'notif');
    					$u = $this->User->read(); // cette ligne, qui ne marche pas, ME FAIS CHIER
    					$this->Auth->login($u['User']);
    					$this->redirect('/');
    				}
    				else {
    					$this->Session->setFlash("Votre pseudo est dÈj‡ utilisÈ", "notif", array('type' => 'error'));
    				}
    			}
    			
    			$d = array();
    			$d['user'] = $infos;
    			$this->set($d);
       		}
    		catch(FacebookApiException $e)
    		{
    			debug($e);
    		}
    	}
    	else
    	{
    		$this->Session->setFlash("Erreur de l'identification facebook", "notif", array('type'=>'error'));
    		$this->redirect(array('action'=>'login'));
    	}
    	
    	 }

    public function inscription(){ 
        $this->Auth->allow('inscription');
                
        //verifie si l'utilisteur a entre qqchose
        if($this->request->is('post')){
            
            $user = $this->request->data;

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