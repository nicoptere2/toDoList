<?php 
class TodoListsController  extends AppController {
	public $uses = 'TodoList';

		public function create() {                
			//verifie si l'utilisteur a entre qqchose
			if($this->request->is('post')){

                $list = $this->request->data;
				
				$this->TodoList->create($this->request->data, TRUE);
				
				// Test de la fréquence
				if($list['TodoList']['frequency'] == '') {
					$list['TodoList']['frequency'] = 0;
				}
				else if($list['TodoList']['frequency'] == '0') {
					$list['TodoList']['frequency'] = 1;
				}
				else if($list['TodoList']['frequency'] == '1') {
					$list['TodoList']['frequency'] = 7;
				}
					else if($list['TodoList']['frequency'] == '2') {
					$list['TodoList']['frequency'] = 30;
				}
 
                if($this->TodoList->save(array(
                                'name' => $list['TodoList']['name'],
                                'frequency'    => $list['TodoList']['frequency'],
                                'expirationDate'      => $list['TodoList']['expirationDate']
                          ))){

                        $this->Auth->login();        
                        return $this->redirect('/');
                }                
			}
		}

	
}