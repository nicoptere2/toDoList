<?php 
class Task extends AppModel {
	public $hasMany = 'Checked';
	public $belongsTo = 'ToDo';
        
        
        public $validate = array(
                            'name' => array(
                                            'rule'  => 'alphaNumeric',
                                            'message' => 'Chiffres et lettres uniquement !'
                                            ),
                            'quantity'      => array(
                                            'rule' => array('naturalNumber', false),
                                            'message' => 'Entrer une quantitée POSITIVE !'
                                             )
                            );
}