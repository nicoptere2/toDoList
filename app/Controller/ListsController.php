<?php 
class ListsController  extends AppController {
	public $scaffold;

	public $uses = 'Liste';

	public $components = array('RequestHandler');

	public function index() {
		$lists = $this->Liste->find('all');

		$this->set(array('lists' => $lists));
	}

	public function listAjax() {
		$this->layout = 'ajax';

		$lists = $this->Liste->find('all');

		$this->set(array('lists' => $lists));
	}

	public function tasks($list_id = null) {
		if($list_id == null)
			$this->redirect('/Lists');

		$list = $this->Liste->find('first', array('conditions' => array('Liste.id' => $list_id)));
		if($list == array()){
			$this->Session->setFlash('Liste inconnu');
			$this->redirect('/lists');
		}
		$this->set(array('list' => $list));
	}



}