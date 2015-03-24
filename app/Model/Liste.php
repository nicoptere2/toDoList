<?php 
class Liste extends AppModel {
	public $useTable = 'lists';

	//public $hasOne = 'Task';
	public $hasMany = array('Message', 'Member', 'Task');
}