<?php 
class List extends AppModel {
	public $hasOne = 'Task';
	public $hasMany = array('Message', 'Member');
}