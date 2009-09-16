<?php
// Controller to handle user authentication
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form', 'Javascript');
	var $components = array('Auth'); 
	//Not necessary if declared in your app controller


	//  The AuthComponent provides the needed functionality
	//  for login, so can leave this function blank.
	
	function beforeFilter() {
		$this->Auth->autoRedirect = FALSE;
	}
	
	// Function to validate login
	function login() {
		Configure::write('debug', 0);
		if($this->Auth->isAuthorized()){
			$this->redirect('/fams/index');
		}
	}

	// Handle system logout functionality
	function logout() {
		$this->redirect($this->Auth->logout());
	}
}

?>
