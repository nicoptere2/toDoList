<?php 
class TasksController  extends AppController {
	public $scaffold;

    public function add_task($to_do_id){
        //verifie si l'utilisteur a entre qqchose
        if($this->request->is('post')){

                $task = $this->request->data;

                $this->Task->create($task, TRUE);
                if($this->Task->save(array(
                            'name'     => $task['Task']['name'],
                            'quantity' => $task['Task']['quantity'],
                            'to_do_id'      => $to_do_id
                      ))){
    
                    $this->Session->setFlash('élément ajouté', 'flash_info');
                    $this->redirect('/ToDos/tasks/'.$to_do_id);
                }      
            
            
        }
        
        
    }
    
    public function delete_task($to_do_id,$idTask){
        
        $this->loadModel('Checked');
        $task = $this->Task->find('all', array('conditions' => array( 'Task.id' => $idTask)));
        $checked_id = $this->Checked->find('first',
            array('conditions' => array(
                'task_id' => $idTask)));
        foreach ($task as $id) {
            if(!empty($checked_id))
                $this->Checked->delete($checked_id['Checked']['id']);
            $this->Task->delete($id['Task']['id']);
        }
        $this->Session->setFlash('élément supprimé', 'flash_info');
        $this->redirect('/ToDos/tasks/'.$to_do_id);
        
    }
}