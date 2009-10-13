<?php
class SuppliersController extends AppController {

	var $name = 'Suppliers';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Supplier');
	

	function asset_suppliers() {
		Configure::write('debug', 0);

		$suppliers_data = $this->Supplier->get_suppliers_for_json();
		$this->set('suppliers_data', array('suppliers_data' => $suppliers_data));	
	}
	
	// Action to Add/Edit/Delete branch records via Ajax
/*	function asset_suppliers_update() {
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
*/

}
?>
