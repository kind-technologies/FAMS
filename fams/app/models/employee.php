<?php
class Employee extends AppModel {

	var $name = 'Employee';

	var $belongsTo = array(
				'Division' => array('className' => 'Division'),
				'Branch' => array('className' => 'Branch')
			); 
}
?>
