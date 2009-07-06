<?php
class PlanningController extends AppController {

	var $name = 'Planning';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Employee');
	
	function employees() {
		Configure::write('debug', 0);
	
		$employees = $this->Employee->findAll();
		
		$emp_data = '[';

		
		foreach($employees as $employee) {
			$emp_data .= '["'. $employee['Employee']['employee_id'] . 
							'", "' . $employee['Employee']['name_with_initials'] .
							'", "' . $employee['Employee']['contact_number'] .
							'", "' . $employee['Employee']['branch_id'] .
							'","' . $employee['Employee']['division_id'] .
							'", "' . date( 'm/d/Y', strtotime($employee['Employee']['date_of_birth'])) .
							'", "' . $employee['Employee']['full_name'] .
							'", "' . $employee['Employee']['gender'] .
							'", "' . $employee['Employee']['national_id'] .
							'", "' . $employee['Employee']['address'] .
							'", ' . $employee['Employee']['id'] .
							'],';
		}
		
		$emp_data = rtrim($emp_data, ",");
		
		$emp_data .= ']';
		
		$this->set('emp_data', $emp_data);
		
	}

	function emplayee_update() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';
	}
	
	function organization_setup() {

	}

	function asset_categories() {

	}

	function asset_suppliers() {

	}

}
?>
