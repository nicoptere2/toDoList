<?php 
class Message extends AppModel {
	public $belongsTo = array('User', 'List');
}