<?php
class OrgSetupController extends AppController {

	var $name = 'OrgSetup';
	var $uses = array('Branch', 'Division');
	
	function org_structure() {
		Configure::write('debug', 0);
		$this->redirect('branch_view');
	}
	
	function branch_view() {
		Configure::write('debug', 0);

		$branches_data = $this->Branch->get_branches_for_json();
		$this->set('branches_data', array('branches_data' => $branches_data));	
	}
	
	function division_view() {
		Configure::write('debug', 0);

		$divisions_data = $this->Division->get_divisions_for_json();
		$this->set('divisions_data', array('divisions_data' => $divisions_data));	
	}

}
?>
