<?php 
class ToDo extends AppModel {
	public $useTable = 'to_dos';
	public $hasOne = 'Task';
	public $hasMany = array('Message', 'Member', 'Task');
	
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