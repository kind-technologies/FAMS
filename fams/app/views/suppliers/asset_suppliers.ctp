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
	
	var suppliersReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id'},
		{name: 'supplier_code'},
		{name: 'description'},
		{name: 'address'},
		{name: 'contact_number'},
		{name: 'email'}
	]);	
	
	
	grid_data_store =  new Ext.data.Store({
				reader: suppliersReader
			});


	suppliers_json = Ext.util.JSON.decode('<?php echo $javascript->object($suppliers_data); ?>');
	grid_data_store.loadData(suppliers_json.suppliers_data);

	
	grid = new Ext.grid.GridPanel({
			store: grid_data_store,
			columns: [
				{header: 'Supplier Code', width: 120, sortable: true, dataIndex: 'supplier_code'},
				{header: 'Description', width: 280, sortable: true, dataIndex: 'description'},
				{header: 'Contact Number', width: 150, sortable: true, dataIndex: 'contact_number'},
				{header: 'Email', width: 150, sortable: true, dataIndex: 'email'}
			],
			viewConfig: {
				forceFit: true,
			 	fitContainer: true
			},
			sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
			renderTo: 'grid_area',
			title: 'Suppliers',
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
		supplier_code.setValue(r.data['supplier_code']);
		description.setValue(r.data['description']);
		address.setValue(r.data['address']);
		contact_number.setValue(r.data['contact_number']);
		email.setValue(r.data['email']);
		
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
            {contentEl:'tab1', title: 'Supplier Details'}
        ],
        viewConfig: {
			forceFit: true,
		 	fitContainer: true
		},
		height: 280
    });

});
</script>
<script type="text/javascript" language="javascript">
/*
 * Form fields
 */

var supplier_code = null;
var description = null;
var address = null;
var contact_number = null;
var email = null;

var rec_id = null;
var action = null;

var status_div = null;


Ext.onReady(function(){
    supplier_code = new Ext.form.TextField({
    			id: 'txt_supplier_code',
    			validateOnBlur: true,
    			invalidText: 'The value in this field is invalid',
    			maxLength : 5,
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_supplier_code',
    		    msgTarget: 'under',
    		    allowBlank:false
    });

	description = new Ext.form.TextArea({
    			id: 'txt_description',
    			width: 600,
    			disabled: true,
    		    renderTo: 'cnt_description',
    		    allowBlank:false
    });

	address = new Ext.form.TextField({
    			id: 'txt_address',
    			width: 600,
    			disabled: true,
    		    renderTo: 'cnt_address',
    		    allowBlank:false
    });

	contact_number = new Ext.form.TextField({
    			id: 'txt_contact_number',
    			width: 600,
    			disabled: true,
    		    renderTo: 'cnt_contact_number',
    		    allowBlank:false
    });
    
    	email = new Ext.form.TextField({
    			id: 'txt_email',
    			width: 600,
    			disabled: true,
    		    renderTo: 'cnt_email',
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
									url: '/suppliers/asset_suppliers_update',
									params: { 
										id: rec_id.getValue(),
										action: action.getValue()
									},
									callback : function(options, success, response) { 
										obj = Ext.util.JSON.decode(response.responseText);
										grid_data_store.loadData(obj.suppliers_data);
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
				   url: '/suppliers/asset_suppliers_update',
				   params: { 
				   			supplier_code: supplier_code.getValue(), 
				   			description: description.getValue(),
				   			address: address.getValue(),
				   			contact_number: contact_number.getValue(),
				   			email: email.getValue(),
				   			id: rec_id.getValue(),
				   			action: action.getValue()
		   			},
				   callback : function(options, success, response) { 
				   				obj = Ext.util.JSON.decode(response.responseText);
				   				grid_data_store.loadData(obj.suppliers_data);

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
		supplier_code.setValue(''); supplier_code.clearInvalid();
		description.setValue(''); description.clearInvalid();
		address.setValue(''); address.clearInvalid();
		contact_number.setValue(''); contact_number.clearInvalid();
		email.setValue(''); email.clearInvalid();

		rec_id.setValue('');
		action.setValue('');
	}

	function disable_fields(bool) {
		supplier_code.setDisabled(bool);
		description.setDisabled(bool);
		address.setDisabled(bool);
		contact_number.setDisabled(bool);
		email.setDisabled(bool);
	}
	
	function display_message(text) {
		status_div.highlight("ffffff");		
		status_div.insertHtml("beforeEnd", text);
		setTimeout("status_div.dom.innerHTML=''", 5000);
	}
	
	function is_form_valid() {
		
		return (supplier_code.validate() &&
					description.validate() &&
					address.validate() &&
					contact_number.validate() &&
					email.validate() );

	}
</script>

<div id="status_div"></div>
<div id="grid_area" style="width:100%"></div>
<div id="fields_div" style="margin-top:5px">
    <div id="tab1" align="center"> 
			<table border="0"  >
				<tr>
					<td width="100px">Supplier Code</td>
					<td width="5px">:</td>
					<td colspan="4" id="cnt_supplier_code"><!-- supplier code --></td>
				</tr>
				<tr>
					<td valign="top">Description</td>
					<td valign="top" width="5px">:</td>
					<td colspan="4" id="cnt_description"><!-- description --></td>
				</tr>
				<tr>
					<td valign="top">Address</td>
					<td valign="top" width="5px">:</td>
					<td colspan="4" id="cnt_address"><!-- address --></td>
				</tr>
				<tr>
					<td valign="top">Contact Number</td>
					<td valign="top" width="5px">:</td>
					<td colspan="4" id="cnt_contact_number"><!-- contact number --></td>
				</tr>
				<tr>
					<td valign="top">Email</td>
					<td valign="top" width="5px">:</td>
					<td colspan="4" id="cnt_email"><!-- email --></td>
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

