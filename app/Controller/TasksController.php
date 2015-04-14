<?php 
class TasksController  extends AppController {
	public $scaffold;

    public function add_task($to_do_id){
        //verifie si l'utilisteur a entre qqchose
        if($this->request->is('post')){

            //  verifie si la tache existe déjà dans la base
            $task = $this->Task->findByName($this->request->data['Task']['name']);
            if(empty($task)){       //si il existe pas on l'enregistre 

                $task = $this->request->data;

                $this->Task->create($task, TRUE);
                if($this->Task->save(array(
                            'name'     => $task['Task']['name'],
                            'quantity' => $task['Task']['quantity'],
                            'to_do_id'      => $to_do_id
                      ))){
    
                    $this->Session->setFlash('élément ajouté', 'flash_info');
                    $this->redirect('/Todos/tasks/'.$to_do_id);
                }      
            }
            else {
                $this->Session->setFlash('nom de l\'élement déjà existant', 'flash_danger');
                $this->redirect('/Todos/tasks/'.$to_do_id);
            }
        }
        
        
    }
    
    public function delete_task($to_do_id,$idTask){
        
        $task = $this->Task->find('all', array('conditions' => array( 'Task.id' => $idTask)));
        foreach ($task as $id) {              
             $this->Task->delete($id['Task']['id']);
        }
        $this->Session->setFlash('élément supprimé', 'flash_info');
        $this->redirect('/Todos/tasks/'.$to_do_id);
        
    }
}