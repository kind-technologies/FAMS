<?php
class AssetsController extends AppController {

	var $name = 'Assets';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Asset', 'AssetCategory', 'Supplier', 'Employee', 
										'Branch', 'Division', 'Location');
	
	
	//--> SECTION FOR ASSET REGISTRY
	
	// Action to display employee information screen 
	function asset_registry() {
		Configure::write('debug', 0);

		// Get data for grid view
		$assets_data = $this->Asset->get_assets_for_json();
		$this->set('assets_data', array('assets_data' => $assets_data));

		//  Prepare data for asset category selection box
		$asset_categories_data = 
							$this->AssetCategory->get_asset_categories_for_json();
		$this->set('asset_categories_data', 
				array('asset_categories_data' => $asset_categories_data));

		// Prepare data for supplier selection box
		$suppliers_data = $this->Supplier->get_suppliers_for_json_mini();
		$this->set('suppliers_data', array('suppliers_data' => $suppliers_data));	

	}

	// Action to Add/Edit/Delete employee records via Ajax
	function asset_registry_update() {
		Configure::write('debug', 0);
		
		$this->layout = 'ajax';
		
		$record_id = $this->params['form']['id'];
		$form_action = $this->params['form']['action'];
			
		if($form_action == '__a' || $form_action == '__e') {
			$this->data['Asset']['asset_code'] = 
												$this->params['form']['asset_code'];
			$this->data['Asset']['short_name'] = 
												$this->params['form']['short_name'];
			$this->data['Asset']['description'] = 
												$this->params['form']['description'];
		
			$this->data['Asset']['asset_category_id'] = 	$this->params['form']['asset_category_id'];
		
			$this->data['Asset']['supplier_id'] = 
												$this->params['form']['supplier_id'];
			$this->data['Asset']['purchase_price'] = 
												$this->params['form']['purchase_price'];
			$this->data['Asset']['purchase_date'] = 
												$this->params['form']['purchase_date'];
			$this->data['Asset']['lifespan'] = 
												$this->params['form']['lifespan'];
			$this->data['Asset']['salvage_value'] = 
												$this->params['form']['salvage_value'];

			$this->data['Asset']['photo'] = NULL;
			$this->data['Asset']['record_status'] = 'A'; // Record in Active status
			
								
			if($form_action == '__a') { // If request is to ADD a new record
			
				$this->Asset->create();
				$this->Asset->save($this->data);
			
			} elseif($form_action == '__e') { // If request is to EDIT a record		
			
				$this->data['Asset']['id'] = $record_id;
				$this->Asset->save($this->data);
			
			}
		} elseif($form_action == '__d') { // If request is to DELETE a record
			$this->data['Asset']['id'] = $record_id;
			$this->data['Asset']['record_status'] = 'D'; // Record in Deleted status
			$this->Asset->save($this->data);	
		}
		
		//$this->set('params', $record_id . $form_action);

		// Set data for update data-grid.
		// JSON object is created in view file accordingly
		$assets_data = $this->Asset->get_assets_for_json();
		$this->set('assets_data', $assets_data);

		
	}
	
	function asset_registry_upload_photo() {
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
				
				
				$asset_id = $this->params['form']['hdn_upld_asset_id'];
				$asset = $this->Asset->find(array('Asset.id'=>$asset_id));
				
				// Create unique file name
				$file_name = md5($asset['Asset']['id']) . '-' . rand(0, 5);
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
				if($asset['Asset']['photo']) {
					@unlink("img/asset_imgs/" . $asset['Asset']['photo']);
				}

				// Update the DB with new file name
				$asset_data['Asset']['id'] = $asset_id;
				$asset_data['Asset']['photo'] = $file_name;
				$this->Asset->save($asset_data);
				
				// Save the file
				move_uploaded_file($_FILES["photo"]["tmp_name"],
											"img/asset_imgs/" . $file_name);
		
			}
		} else {
			//echo "Invalid file";
		}
		
		
		$this->set('photo_name', json_encode($this->params['form']['hdn_upld_asset_id']));
	}
	
	function asset_registry_load_photo() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';

		$asset_id = $this->params['form']['id'];
		$asset = $this->Asset->find(array('Asset.id' => $asset_id));
		
		if(isset($asset['Asset']['photo'])) {
			$this->set('asset_photo', $asset['Asset']['photo']);
		} else {
			$this->set('asset_photo', 'NO');
		}
	}

	//--> END SECTION FOR ASSET REGISTRY
	
	//--> SECTION FOR ASSET ALLOCATION

	function asset_allocation() {
		Configure::write('debug', 0);
		
		// Pickup asset categories for category browser grid
		$asset_categories_data = 
							$this->AssetCategory->get_asset_categories_for_json();
		$this->set('asset_categories_data', 
				array('asset_categories_data' => $asset_categories_data));
		
		// Branch data for drop down list
		$branch_data = $this->Branch->get_branches_for_json();
		$this->set('branch_data', array('branch_data' => $branch_data));
		
		// Employee data for common browser
		$emp_data = $this->Employee->get_employees_for_json_mini();
		$this->set('employee_data', array('employee_data' => $emp_data));
	}

	function asset_allocation_browsers() {
		Configure::write('debug', 1);
		$this->layout = 'ajax';

		$request_type = $this->params['form']['request_type'];
		$type_id = $this->params['form']['type_id'];

		// If type is asset browser : A
		if($request_type == 'A') {
			$conditions = array('Asset.asset_category_id' => $type_id);
			$asset_data = $this->Asset->get_assets_for_json_mini($conditions);
			$this->set('grid_data', $asset_data);
			$this->set('request_type', $request_type);
		}
		
		// If type is location browser : L
		if($request_type == 'L') {
			$conditions = array('Location.branch_id' => $type_id);
			$location_data = $this->Location->get_locations_for_json_mini($conditions);
			$this->set('grid_data', $location_data);
			$this->set('request_type', $request_type);
		}
		
	}

	function asset_allocation_update() {
		Configure::write('debug', 0);
		
		$this->layout = 'ajax';
		
		$record_id = $this->params['form']['asset_id'];
		$assign_type = $this->params['form']['assign_type'];
			
		if($assign_type == 'P' || $assign_type == 'L') {
			
			$this->data['Asset']['id'] = $record_id;
			
			$this->data['Asset']['custodian_id'] = 
												$this->params['form']['person_id'];
			$this->data['Asset']['commencement_date'] = 
												$this->params['form']['commencement_date'];
								
			if($assign_type == 'P') { // If assign to a person
				$this->data['Asset']['assign_type'] = 'P';
			} elseif($assign_type == 'L') { // If assign to a location		
				$this->data['Asset']['assign_type'] = 'L';			
				$this->data['Asset']['location_id'] = 
												$this->params['form']['location_id'];
			}
			
			$this->Asset->save($this->data);

		}
		
		$this->set('params', $this->data['Asset']['location_id']);

		// Set data for update data-grid.
		// JSON object is created in view file accordingly
		$assets_data = $this->Asset->get_assets_for_json();
		$this->set('assets_data', $assets_data);

	}

	//--> END SECTION FOR ASSET ALLOCATION	

	function asset_browser() {
	
	}
	
	function assets_by_category() {
	
	}

	function assets_by_location() {
	
	}

	function assets_by_supplier() {
	
	}
	
	function change_custodian() {

	}

	function change_location() {

	}

	function disposals() {

	}
	
	
}
?>
