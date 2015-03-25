<?php 
class Liste extends AppModel {
	public $useTable = 'listes';

	//public $hasOne = 'Task';
	public $hasMany = array('Message', 'Member', 'Task');
}