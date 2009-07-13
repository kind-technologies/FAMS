<?php
class PlanningController extends AppController {

	var $name = 'Planning';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Employee', 'Branch', 'Division');
	
	function employees() {
		Configure::write('debug', 0);

		$emp_data = $this->Employee->get_employees_for_json();
		$this->set('employee_data', array('employee_data' => $emp_data));
		
	}

	function emplayee_update() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';

		$emp_data = $this->Employee->get_employees_for_json();
		$this->set('employee_data', $emp_data);
		
	}
	
	function organization_setup() {

	}

	function asset_categories() {

	}

	function asset_suppliers() {

	}

}
?>
