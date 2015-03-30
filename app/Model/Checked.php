<?php 
class Checked extends AppModel {
	public $belongsTo = array('User', 'Task');
}