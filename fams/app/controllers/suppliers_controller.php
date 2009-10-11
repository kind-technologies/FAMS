<?php
class SuppliersController extends AppController {

	var $name = 'Suppliers';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Employee', 'Branch', 'Division');
	

	function asset_suppliers() {

	}

}
?>
