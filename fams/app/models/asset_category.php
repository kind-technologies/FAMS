<?php
class AssetCategory extends AppModel {

	var $name = 'AssetCategory';

	function get_asset_categories_for_json() {
		$asset_categories = $this->findAll(array('record_status'=>'A'), 
												null, 'AssetCategory.id ASC');
		$asset_categories_data = array();

		foreach($asset_categories as $asset_category) {

			$asset_categories_data[] = array($asset_category['AssetCategory']['id'], 
									$asset_category['AssetCategory']['category_code'], 
									$asset_category['AssetCategory']['name'], 
									$asset_category['AssetCategory']['description'] );
			
		}
		
		return $asset_categories_data;
	}

}
?>
