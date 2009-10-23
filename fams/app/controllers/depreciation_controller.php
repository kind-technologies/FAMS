<?php
class DepreciationController extends AppController {

	var $name = 'Depreciation';
	var $components = array('Auth', 'Depreciation');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Asset', 'AssetCategory');
	
	function depreciation_report_yearly() {
		Configure::write('debug', 0);
	
		// Pickup asset categories for category browser grid
		$asset_categories_data = 
							$this->AssetCategory->get_asset_categories_for_json();
		$this->set('asset_categories_data', 
				array('asset_categories_data' => $asset_categories_data));
	}

	function depreciation_report_browsers() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';

		$request_type = $this->params['form']['request_type'];
		$type_id = $this->params['form']['type_id'];

		// If type is asset browser : A
		if($request_type == 'A') {
			$conditions = array('Asset.asset_category_id' => $type_id,
									'Asset.asset_status' => 'ASN');
									
			$asset_data = $this->Asset->get_assets_for_json_mini($conditions);
			$this->set('grid_data', $asset_data);
			$this->set('request_type', $request_type);
		}
		
		// If type is asset data : D
		if($request_type == 'D') {

			$conditions = array('Asset.id' => $type_id);
			$fields = array('id', 'asset_code', 'short_name', 'description',
							'purchase_price', 'purchase_date', 'lifespan', 
							'salvage_value', 'commencement_date', 'asset_status'
							);
			
			$asset = $this->Asset->find($conditions, $fields, 'Asset.id ASC', 4);

			$asset_data = array();

			$this->Depreciation->purchase_price = $asset['Asset']['purchase_price'];
			$this->Depreciation->salvage_value = $asset['Asset']['salvage_value'];
			$this->Depreciation->lifespan = $asset['Asset']['lifespan'];
			$this->Depreciation->asset_commencement_year = date( 'Y', 
									strtotime($asset['Asset']['commencement_date']));
			
			$this->Depreciation->asset_commencement_month = date( 'M', 
									strtotime($asset['Asset']['commencement_date']));
			$asset_data[] = array('id' => $asset['Asset']['id'], 
					'asset_code' => $asset['Asset']['asset_code'], 
					'asset_desc' => $asset['Asset']['description'],
					'cur_date' => date('m/d/Y'),
					'com_date' => date( 'm/d/Y', 
									strtotime($asset['Asset']['commencement_date'])),
					'anl_depr' => $this->Depreciation->get_annual_depreciation(),
										
					'org_cost' => $asset['Asset']['purchase_price'],
					'cur_tot_depr' => $this->Depreciation->get_total_depreciation(),
					'nbv' => $this->Depreciation->get_net_book_value(),
					'lifespan' => $asset['Asset']['lifespan'],
					'sal_val' => $asset['Asset']['salvage_value']
				);

			$asset_data[0]['chart_data'] = $this->Depreciation->get_depr_chart_data();

			$this->set('grid_data', $asset_data);
			$this->set('request_type', $request_type);
		}
	}
	function depreciation_info() {
		Configure::write('debug', 0);
	
		// Pickup asset categories for category browser grid
		$asset_categories_data = 
							$this->AssetCategory->get_asset_categories_for_json();
		$this->set('asset_categories_data', 
				array('asset_categories_data' => $asset_categories_data));
		

		$this->set('graph_data', 
				array('graph_data' => $graph_data));
				
	}
}
?>
