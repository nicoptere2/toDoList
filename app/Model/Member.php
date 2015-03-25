<?php 
class Member extends AppModel {
	public $belongsTo = array('User', 'ToDo', 'Right');
}