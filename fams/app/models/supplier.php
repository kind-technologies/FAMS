<?php
class Supplier extends AppModel {

	var $name = 'Supplier';

	function get_suppliers_for_json() {
		$suppliers = $this->findAll(array('record_status'=>'A'), 
													null, 'Supplier.id ASC');
		$suppliers_data = array();

		foreach($suppliers as $supplier) {

			$suppliers_data[] = array($supplier['Supplier']['id'], 
									$supplier['Supplier']['supplier_code'], 
									$supplier['Supplier']['description'], 
									$supplier['Supplier']['address'], 
									$supplier['Supplier']['contact_number'], 
									$supplier['Supplier']['email'] );
			
		}
		
		return $suppliers_data;
	}

}
?>
