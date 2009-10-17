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

			$this->data['Employee']['photo'] = NULL;
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
		
		//$this->set('params', $record_id . $form_action);

		// Set data for update data-grid.
		// JSON object is created in view file accordingly
		$emp_data = $this->Employee->get_employees_for_json();
		$this->set('employee_data', $emp_data);
		
	}
	
	function employee_upload_photo() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';
		
		if ((($_FILES['photo']['type'] == 'image/gif') ||
				($_FILES['photo']['type'] == 'image/png') || 
				($_FILES['photo']['type'] == 'image/jpeg') || 
				($_FILES['photo']['type'] == 'image/pjpeg')) && 
				($_FILES['photo']['size'] < 300000)) { // Restrict the file size to 300KB

			if ($_FILES['photo']['error'] > 0) {
				//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			} else {
				
				
				$emp_id = $this->params['form']['hdn_upld_emp_id'];
				$employee = $this->Employee->find(array('Employee.id'=>$emp_id));
				
				// Create unique file name
				$file_name = md5($employee['Employee']['id']) . '-' . rand(0, 5);
				$extension = '';
				
				switch ($_FILES['photo']['type']) {
					case 'image/gif':
						$extension = '.gif';
						break;
					case 'image/png':
						$extension = '.png';
						break;
					case 'image/jpeg':
						$extension = '.jpg';
						break;
					case 'image/pjpeg': // IE MIME type for jpg
						$extension = '.jpg';
						break;
				}

				$file_name .= $extension;
				
				// Get the existing file name, remove the file if exists
				if($employee['Employee']['photo']) {
					@unlink("img/employee_imgs/" . $employee['Employee']['photo']);
				}

				// Update the DB with new file name
				$emp_data['Employee']['id'] = $emp_id;
				$emp_data['Employee']['photo'] = $file_name;
				$this->Employee->save($emp_data);
				
				// Save the file
				move_uploaded_file($_FILES["photo"]["tmp_name"],
											"img/employee_imgs/" . $file_name);
		
			}
		} else {
			//echo "Invalid file";
		}
		
		
		$this->set('photo_name', json_encode($this->params['form']['hdn_upld_emp_id']));
	}
	
	function employee_load_photo() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';

		$emp_id = $this->params['form']['id'];
		$employee = $this->Employee->find(array('Employee.id' => $emp_id));
		
		if(isset($employee['Employee']['photo'])) {
			$this->set('emp_photo', $employee['Employee']['photo']);
		} else {
			$this->set('emp_photo', 'NO');
		}
	}

}
