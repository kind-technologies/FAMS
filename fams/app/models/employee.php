<?php
class Employee extends AppModel {

	var $name = 'Employee';

	var $belongsTo = array(
				'Division' => array('className' => 'Division'),
				'Branch' => array('className' => 'Branch')
			);
	
	// Prepare an array	with employee data
	// to render as a JSON object 	
	function get_employees_for_json() {
		$employees = $this->findAll(array('record_status'=>'A'), null, 'Employee.id ASC');
		$emp_data = array();

		foreach($employees as $employee) {

			$emp_data[] = array($employee['Employee']['employee_id'], 
									$employee['Employee']['name_with_initials'], 
									$employee['Employee']['contact_number'], 
									$employee['Branch']['branch_code'],
									$employee['Division']['division_code'], 
									date( 'm/d/Y', 
										strtotime($employee['Employee']['date_of_birth'])),
									$employee['Employee']['full_name'], 
									$employee['Employee']['gender'], 
									$employee['Employee']['email'], 
									$employee['Employee']['address'], 
									$employee['Employee']['id'],
									$employee['Division']['id'],
									$employee['Branch']['id'] );
			
		}
		
		return $emp_data;
	
	}
}
?>
