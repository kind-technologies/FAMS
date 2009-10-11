<?php
class DepreciationController extends AppController {

	var $name = 'Depreciation';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Employee', 'Branch', 'Division');
	
	function depreciation_report_yearly() {

	}

	function depreciation_info() {

	}
}
?>
