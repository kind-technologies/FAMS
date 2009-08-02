<?php
class EmployeesController extends AppController {

	var $name = 'Employees';
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
		
		$record_id = $this->params['form']['id'];
		$form_action = $this->params['form']['action'];
			
		if($form_action == '__a' || $form_action == '__e') {
			$this->data['Employee']['employee_id'] = 
												$this->params['form']['employee_id'];
			$this->data['Employee']['full_name'] = 
												$this->params['form']['full_name'];
			$this->data['Employee']['name_with_initials'] = 
												$this->params['form']['name_with_initials'];
			$this->data['Employee']['date_of_birth'] = 
												$this->params['form']['date_of_birth'];
		
			$this->data['Employee']['gender'] = 	$this->params['form']['gender'];
		
			$this->data['Employee']['email'] = 
												$this->params['form']['email'];
			$this->data['Employee']['address'] = 
												$this->params['form']['address'];
			$this->data['Employee']['contact_number'] = 
												$this->params['form']['contact_number'];
			$this->data['Employee']['branch_id'] = 
												$this->params['form']['branch_id'];
			$this->data['Employee']['division_id'] = 
												$this->params['form']['division_id'];

			$this->data['Employee']['photo'] = '';
			$this->data['Employee']['record_status'] = 'A'; // Record in Active status
			
								
			if($form_action == '__a') { // If request is to ADD a new record
			
				$this->Employee->create();
				$this->Employee->save($this->data);
			
			} elseif($form_action == '__e') { // If request is to EDIT a record		
			
				$this->data['Employee']['id'] = $record_id;
				$this->Employee->save($this->data);
			
			}
		} elseif($form_action == '__d') { // If request is to DELETE a record
			$this->data['Employee']['id'] = $record_id;
			$this->data['Employee']['record_status'] = 'D'; // Record in Deleted status
			$this->Employee->save($this->data);	
		}
		
		$this->set('params', $record_id . $form_action);

		// Set data for update data-grid.
		// JSON object is created in view file accordingly
		$emp_data = $this->Employee->get_employees_for_json();
		$this->set('employee_data', $emp_data);
		
	}
	
	function employee_upload_photo() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';
		
		// Update database
		
		// Save photo file
		
		$this->set('photo_name', json_encode($_FILES['photo-path']['name']));
	}
	
	function employee_load_photo() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';
	}

}
