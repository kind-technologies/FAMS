<?php echo $this->renderElement('common_js_objects'); ?>

<script type="text/javascript" language="javascript">

/* Employee Browser Script for first tab */

var btn_popup_employee = null;
var employee_name = null;
var employee_id = null;
var win_employee;
var employee_data_store = null;

Ext.onReady(function(){


	var employeesReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id'},
		{name: 'employee_id'},
		{name: 'employee_name'}
	]);	
    
	employee_data_store =  new Ext.data.Store({
				reader: employeesReader
			});

	employees_json = Ext.util.JSON.decode('<?php echo $javascript->object($employee_data); ?>');
	employee_data_store.loadData(employees_json.employee_data);

    grid_employee = new Ext.grid.GridPanel({
						store: employee_data_store,
						columns: [
							{header: 'Employee ID', width: 100, sortable: true, dataIndex: 'employee_id'},
							{header: 'Name', width: 310, sortable: true, dataIndex: 'employee_name'}
						],
						height: 350,
						width: 420
					});
					
    grid_employee.on('rowdblclick', function(sm, row_index, r) {
					record = grid_employee.getStore().getAt(row_index);
					emp_name = record.get('employee_name');

					employee_name.setValue(emp_name);
					employee_id = record.get('rec_id');
					
					win_employee.hide(this);
					
					description.enable();
					btn_save.enable();
				});

    employee_name = new Ext.form.TextField({
				id: 'employee_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				//maxLength : 5,
				width: 300,
				disabled: true,
				renderTo: 'cnt_employee_name',
				disabled: true,
				msgTarget: 'under',
				allowBlank:false,
				style: 'margin:0px'
    		});

    btn_popup_employee = new Ext.Button({
							text: '',
							id: 'btn_popup_employee',
							icon: '/img/data_browser_view.png',
							minWidth: 50,
							disabled: false,
							renderTo: 'cnt_employee_btn'
						});
	
	
	btn_popup_employee.on('click', function() {
        // create the window on the first click and reuse on subsequent clicks
        if(!win_employee){
            win_employee = new Ext.Window({
                applyTo:'cnt_employee_browser',
                layout:'fit',
                width:450,
                height:200,
                closeAction:'hide',
                plain: true,
				title: 'Employee Browser',
                items: grid_employee
            });
        }
        win_employee.show(this);
    });


});

</script>

<script>
var description = null;
var status_div = null;

Ext.onReady(function(){

	description = new Ext.form.TextArea({
    			id: 'txt_description',
    			width: 400,
    			height: 180,
    			disabled: true,
    		    renderTo: 'cnt_description',
    		    allowBlank:false
    });
    
	status_div = Ext.get('status_div');
});
</script>

<script>
function save() {
/*
	// Validate fields before submit
	if(!is_form_valid()) {
		Ext.MessageBox.alert("FAMS", "Please check the values you have entered.");
		return false;
	}

	ajaxClass.request({
			   url: '/assets/asset_registry_update',
			   params: { 
			   			asset_code: ast_asset_code.getValue(), 
			   			short_name: ast_short_name.getValue(),
			   			description: ast_description.getValue(),
			   			asset_category_id: ast_asset_category.getValue(),
			   			supplier_id: ast_supplier.getValue(),
			   			purchase_price: ast_purchase_price.getValue(),
			   			purchase_date: ast_purchase_date.getValue().format('Y-m-d'),
			   			lifespan: ast_lifespan.getValue(),
			   			salvage_value: ast_salvage_value.getValue(),
			   			id: rec_id.getValue(),
			   			action: action.getValue()
	   			},
			   callback : function(options, success, response) { 
			   				obj = Ext.util.JSON.decode(response.responseText);
			   				grid_data_store.loadData(obj.assets_data);
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
*/	
}
function cancel() {
	clear();
/*
	grid.getSelectionModel().deselectRow(current_row_index);
	disable_fields(true);
	grid.setDisabled(false);
*/
}

// Clear all text fields and error messages
function clear() {
/*	ast_asset_code.setValue(''); ast_asset_code.clearInvalid();
	
	ast_short_name.setValue(''); ast_short_name.clearInvalid();
	
	ast_description.setValue(''); ast_description.clearInvalid();
	
	ast_asset_category.setValue(''); ast_asset_category.clearInvalid();
	
	ast_supplier.setValue(''); ast_supplier.clearInvalid();
	
	ast_purchase_price.setValue(''); ast_purchase_price.clearInvalid();
	
	ast_purchase_date.setValue(''); ast_purchase_date.clearInvalid();
	
	ast_lifespan.setValue(''); ast_lifespan.clearInvalid();
	
	ast_salvage_value.setValue(''); ast_salvage_value.clearInvalid();

	rec_id.setValue('');
	action.setValue('');
	
	document.getElementById('cnt_asset_image').innerHTML = '';
	tabs.items.get(1).setDisabled(true);
	tabs.setActiveTab(0);
*/
}

function get_data_for_browser(request_type, type_id, grid_data_store) {
	ajaxClass.request({
			   url: '/asset_complaints/asset_complaints_browsers',
			   params: { 
			   			request_type: request_type,
			   			type_id: type_id
	   			},
			   callback : function(options, success, response) {
			   				obj = Ext.util.JSON.decode(response.responseText);
			   				grid_data_store.loadData(obj.grid_data);
			   				
			   				// If request is for asset browser
			   				if(obj.request_type == 'A') {
			   					win_ast.show();
			   				}
	   			}
			});
}
</script>

<!-- Containers for popup windows -->
<div id="cnt_employee_browser" class="x-hidden"><!-- employee browser container --></div>
<!-- End containers for popup windows -->

<div id="status_div"></div>

<div id="fields_div">
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="font-weight:bold;color:#15428b;margin-top:5px;border:#8db2e3 2px solid;width:700px;">
			<tr>
				<td align="center">Asset Requests</td>
			</tr>
		</table>
	</div>
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="margin-top:5px;border:#8db2e3 2px solid;width:700px;">
			<tr>
				<td colspan="5" style="height:5px"></td>
			</tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td width="22%">Request From</td>
				<td width="1%">:</td>
				<td id="cnt_employee_name" width="300px"><!-- employee container--></td>
				<td id="cnt_employee_btn"><!-- employee load button container--></td>
			</tr>
			<tr>
				<td colspan="5" style="height:5px"></td>
			</tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td valign="top" width="22%">Description</td>
				<td valign="top" width="1%">:</td>
				<td id="cnt_description" colspan="2"><!-- message --></td>
			</tr>
			<tr>
				<td colspan="5" style="height:5px"></td>
			</tr>
		</table>
	</div>
</div>

<?php echo $this->renderElement('command_buttons_mini'); ?>
