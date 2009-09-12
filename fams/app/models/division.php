<?php
class Division extends AppModel {

	var $name = 'Division';
	
	function get_divisions_for_json() {
		$divisions = $this->findAll(null, null, 'Division.id ASC');
		$divisions_data = array();

		foreach($divisions as $division) {

			$divisions_data[] = array($division['Division']['id'], 
									$division['Division']['division_code'], 
									$division['Division']['description'] );
			
		}
		
		return $divisions_data;
	}
}
?>
