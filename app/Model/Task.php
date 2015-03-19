<?php 
class Task extends AppModel {
	public $hasMany = 'CheckedBy';
	public $belongsTo = 'List';
}