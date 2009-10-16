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
	function asset_suppliers_update() {
		Configure::write('debug', 0);
		
		$this->layout = 'ajax';
	
		$record_id = $this->params['form']['id'];
		$form_action = $this->params['form']['action'];
			
		if($form_action == '__a' || $form_action == '__e') {
			$this->data['Supplier']['supplier_code'] = 
												$this->params['form']['supplier_code'];
			$this->data['Supplier']['description'] = 
												$this->params['form']['description'];
			$this->data['Supplier']['address'] = 
												$this->params['form']['address'];
			$this->data['Supplier']['contact_number'] = 
												$this->params['form']['contact_number'];
			$this->data['Supplier']['email'] = 
												$this->params['form']['email'];

			$this->data['Supplier']['record_status'] = 'A'; // Record in Active status
			
								
			if($form_action == '__a') { // If request is to ADD a new record
			
				$this->Supplier->create();
				$this->Supplier->save($this->data);
			
			} elseif($form_action == '__e') { // If request is to EDIT a record		
			
				$this->data['Supplier']['id'] = $record_id;
				$this->Supplier->save($this->data);
			
			}
		} elseif($form_action == '__d') { // If request is to DELETE a record
			$this->data['Supplier']['id'] = $record_id;
			$this->data['Supplier']['record_status'] = 'D'; // Record in Deleted status
			$this->Supplier->save($this->data);	
		}
		
		//$this->set('params', $record_id . $form_action);

		// Set data for update data-grid.
		// JSON object is created in view file accordingly
		$suppliers_data = $this->Supplier->get_suppliers_for_json();
		$this->set('suppliers_data', $suppliers_data);
	
	}


}
?>
