<?php

class DepreciationComponent extends Object {

	var $purchase_price = 0;
	var $salvage_value = 0;
	var $lifespan = 0;
	var $asset_commencement_year = 0;


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
}

?>
