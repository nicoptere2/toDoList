<?php 
class UsersController  extends AppController {
	public $scaffold;


    public function login(){
      /*  $this->User->save(array(
                                'username' => 'umut',
                                'password' => $this->Auth->password('umut')
                          ));*/
       // debug($this->User->findByUsername('akkulak'));
        if(!empty($this->data)){
            if($this->Auth->login()){           //si l'utilisateur est logé
                $this->Session->setFlash('<strong>Félicitation</strong> Vous vous etes Identifié avec succes', 'flash_success');
                return $this->redirect('/');            
            }
            else{
               $this->Session->setFlash('<strong>Attention</strong> utisateur inexistant ou mot de passe incorecte', 'flash_warning');
            }
        }
    }
    
    public function logout(){  
        if($this->Auth->logout()){ 
            $this->Session->setFlash('<strong>Deconnecté</strong> En espérant vous revoir', 'flash_success');
            return $this->redirect('/');
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