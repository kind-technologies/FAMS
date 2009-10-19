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
	
	var categoriesReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id'},
		{name: 'category_code'},
		{name: 'category_name'},
		{name: 'category_description'}
	]);	
	
	
	grid_data_store =  new Ext.data.Store({
				reader: categoriesReader
			});


	asset_categories_json = Ext.util.JSON.decode('<?php echo $javascript->object($asset_categories_data); ?>');
	grid_data_store.loadData(asset_categories_json.asset_categories_data);

	grid = new Ext.grid.GridPanel({
			store: grid_data_store,
			columns: [
				{header: 'Category Code', width: 120, sortable: true, dataIndex: 'category_code'},
				{header: 'Name', width: 280, sortable: true, dataIndex: 'category_name'},
				{header: 'Description', width: 400, sortable: true, dataIndex: 'category_description'}
			],
			viewConfig: {
				forceFit: true,
			 	fitContainer: true
			},
			sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
			renderTo: 'grid_area',
			title: 'Asset Categories',
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
		category_code.setValue(r.data['category_code']);
		category_name.setValue(r.data['category_name']);
		category_description.setValue(r.data['category_description']);
		
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
            {contentEl:'tab1', title: 'Category Details'}
        ],
        viewConfig: {
			forceFit: true,
		 	fitContainer: true
		},
		height: 260
    });

});
</script>
<script type="text/javascript" language="javascript">
/*
 * Form fields
 */
		
var category_code = null;
var category_name = null;
var category_description = null;

var rec_id = null;
var action = null;

var status_div = null;


Ext.onReady(function(){
    category_code = new Ext.form.TextField({
    			id: 'txt_category_code',
    			validateOnBlur: true,
    			invalidText: 'The value in this field is invalid',
    			maxLength : 5,
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_category_code',
    		    msgTarget: 'under',
    		    allowBlank:false
    });

    category_name = new Ext.form.TextField({
    			id: 'txt_category_name',
    			validateOnBlur: true,
    			invalidText: 'The value in this field is invalid',
    			maxLength : 20,
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_category_name',
    		    msgTarget: 'under',
    		    allowBlank:false
    });

	category_description = new Ext.form.TextArea({
    			id: 'txt_category_description',
    			width: 400,
    			disabled: true,
    		    renderTo: 'cnt_category_description',
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
									url: '/asset_categories/asset_category_update',
									params: { 
										id: rec_id.getValue(),
										action: action.getValue()
									},
									callback : function(options, success, response) { 
										obj = Ext.util.JSON.decode(response.responseText);
										grid_data_store.loadData(obj.asset_categories_data);
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
				   url: '/asset_categories/asset_category_update',
				   params: { 
				   			category_code: category_code.getValue(), 
				   			category_name: category_name.getValue(),
				   			category_description: category_description.getValue(),
				   			id: rec_id.getValue(),
				   			action: action.getValue()
		   			},
				   callback : function(options, success, response) { 
				   				obj = Ext.util.JSON.decode(response.responseText);
				   				grid_data_store.loadData(obj.asset_categories_data);

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
		category_code.setValue(''); category_code.clearInvalid();
		category_name.setValue(''); category_name.clearInvalid();
		category_description.setValue(''); category_description.clearInvalid();

		rec_id.setValue('');
		action.setValue('');
	}

	function disable_fields(bool) {
		category_code.setDisabled(bool);
		category_name.setDisabled(bool);
		category_description.setDisabled(bool);
	}
	
	function display_message(text) {
		status_div.highlight("ffffff");		
		status_div.insertHtml("beforeEnd", text);
		setTimeout("status_div.dom.innerHTML=''", 5000);
	}
	
	function is_form_valid() {
		
		return (category_code.validate() &&
					category_name.validate() &&
					category_description.validate() );

	}
</script>
<div id="status_div"></div>
<div id="grid_area" style="width:100%"></div>
<div id="fields_div" style="margin-top:5px">
    <div id="tab1" align="center"> 
					<table border="0"  >
						<tr>
							<td width="150px" style="height:40px" colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td width="150px">Category Code</td>
							<td width="5px">:</td>
							<td colspan="4" id="cnt_category_code"><!-- category code --></td>
						</tr>
						<tr>
							<td valign="top">Category Name</td>
							<td valign="top" width="5px">:</td>
							<td colspan="4" id="cnt_category_name"><!-- category name --></td>
						</tr>
						<tr>
							<td valign="top">Description</td>
							<td valign="top" width="5px">:</td>
							<td colspan="4" id="cnt_category_description"><!-- category description --></td>
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
    </div> 
</div>

<?php echo $this->renderElement('command_buttons'); ?>

