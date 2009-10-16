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
		
		$record_id = $this->params['form']['id'];
		$form_action = $this->params['form']['action'];

		if($form_action == '__a' || $form_action == '__e') {
			$this->data['AssetCategory']['category_code'] = 
												$this->params['form']['category_code'];
			$this->data['AssetCategory']['name'] = 
												$this->params['form']['category_name'];
			$this->data['AssetCategory']['description'] = 
												$this->params['form']['category_description'];
												
			$this->data['AssetCategory']['record_status'] = 'A'; // Record in Active status
		
								
			if($form_action == '__a') { // If request is to ADD a new record
			
				$this->AssetCategory->create();
				$this->AssetCategory->save($this->data);
			
			} elseif($form_action == '__e') { // If request is to EDIT a record		
			
				$this->data['AssetCategory']['id'] = $record_id;
				$this->AssetCategory->save($this->data);
			
			}
		} elseif($form_action == '__d') { // If request is to DELETE a record
			$this->data['AssetCategory']['id'] = $record_id;
			$this->data['AssetCategory']['record_status'] = 'D'; // Record in Deleted status
			$this->AssetCategory->save($this->data);	
		}
		
		//$this->set('params', $record_id . $form_action);

		// Set data for update data-grid.
		// JSON object is created in view file accordingly
		$asset_categories_data = $this->AssetCategory->get_asset_categories_for_json();
		$this->set('asset_categories_data', $asset_categories_data);
		
	}


}
?>
