<?php echo $this->renderElement('common_js_objects'); ?>


<script type="text/javascript" language="javascript">
var btn_popup_custodian = null;
var custodian_name = null;
var custodian_id = null;
var win_custodian;
var custodian_data_store = null;

Ext.onReady(function(){

	var custodiansReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id'},
		{name: 'custodian_id'},
		{name: 'custodian_name'}
	]);	
    
	custodian_data_store =  new Ext.data.Store({
				reader: custodiansReader
			});

	custodians_json = Ext.util.JSON.decode('<?php echo $javascript->object($employee_data); ?>');
	custodian_data_store.loadData(custodians_json.employee_data);

    grid_custodian = new Ext.grid.GridPanel({
						store: custodian_data_store,
						columns: [
							{header: 'Employee ID', width: 100, sortable: true, dataIndex: 'custodian_id'},
							{header: 'Name', width: 310, sortable: true, dataIndex: 'custodian_name'}
						],
						height: 350,
						width: 420
					});
					
    grid_custodian.on('rowdblclick', function(sm, row_index, r) {

					record = grid_custodian.getStore().getAt(row_index);

					cstdn_name = record.get('custodian_name');
					custodian_id = record.get('rec_id');
					
					custodian_name.setValue(cstdn_name);
					
					win_custodian.hide(this);

					document.getElementById('hdn_custodian_name').value = cstdn_name;
					document.getElementById('hdn_custodian_id').value = custodian_id;
					
					document.getElementById('frm_custodian').submit();
				});

    custodian_name = new Ext.form.TextField({
				id: 'custodian_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				width: 300,
				disabled: true,
				renderTo: 'cnt_custodian',
				msgTarget: 'under',
				allowBlank:false,
				value: '<?php echo @$custodian_name; ?>'
    		});

    btn_popup_custodian = new Ext.Button({
							text: '',
							id: 'btn_popup_custodian',
							icon: '/img/data_browser_view.png',
							minWidth: 50,
							renderTo: 'cnt_custodian_btn'
						});
	
	
	btn_popup_custodian.on('click', function() {
        // create the window on the first click and reuse on subsequent clicks
        if(!win_custodian){
            win_custodian = new Ext.Window({
                applyTo:'cnt_custodian_browser',
                layout:'fit',
                width:450,
                height:200,
                closeAction:'hide',
                plain: true,
				title: 'Employee Browser',
                items: grid_custodian
            });
        }
        win_custodian.show(this);
    });


});

</script>


<div style="background-color:#d3e1f1" id="fields_div">
    <div align="center" style="padding: 10px 0px 10px 0px;">
    	<form id="frm_custodian" method="post" action="/assets/assets_by_custodian">
			<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
				<tr>
					<td width="50px">
						<input type="hidden" id="hdn_custodian_id" name="hdn_custodian_id">
						<input type="hidden" id="hdn_custodian_name" name="hdn_custodian_name">
					</td>
					<td width="150px"> Custodian </td>
					<td id="cnt_custodian" width="300px"><!-- custodian name container--></td>
					<td id="cnt_custodian_btn"><!-- custodian load button container--></td>
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
					<td width="150px" align="center"> Please select an asset category.</td>
				</tr>
			</table>	
		<?php
		}
		?>
		
	</div>
</div>

<div id="cnt_custodian_browser" class="x-hidden"><!--asset category browser container--></div>


