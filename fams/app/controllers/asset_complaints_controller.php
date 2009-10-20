<?php
class AssetComplaintsController extends AppController {

	var $name = 'AssetComplaints';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Asset', 'AssetCategory', 'Employee', 'Branch', 'Division');
	
	function asset_complaints() {
		Configure::write('debug', 0);

		// Pickup asset categories for category browser grid
		$asset_categories_data = 
							$this->AssetCategory->get_asset_categories_for_json();
		$this->set('asset_categories_data', 
				array('asset_categories_data' => $asset_categories_data));

		// Employee data for common browser
		$emp_data = $this->Employee->get_employees_for_json_mini();
		$this->set('employee_data', array('employee_data' => $emp_data));

	}

	function asset_complaints_browsers() {
		Configure::write('debug', 0);
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
	}


	function view_complaints() {

	}
}
?>
