<?php 
class Memeber extends AppModel {
	public $belongsTo = array('User', 'List', 'Right');
}