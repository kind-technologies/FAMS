<?php
class OrgSetupController extends AppController {

	var $name = 'OrgSetup';
	var $uses = array('Branch', 'Division', 'Location');
	
	function org_structure() {
		Configure::write('debug', 0);
		$this->redirect('branch_view');
	}
	
	function branch_view() {
		Configure::write('debug', 0);

		$branches_data = $this->Branch->get_branches_for_json();
		
		if (isset($this->params['requested'])) { 
			return $branches_data; 
		}
		
		$this->set('branches_data', array('branches_data' => $branches_data));	
	}
	
	// Action to Add/Edit/Delete branch records via Ajax
	function branch_update() {
		Configure::write('debug', 0);
		
		$this->layout = 'ajax';
		
		$record_id = $this->params['form']['id'];
		$form_action = $this->params['form']['action'];
			
		if($form_action == '__a' || $form_action == '__e') {
			$this->data['Branch']['branch_code'] = 
												$this->params['form']['branch_code'];
			$this->data['Branch']['description'] = 
												$this->params['form']['branch_description'];
			$this->data['Branch']['record_status'] = 'A'; // Record in Active status
			
								
			if($form_action == '__a') { // If request is to ADD a new record
			
				$this->Branch->create();
				$this->Branch->save($this->data);
			
			} elseif($form_action == '__e') { // If request is to EDIT a record		
			
				$this->data['Branch']['id'] = $record_id;
				$this->Branch->save($this->data);
			
			}
		} elseif($form_action == '__d') { // If request is to DELETE a record
			$this->data['Branch']['id'] = $record_id;
			$this->data['Branch']['record_status'] = 'D'; // Record in Deleted status
			$this->Branch->save($this->data);	
		}
		
		//$this->set('params', $record_id . $form_action);

		// Set data for update data-grid.
		// JSON object is created in view file accordingly
		$branch_data = $this->Branch->get_branches_for_json();
		$this->set('branch_data', $branch_data);
		
	}

	
	function division_view() {
		Configure::write('debug', 0);

		$divisions_data = $this->Division->get_divisions_for_json();
		$this->set('divisions_data', array('divisions_data' => $divisions_data));	
	}

	// Action to Add/Edit/Delete division records via Ajax
	function division_update() {
		Configure::write('debug', 0);
		
		$this->layout = 'ajax';
		
		$record_id = $this->params['form']['id'];
		$form_action = $this->params['form']['action'];

		if($form_action == '__a' || $form_action == '__e') {
			$this->data['Division']['division_code'] = 
												$this->params['form']['division_code'];
			$this->data['Division']['description'] = 
												$this->params['form']['division_description'];
			$this->data['Division']['record_status'] = 'A'; // Record in Active status
		
								
			if($form_action == '__a') { // If request is to ADD a new record
			
				$this->Division->create();
				$this->Division->save($this->data);
			
			} elseif($form_action == '__e') { // If request is to EDIT a record		
			
				$this->data['Division']['id'] = $record_id;
				$this->Division->save($this->data);
			
			}
		} elseif($form_action == '__d') { // If request is to DELETE a record
			$this->data['Division']['id'] = $record_id;
			$this->data['Division']['record_status'] = 'D'; // Record in Deleted status
			$this->Division->save($this->data);	
		}
		
		$this->set('params', $record_id . $form_action);

		// Set data for update data-grid.
		// JSON object is created in view file accordingly
		$division_data = $this->Division->get_divisions_for_json();
		$this->set('division_data', $division_data);
		
	}


	function location_view() {
		Configure::write('debug', 2);

		$locations_data = $this->Location->get_locations_for_json();
		$this->set('locations_data', array('locations_data' => $locations_data));
		
		// Branch data for drop down list
		$branch_data = $this->Branch->get_branches_for_json();
		$this->set('branch_data', array('branch_data' => $branch_data));
	}

	// Action to Add/Edit/Delete division records via Ajax
	function location_update() {
		Configure::write('debug', 0);
		
		$this->layout = 'ajax';
		
		$record_id = $this->params['form']['id'];
		$form_action = $this->params['form']['action'];

		if($form_action == '__a' || $form_action == '__e') {
			$this->data['Location']['location_code'] = 
												$this->params['form']['location_code'];
			$this->data['Location']['description'] = 
												$this->params['form']['location_description'];
			$this->data['Location']['branch_id'] = 
												$this->params['form']['location_branch'];
												
			$this->data['Location']['record_status'] = 'A'; // Record in Active status
		
								
			if($form_action == '__a') { // If request is to ADD a new record
			
				$this->Location->create();
				$this->Location->save($this->data);
			
			} elseif($form_action == '__e') { // If request is to EDIT a record		
			
				$this->data['Location']['id'] = $record_id;
				$this->Location->save($this->data);
			
			}
		} elseif($form_action == '__d') { // If request is to DELETE a record
			$this->data['Location']['id'] = $record_id;
			$this->data['Location']['record_status'] = 'D'; // Record in Deleted status
			$this->Location->save($this->data);	
		}
		
		//$this->set('params', $record_id . $form_action);

		// Set data for update data-grid.
		// JSON object is created in view file accordingly
		$location_data = $this->Location->get_locations_for_json();
		$this->set('location_data', $location_data);
		
	}

}
?>
