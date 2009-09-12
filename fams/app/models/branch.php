<?php
class Branch extends AppModel {

	var $name = 'Branch';

	function get_branches_for_json() {
		$branches = $this->findAll(null, null, 'Branch.id ASC');
		$branches_data = array();

		foreach($branches as $branch) {

			$branches_data[] = array($branch['Branch']['id'], 
									$branch['Branch']['branch_code'], 
									$branch['Branch']['description'] );
			
		}
		
		return $branches_data;
	}
}
?>
