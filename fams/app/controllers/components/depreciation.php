<?php

class DepreciationComponent extends Object {

	var $purchase_price = 0;
	var $salvage_value = 0;
	var $lifespan = 0;
	var $asset_commencement_year = 0;
	var $asset_commencement_month = '';

	// Method to caluculate anual depreciation
    function get_annual_depreciation() {
        return number_format(($this->purchase_price - $this->salvage_value) / 
        												($this->lifespan / 12), 2);
    }
    
    function get_total_depreciation() {
    //anl dep * (cur yr - com yr)
    		return number_format($this->get_annual_depreciation() * (date('Y') - 
    												$this->asset_commencement_year), 2);
    }
    
    function get_net_book_value() {
    //org cost - cur dep
    		return number_format(($this->purchase_price - $this->get_total_depreciation()), 2);
    }
    
    function get_depr_chart_data() {
		
		$number_years_in_use = ($this->lifespan) / 12;
		$chart_data = array();
		
		$depreciation_amt = $this->get_annual_depreciation();
		
		for($i= 0; $i < $number_years_in_use; $i++) {
			$year_value = $this->asset_commencement_month . 
									' ' . ($this->asset_commencement_year + $i);
			$accumulate_val  = $depreciation_amt + ($depreciation_amt * $i);
			$depre_val = ($this->purchase_price) - $accumulate_val;
		
			$chart_data[] = array($year_value, $accumulate_val, $depre_val); 		
		}

		//$chart_data[] = array('Jul 08', 6000, 14000); 
		//$chart_data[] = array('Jul 09', 9000, 11000); 

		return $chart_data;
    }
}

?>
