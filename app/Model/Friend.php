<?php 
class Friend extends AppModel {
	public $belongsTo = array('User' => array('className' => 'User',
											  'foreignKey' => array('user_id', 'friend_id')));
}