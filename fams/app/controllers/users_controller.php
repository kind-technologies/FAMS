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
	function login() {
		//debug($this->Auth);
	}

	function logout() {
		$this->redirect($this->Auth->logout());
	}
}

?>
