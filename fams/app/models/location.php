<?php
class Location extends AppModel {

	var $name = 'Location';

	var $belongsTo = array(
				'Branch' => array('className' => 'Branch')
			);
	
	function get_locations_for_json() {
		$locations = $this->findAll(null, null, 'Location.id ASC');
		$locations_data = array();

		foreach($locations as $location) {

			$locations_data[] = array($location['Location']['id'], 
									$location['Location']['location_code'], 
									$location['Location']['description'],
									$location['Branch']['id'] );
			
		}
		
		return $locations_data;
	}
}
?>
