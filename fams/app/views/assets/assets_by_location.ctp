<?php echo $this->renderElement('common_js_objects'); ?>


<script type="text/javascript" language="javascript">
var btn_popup_location = null;
var location_name = null;
var location_id = null;
var win_location;
var location_data_store = null;

var branch = null;

Ext.onReady(function(){

	var locationsReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id'},
		{name: 'location_code'},
		{name: 'location_name'}
	]);	
    
	location_data_store =  new Ext.data.Store({
				reader: locationsReader
			});

    grid_location = new Ext.grid.GridPanel({
						store: location_data_store,
						columns: [
							{header: 'Location Code', width: 100, sortable: true, dataIndex: 'location_code'},
							{header: 'Name', width: 310, sortable: true, dataIndex: 'location_name'}
						],

						height: 350,
						width: 420
					});
					
    grid_location.on('rowdblclick', function(sm, row_index, r) {
					record = grid_location.getStore().getAt(row_index);
					loc_name = record.get('location_name');

					location_name.setValue(loc_name);
					location_id = record.get('rec_id');
					
					win_location.hide(this);
					
					// Branch value
					document.getElementById('hdn_branch_id').value = branch.getValue();
					
					// Location
					document.getElementById('hdn_ast_loc_id').value = location_id;
					document.getElementById('hdn_ast_loc_name').value = loc_name;

					document.getElementById('frm_ast_loc').submit();
				});


    location_name = new Ext.form.TextField({
				id: 'location_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				width: 300,
				disabled: true,
				renderTo: 'cnt_location_name',
				msgTarget: 'under',
				allowBlank:false,
				style: 'margin:1px',
				value: '<?php echo @$ast_loc_name;?>'
    		});

    btn_popup_location = new Ext.Button({
							text: '',
							id: 'btn_popup_location',
							disabled: true,
							icon: '/img/data_browser_view.png',
							minWidth: 50,
							renderTo: 'cnt_location_btn',
							style: 'margin:0px'
						});
	
	
	btn_popup_location.on('click', function() {
        
        // create the window on the first click and reuse on subsequent clicks
        if(!win_location){
            win_location = new Ext.Window({
                applyTo:'cnt_location_browser',
                layout:'fit',
                width:450,
                height:200,
                closeAction:'hide',
                plain: true,
				title: 'Location Browser',
                items: grid_location
            });
        }
        
        // Load data for grid before popup the browser
		get_data_for_browser('L', branch.getValue(), location_data_store);
        //win_location.show(this);
    });


	// Get the data for branch selection drop down list
	branch_json = Ext.util.JSON.decode('<?php echo $javascript->object($branch_data); ?>');
	
	branch = new Ext.form.ComboBox({
    			id: 'txt_branch',
    			width: 200,
    			disabled: false,
    			editable: false,
    			store: new Ext.data.SimpleStore({
									fields:['bid', 'branch_code', 'description'],
									data: branch_json.branch_data // Set branch data from json string
									}),
				valueField: 'bid',
				displayField:'branch_code',
				forceSelection: true,
				mode: 'local',
				triggerAction: 'all',
    		    renderTo: 'cnt_branch',
    		    value: '<?php echo @$branch_id;?>'
    });

	branch.on('select', function() {
					btn_popup_location.enable();
					location_name.setValue('');
				});
});

</script>

<script>
function get_data_for_browser(request_type, type_id, grid_data_store) {
	ajaxClass.request({
			   url: '/assets/asset_allocation_browsers',
			   params: { 
			   			request_type: request_type,
			   			type_id: type_id
	   			},
			   callback : function(options, success, response) { 
			   				obj = Ext.util.JSON.decode(response.responseText);
			   				grid_data_store.loadData(obj.grid_data);
			   				
			   				// If request is for asset browser
		   					win_location.show();
	   			}
			});
}
</script>


<div style="background-color:#d3e1f1" id="fields_div">
    <div align="center" style="padding: 10px 0px 10px 0px;">
    	<form id="frm_ast_loc" method="post" action="/assets/assets_by_location">
			<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
				<tr>
						<td width="10%">&nbsp;
							<input type="hidden" id="hdn_branch_id" name="hdn_branch_id">
						</td>
						<td width="22%">Branch</td>
						<td width="20%" id="cnt_branch"><!-- branch container--></td>
						<td></td>
				</tr>
				<tr>
						<td width="10%">&nbsp;
							<input type="hidden" id="hdn_ast_loc_id" name="hdn_ast_loc_id">
							<input type="hidden" id="hdn_ast_loc_name" name="hdn_ast_loc_name">
						</td>
						<td>Location</td>
						<td id="cnt_location_name" style="padding:2px;height:10px"><!-- location container--></td>
						<td id="cnt_location_btn" style="padding:0px;height:10px"></td>
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
					<td width="150px" align="center"> Please select a company location.</td>
				</tr>
			</table>	
		<?php
		}
		?>
		
	</div>
</div>

<div id="cnt_location_browser" class="x-hidden"><!-- location browser container--></div>


