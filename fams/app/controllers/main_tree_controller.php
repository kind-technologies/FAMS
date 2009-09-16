<?php
// Main controller class for the system tree menu
class MainTreeController extends AppController {

	var $name = 'MainTree';
	var $uses = array('SystemMenu');
	var $components = array('Auth');
	var $helpers = array('Html', 'Javascript');

	
	function index() {
		Configure::write('debug', 0);
	}
	
	// Function to generate tree-view (javascript) dynamically from DB
	function tree_view() {

		Configure::write('debug', 0);

		// Set layout to empty, so only javascript will be printed to output
		$this->layout = 'ajax';

		// Retrieve data for tree-menu from database
		$menu_data = $this->SystemMenu->findAll('parent_id=0', null, 'order asc');

		// Build the tree
		$tree_data = '[';

		foreach($menu_data as $root) :

			$tree_data .= '{
							id: ' . $root['SystemMenu']['id'] . ',
							text: \''. $root['SystemMenu']['title'] .'\',
							children: [
							';

			$sub_menu_data = $this->SystemMenu->findAll('parent_id=' . $root['SystemMenu']['id'], 
															null, 'order asc');

			foreach($sub_menu_data as $child) :
				$tree_data .= '{
										id: ' . $child['SystemMenu']['id'] . ',
										program_name: \''. $child['SystemMenu']['program_name'] .'\',
										text: \''. $child['SystemMenu']['title'] .'\',
										leaf: true
									},';
			endforeach;	

			$tree_data = rtrim($tree_data, ',');

			$tree_data .= ']
						},';

		endforeach;

		$tree_data = rtrim($tree_data, ',');
		
		$tree_data .= ']';

		// Set the generated tree-view javascript
		// to be printed on view file
		$this->set('tree_data', $tree_data);

	}

}
?>
