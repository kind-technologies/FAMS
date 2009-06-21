<?php
class WebSiteController extends AppController {

	var $name = "WebSite";
	var $uses = array();
	var $helpers = array('Html', 'Form', 'Javascript');
	
	function index() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';
	} 

}
?>
