<?php
class PlanningController extends AppController {

	var $name = 'Planning';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Employee', 'Branch', 'Division');
	
	function organization_setup() {

	}

	function asset_categories() {

	}

	function asset_suppliers() {

	}

}
?>
