<?php 
class User extends AppModel {
	public $hasMany = array( 'Member',
							'Message', 
							'CheckedBy',
							'Friend' => array('className' => 'Friend',
											  'foreignKey' => 'friend_id')
							);
	public $hasOne = 'Friend'
}