<?php 
class Task extends AppModel {
	public $hasMany = 'Checked';
	public $belongsTo = 'List';
}