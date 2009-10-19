<?php
class Location extends AppModel {

	var $name = 'Location';

	var $belongsTo = array(
				'Branch' => array('className' => 'Branch')
			);
	
	function get_locations_for_json() {
		$locations = $this->findAll(array('Location.record_status'=>'A'), 
													null, 'Location.id ASC');
		$locations_data = array();

		foreach($locations as $location) {

			$locations_data[] = array($location['Location']['id'], 
									$location['Location']['location_code'], 
									$location['Location']['description'],
									$location['Branch']['id'] );
			
		}
		
		return $locations_data;
	}
	
	function get_locations_for_json_mini($conditions = null) {
	
		if($conditions == null) {
			$conditions = array('Location.record_status'=>'A');
		} else {
			$conditions['Location.record_status'] = 'A';
		}
	
		$locations = $this->findAll($conditions, null, 'Location.id ASC');
		$locations_data = array();

		foreach($locations as $location) {

			$locations_data[] = array($location['Location']['id'], 
									$location['Location']['location_code'], 
									$location['Location']['description']);
			
		}
		
		return $locations_data;
	}

}
?>
