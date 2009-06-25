<?php
class FamsController extends AppController {

	var $name = 'Fams';
	var $components = array('Auth');
	var $uses = array('SystemMenu');
	var $helpers = array('Html', 'Form', 'Javascript');

	function index() {
		Configure::write('debug', 0);
	}

	function home() {
		Configure::write('debug', 0);
	}
}
?>
