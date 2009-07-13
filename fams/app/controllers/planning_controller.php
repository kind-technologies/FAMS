<?php
class PlanningController extends AppController {

	var $name = 'Planning';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Employee', 'Branch', 'Division');
	
	
	// Action to display employee information screen 
	function employees() {
		Configure::write('debug', 0);

		$emp_data = $this->Employee->get_employees_for_json();
		$this->set('employee_data', array('employee_data' => $emp_data));
		
	}

	// Action to Add/Edit/Delete employee records via Ajax
	function emplayee_update() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';

		// If request is to ADD a new record
		
		
		// If request is to EDIT a record
		
		
		// If request is to DELETE a record



		// Set data for update data-grid.
		// JSON object is created in view file accordingly
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
