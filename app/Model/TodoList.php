<?php 
class TodoList extends AppModel {
	public $useTable = 'lists';

	public $hasOne = 'Task';
	public $hasMany = array('Message', 'Member');
	
	public $validate = array(
        'name' => array(
			'rule'  => 'notEmpty',
			'message' => 'Entrer un nom de liste !'
		),
		'expirationDate' => array(
            'rule'    => 'date',
			'message' => 'Date invalide !'
		)
	);
}