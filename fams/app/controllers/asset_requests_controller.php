<?php
class AssetRequestsController extends AppController {

	var $name = 'AssetRequests';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Employee', 'Branch', 'Division');
	
	function asset_requests() {

	}
	
	function view_requests() {

	}
}
?>
