<?php
class Asset extends AppModel {

	var $name = 'Asset';
	var $belongsTo = array(
				'AssetCategory' => array('className' => 'AssetCategory'),
				'Supplier' => array('className' => 'Supplier')
			);
			
	function get_assets_for_json() {
		$assets = $this->findAll(array('Asset.record_status'=>'A'), 
										null, 'Asset.id ASC');
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
									$asset['Asset']['salvage_value'] );
			
		}
		
		return $assets_data;
	}

}
?>
