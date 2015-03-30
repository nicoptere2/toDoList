<?php 
class Friend extends AppModel {
	public $belongsTo = array(
		'User' => array(
			array(
				'className' => 'User',
				'foreignKey' => 'user_id', 'friend_id'
				),
			array(
				'className' => 'User',
				'foreignKey' => 'user_id', 'friend_id'
				)
			)
		);
}