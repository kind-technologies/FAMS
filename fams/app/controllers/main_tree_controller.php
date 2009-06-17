<?php
/* FILE Id: home_controller.php */

/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 20:16:01 -0600 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class MainTreeController extends AppController {

	var $name = 'MainTree';
	var $uses = array('SystemMenu');
	var $components = array('Auth');
	var $helpers = array('Html', 'Javascript');

	
	function index() {
		Configure::write('debug', 0);
	}
	
	function tree_view() {

		Configure::write('debug', 0);

		$this->layout = 'ajax';

		$menu_data = $this->SystemMenu->findAll('parent_id=0', null, 'order asc');

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
				$tree_data .= '		{
										id: ' . $child['SystemMenu']['id'] . ',
										program_name: \''. $child['SystemMenu']['program_name'] .'\',
										text: \''. $child['SystemMenu']['title'] .'\',
										leaf: true
									},
							  ';
			endforeach;	

			$tree_data .= '
							]
						},';

		endforeach;

		$tree_data .= ']';



		$this->set('tree_data', $tree_data);

	}

}
?>
