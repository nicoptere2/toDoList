<?php 
class CheckedBy extends AppModel {
	public $belongsTo = array('User', 'Task')
}