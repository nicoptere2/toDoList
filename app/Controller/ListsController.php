<?php 
class ListsController  extends AppController {
	public $scaffold;

	public $uses = 'Liste';

	public function index() {
		if ($this->request->is('ajax')) {
			// modifier le layout par default pour l'ajax
			// modifier la vue utilisé
		}

		$lists = $this->Liste->find('all');

		$this->set(array('lists' => $lists));

	}



}