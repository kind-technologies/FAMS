<?php
class AssetCategoriesController extends AppController {

	var $name = 'AssetCategories';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('AssetCategory');
	

	function asset_categories() {
		Configure::write('debug', 0);

		$asset_categories_data = 
							$this->AssetCategory->get_asset_categories_for_json();
		$this->set('asset_categories_data', 
				array('asset_categories_data' => $asset_categories_data));
	
	}

	// Action to Add/Edit/Delete division records via Ajax
	function asset_category_update() {
		Configure::write('debug', 0);
		
		$this->layout = 'ajax';
/*		
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
*/		
	}


}
?>
