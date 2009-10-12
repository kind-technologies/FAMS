<?php echo $this->renderElement('common_js_objects'); ?>

<script type="text/javascript" language="javascript">
/*
 * Grid Area
 */
var grid = null;
var current_row_index = 0;

var grid_data_store = null;

var tabs = null;

Ext.onReady(function() {
	
	// Sample data set, replaced with data from DB
	
	var locationsReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id'},
		{name: 'location_code'},
		{name: 'location_description'},
		{name: 'emp_branch_id'}
	]);	
	
	
	grid_data_store =  new Ext.data.Store({
				reader: locationsReader
			});


	locations_json = Ext.util.JSON.decode('<?php echo $javascript->object($locations_data); ?>');
	grid_data_store.loadData(locations_json.locations_data);

	
	grid = new Ext.grid.GridPanel({
			store: grid_data_store,
			columns: [
				{header: 'Location Code', width: 120, sortable: true, dataIndex: 'location_code'},
				{header: 'Description', width: 680, sortable: true, dataIndex: 'location_description'}
			],
			viewConfig: {
				forceFit: true,
			 	fitContainer: true
			},
			sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
			renderTo: 'grid_area',
			title: 'Locations',
			/*width: 700,*/
			height: 190,
			autoHeight: false,
			frame: true
	});
	
	if(Ext.isIE) {
		 grid.setWidth(700);
	}
	
	//grid.getSelectionModel().selectFirstRow();
	
	grid.getSelectionModel().on('rowselect', function(sm, row_index, r) {
		location_code.setValue(r.data['location_code']);
		location_description.setValue(r.data['location_description']);
		location_branch.setValue(r.data['emp_branch_id'], true);

		rec_id.setValue(r.data['rec_id'], true);
		current_row_index = row_index;
	});

});
</script>
<script type="text/javascript" language="javascript">
/*
 * Tab area
 */

Ext.onReady(function(){

    tabs = new Ext.TabPanel({
        renderTo: 'fields_div',
        id:'tab_panel',
        activeTab: 0,
        frame: true,
        deferredRender: false,
        defaults:{autoHeight: true},
        items:[
            {contentEl:'tab1', title: 'Company Locations'}
        ],
        viewConfig: {
			forceFit: true,
		 	fitContainer: true
		},
		height: 240
    });

});
</script>
<script type="text/javascript" language="javascript">
/*
 * Form fields
 */

var location_code = null;
var location_description = null;
var location_branch = null;

var rec_id = null;
var action = null;

var status_div = null;


Ext.onReady(function(){
    location_code = new Ext.form.TextField({
    			id: 'txt_location_code',
    			validateOnBlur: true,
    			invalidText: 'The value in this field is invalid',
    			maxLength : 5,
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_location_code',
    		    msgTarget: 'under',
    		    allowBlank:false
    });

	location_description = new Ext.form.TextArea({
    			id: 'txt_description',
    			width: 600,
    			disabled: true,
    		    renderTo: 'cnt_description',
    		    allowBlank:false
    });


	// Get the data for branch selection drop down list
	branch_json = Ext.util.JSON.decode('<?php echo $javascript->object($branch_data); ?>');
	
	location_branch = new Ext.form.ComboBox({
    			id: 'txt_branch',
    			width: 200,
    			disabled: true,
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
    		    allowBlank:false
    });

	rec_id = new Ext.form.Hidden({
    			id: 'hdn_rec_id',
    		    renderTo: 'cnt_hdn_rec_id'
    });
    
	action = new Ext.form.Hidden({
    			id: 'hdn_action',
    		    renderTo: 'cnt_hdn_action'
    });
    
	status_div = Ext.get('status_div');
	
});

</script>

