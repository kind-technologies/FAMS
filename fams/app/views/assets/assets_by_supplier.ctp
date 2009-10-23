<?php echo $this->renderElement('common_js_objects'); ?>


<script type="text/javascript" language="javascript">
var btn_popup_supplier = null;
var supplier_name = null;
var supplier_id = null;
var win_supplier;
var supplier_data_store = null;

Ext.onReady(function(){

	var suppliersReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id'},
		{name: 'supplier_code'},
		{name: 'supplier_name'}
	]);	
    
	supplier_data_store =  new Ext.data.Store({
				reader: suppliersReader
			});

	supplier_json = Ext.util.JSON.decode('<?php echo $javascript->object($suppliers_data); ?>');
	supplier_data_store.loadData(supplier_json.suppliers_data);

    grid_supplier = new Ext.grid.GridPanel({
						store: supplier_data_store,
						columns: [
							{header: 'Supplier Code', width: 100, sortable: true, dataIndex: 'supplier_code'},
							{header: 'Supplier Name', width: 310, sortable: true, dataIndex: 'supplier_name'}
						],
						height: 350,
						width: 420
					});
					
    grid_supplier.on('rowdblclick', function(sm, row_index, r) {

					record = grid_supplier.getStore().getAt(row_index);

					splr_name = record.get('supplier_name');
					supplier_id = record.get('rec_id');
					
					supplier_name.setValue(splr_name);
					
					win_supplier.hide(this);

					document.getElementById('hdn_supplier_name').value = splr_name;
					document.getElementById('hdn_supplier_id').value = supplier_id;
					
					document.getElementById('frm_supplier').submit();
				});

    supplier_name = new Ext.form.TextField({
				id: 'supplier_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				width: 300,
				disabled: true,
				renderTo: 'cnt_supplier',
				msgTarget: 'under',
				allowBlank:false,
				value: '<?php echo @$supplier_name; ?>'
    		});

    btn_popup_supplier = new Ext.Button({
							text: '',
							id: 'btn_popup_supplier',
							icon: '/img/data_browser_view.png',
							minWidth: 50,
							renderTo: 'cnt_supplier_btn'
						});
	
	
	btn_popup_supplier.on('click', function() {
        // create the window on the first click and reuse on subsequent clicks
        if(!win_supplier){
            win_supplier = new Ext.Window({
                applyTo:'cnt_supplier_browser',
                layout:'fit',
                width:450,
                height:200,
                closeAction:'hide',
                plain: true,
				title: 'Suppliers Browser',
                items: grid_supplier
            });
        }
        win_supplier.show(this);
    });


});

</script>


<div style="background-color:#d3e1f1" id="fields_div">
    <div align="center" style="padding: 10px 0px 10px 0px;">
    	<form id="frm_supplier" method="post" action="/assets/assets_by_supplier">
			<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
				<tr>
					<td width="50px">
						<input type="hidden" id="hdn_supplier_id" name="hdn_supplier_id">
						<input type="hidden" id="hdn_supplier_name" name="hdn_supplier_name">
					</td>
					<td width="150px"> Supplier	</td>
					<td id="cnt_supplier" width="300px"><!-- supplier name container--></td>
					<td id="cnt_supplier_btn"><!-- supplier load button container--></td>
				</tr>
			</table>
		</form>
	</div>
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<?php 
		
		if($rpt_status === 1) {
			foreach($asset_list as $asset) { 
		?>
			<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px">
				<tr>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Asset Code
					</td>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Name
					</td>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Location
					</td>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Status
					</td>
				</tr>
				<!--data-->
				<tr>
					<td style="background-color:#ffffff">
						<?php echo $asset[1]; ?>
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[2]; ?>
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[11]['location_code']; ?>
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[12]; ?>
					</td>
				</tr>
				<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
				<tr>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Purchase Date
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[7]; ?>
					</td>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Purchased Price
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[6]; ?>
					</td>
				</tr>
				<tr>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Lifespan
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[8]; ?> (Months)
					</td>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Salvage Value
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[9]; ?>
					</td>
				</tr>
				<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			</table>
		<?php
			}
		} elseif ($rpt_status === 2) {
		?>
			<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
				<tr>
					<td width="150px" align="center"> No data found </td>
				</tr>
			</table>		
		<?php
		} else {
		?>
			<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
				<tr>
					<td width="150px" align="center"> Please select a supplier category.</td>
				</tr>
			</table>	
		<?php
		}
		?>
		
	</div>
</div>

<div id="cnt_supplier_browser" class="x-hidden"><!-- supplier browser container--></div>


