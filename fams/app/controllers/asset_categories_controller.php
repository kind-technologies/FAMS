<?php
class AssetCategoriesController extends AppController {

	var $name = 'AssetCategories';
	var $components = array('Auth');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Employee', 'Branch', 'Division');
	


	function asset_categories() {

	}


}
?>
