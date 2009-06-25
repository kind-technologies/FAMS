<?php

class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form', 'Javascript');
	var $components = array('Auth'); 
	//Not necessary if declared in your app controller

	/**
	*  The AuthComponent provides the needed functionality
	*  for login, so you can leave this function blank.
	*/
	
	function beforeFilter() {
		$this->Auth->autoRedirect = FALSE;
	}
	
	function login() {
		Configure::write('debug', 0);
		if($this->Auth->isAuthorized()){
			$this->redirect('/fams/index');
		}
	}

	function logout() {
		$this->redirect($this->Auth->logout());
	}
}

?>
