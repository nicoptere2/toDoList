<?php 
class Member extends AppModel {
	public $belongsTo = array('User', 'List', 'Right');
}