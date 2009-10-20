<?php
class AssetRequestsController extends AppController {

	var $name = 'AssetRequests';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Employee', 'Branch', 'Division');
	
	function asset_requests() {
		Configure::write('debug', 0);

		// Employee data for common browser
		$emp_data = $this->Employee->get_employees_for_json_mini();
		$this->set('employee_data', array('employee_data' => $emp_data));

	}
	
	function view_requests() {

	}
}
?>