<script type="text/javascript" language="javascript">
/*
 * Event handlers for buttons
 */

	function add() {
		
		// Enable/Disable fields accodingly
		clear();
		disable_fields(false);
		btn_add.setDisabled(true);
		btn_edit.setDisabled(true);
		btn_delete.setDisabled(true);
		btn_save.setDisabled(false);
		grid.setDisabled(true);
		
		// Set form action to add
		rec_id.setValue('');
		action.setValue('__a');
	}
	
	function edit() {
		disable_fields(false);
		btn_add.setDisabled(true);
		btn_edit.setDisabled(true);
		btn_delete.setDisabled(true);
		btn_save.setDisabled(false);
		grid.setDisabled(true);
		action.setValue('__e');
	}

	function del() {
		action.setValue('__d');
		btn_add.setDisabled(true);
		btn_edit.setDisabled(true);
		btn_delete.setDisabled(true);
		
		Ext.MessageBox.confirm("FAMS", "Do you want to delete this record?", 
									function(btn){
										if(btn == "yes") {
											ajaxClass.request({
														url: '/org_setup/location_update',
														params: { 
															id: rec_id.getValue(),
															action: action.getValue()
														},
														callback : function(options, success, response) { 
															obj = Ext.util.JSON.decode(response.responseText);
															grid_data_store.loadData(obj.location_data);
															display_message("Record deleted successfully");
															cancel();
															grid.getSelectionModel().selectFirstRow();
														}
												});
										} else {
											cancel();
											grid.getSelectionModel().selectRow(current_row_index);
										}
										
									});

	}

	function save() {

		// Validate fields before submit
		if(!is_form_valid()) {
			Ext.MessageBox.alert("FAMS", "Please check the values you have entered.");
			return false;
		}

		ajaxClass.request({
				   url: '/org_setup/location_update',
				   params: { 
				   			location_code: location_code.getValue(), 
				   			location_description: location_description.getValue(),
				   			location_branch: location_branch.getValue(),
				   			id: rec_id.getValue(),
				   			action: action.getValue()
		   			},
					callback : function(options, success, response) { 
				   				obj = Ext.util.JSON.decode(response.responseText);
				   				grid_data_store.loadData(obj.location_data);
				   				display_message("Record saved successfully");
				   				
				   				act = action.getValue();
				   														
				   				cancel();
				   				
				   				if(act == '__e') {
									grid.getSelectionModel().selectRow(current_row_index);
								} else if(act == '__a') {
									grid.getSelectionModel().selectLastRow();
									idx = grid.store.indexOf(grid.getSelectionModel().getSelected());
									grid.getView().focusRow(idx);
								}
		   			}
				});
		
	}
	
	function cancel() {
		clear();
		grid.getSelectionModel().deselectRow(current_row_index);
		disable_fields(true);
		grid.setDisabled(false);
	}

	
	// Clear all text fields and error messages
	function clear() {
		location_code.setValue(''); location_code.clearInvalid();
		location_description.setValue(''); location_description.clearInvalid();
		location_branch.setValue(''); location_branch.clearInvalid();
		
		rec_id.setValue('');
		action.setValue('');
	}

	function disable_fields(bool) {
		location_code.setDisabled(bool);
		location_description.setDisabled(bool);
		location_branch.setDisabled(bool);
	}
	
	function display_message(text) {
		status_div.highlight("ffffff");		
		status_div.insertHtml("beforeEnd", text);
		setTimeout("status_div.dom.innerHTML=''", 5000);
	}
	
	function is_form_valid() {
		
		return (location_code.validate() &&
					location_description.validate() );

	}
</script>
<div align="right" id="top_links">
	<?php echo $html->link('Branches', '/org_setup/branch_view'); ?> | 
	<?php echo $html->link('Divisions', '/org_setup/division_view'); ?> | 
	<?php echo $html->link('Locations', '/org_setup/location_view'); ?>
</div>
<div id="status_div"></div>
<div id="grid_area" style="width:100%"></div>
<div id="fields_div" style="margin-top:5px">
    <div id="tab1" align="center"> 
    		<table border="0">
    			<tr>
				<td style="height:30;">&nbsp;</td>
			</tr>
			<tr>
				<td style="background-color:#d3e1f1">
					<table border="0"  >
						
						<tr>
							<td width="100px">Location Code</td>
							<td width="5px">:</td>
							<td colspan="4" id="cnt_location_code"><!-- branch code --></td>
						</tr>
						<tr>
							<td valign="top">Description</td>
							<td valign="top" width="5px">:</td>
							<td colspan="4" id="cnt_description"><!-- description --></td>
						</tr>
						<tr>
							<td>Branch</td>
							<td width="5px">:</td>
							<td colspan="4" id="cnt_branch"><!-- branch (ext gen.) --></td>
						</tr>
						<tr>
							<td></td>
							<td width="5px"></td>
							<td id="cnt_hdn_rec_id"><!-- hidden field employee record id (ext gen.) --></td>
							<td></td>
							<td></td>
							<td id="cnt_hdn_action"><!-- hidden field action (ext gen.) --></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
    </div> 

</div>

<?php echo $this->renderElement('command_buttons'); ?>

