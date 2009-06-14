<?php
class FamsController extends AppController {

	var $name = 'Fams';
	var $components = array('Auth');
	var $uses = array('SystemMenu');
	var $helpers = array('Html', 'Form', 'Javascript');
/*
	function beforeFilter() {
        $this->Auth->allow('index','view');
	}
*/
	function index() {
		
	}
	
	function home() {

	}
}
?>
