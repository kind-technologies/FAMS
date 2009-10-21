<?php
class Asset extends AppModel {

	var $name = 'Asset';
	var $belongsTo = array(
				'AssetCategory' => array('className' => 'AssetCategory'),
				'Supplier' => array('className' => 'Supplier'),
				'Location' => array('className' => 'Location')
			);
	
	function get_assets_for_json($conditions = null) {

		if($conditions == null) {
			$conditions = array('Asset.record_status'=>'A');
		} else {
			$conditions['Asset.record_status'] = 'A';
		}

		$assets = $this->findAll($conditions, null, 'Asset.id ASC');
		$assets_data = array();

		foreach($assets as $asset) {

			$assets_data[] = array($asset['Asset']['id'], 
									$asset['Asset']['asset_code'], 
									$asset['Asset']['short_name'], 
									$asset['Asset']['description'],
									$asset['AssetCategory']['id'],
									$asset['Supplier']['id'], 
									$asset['Asset']['purchase_price'], 
									date( 'm/d/Y', 
										strtotime($asset['Asset']['purchase_date'])), 
									$asset['Asset']['lifespan'], 
									$asset['Asset']['salvage_value'],
									$asset['Supplier'],
									$asset['Location'],
									$asset['Asset']['asset_status']
								);
			
		}
		
		return $assets_data;
	}

	function get_assets_for_json_mini($conditions = null) {
		
		if($conditions == null) {
			$conditions = array('Asset.record_status'=>'A');
		} else {
			$conditions['Asset.record_status'] = 'A';
		}

		$assets = $this->findAll($conditions, null, 'Asset.id ASC');
		$assets_data = array();

		foreach($assets as $asset) {

			$assets_data[] = array($asset['Asset']['id'], 
									$asset['Asset']['asset_code'], 
									$asset['Asset']['short_name'] );
			
		}
		
		return $assets_data;
	}
	
}
?>
