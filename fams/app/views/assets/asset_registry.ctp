<?php echo $this->renderElement('common_js_objects'); ?>

<script type="text/javascript" language="javascript">
/*
 * Grid Area
 */
var grid = null;
var current_row_index = 0;

var grid_data_store = null;
var file_upload_form = null;

var tabs = null;

Ext.onReady(function() {
	
	
	var assetReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id', type: 'int'},
		{name: 'ast_asset_code'},
		{name: 'ast_short_name'},
		{name: 'ast_description'},
		{name: 'ast_asset_category_id'},
		{name: 'ast_supplier_id'},
		{name: 'ast_purchase_price'},
		{name: 'ast_purchase_date', type: 'date', dateFormat: 'm/d/Y'},
		{name: 'ast_lifespan'},
		{name: 'ast_salvage_value'}
	]);	
	
	
	grid_data_store =  new Ext.data.Store({
				reader: assetReader
			});


	assets_json = Ext.util.JSON.decode('<?php echo $javascript->object($assets_data); ?>');
	grid_data_store.loadData(assets_json.assets_data);

	
	grid = new Ext.grid.GridPanel({
			store: grid_data_store,
			columns: [
				{header: 'Asset Code', width: 120, sortable: true, dataIndex: 'ast_asset_code'},
				{header: 'Short Name', width: 90, sortable: true, dataIndex: 'ast_short_name'},
				{header: 'Purchase Price ($)', width: 90, sortable: true, dataIndex: 'ast_purchase_price'},
				{header: 'Lifespan (Months)', width: 90, sortable: true, dataIndex: 'ast_lifespan'},
				{header: 'Salvage Value', width: 90, sortable: true, dataIndex: 'ast_salvage_value'}
			],
			viewConfig: {
				forceFit: true,
			 	fitContainer: true
			},
			sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
			renderTo: 'grid_area',
			title: 'Assets',
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
		ast_asset_code.setValue(r.data['ast_asset_code']);
		ast_short_name.setValue(r.data['ast_short_name']);
		ast_description.setValue(r.data['ast_description']);
		ast_asset_category.setValue(r.data['ast_asset_category_id'], true);
		ast_supplier.setValue(r.data['ast_supplier_id'], true);
		ast_purchase_price.setValue(r.data['ast_purchase_price']);
		ast_purchase_date.setValue(r.data['ast_purchase_date']);
		ast_lifespan.setValue(r.data['ast_lifespan']);
		ast_salvage_value.setValue(r.data['ast_salvage_value']);
		
		rec_id.setValue(r.data['rec_id'], true);
		current_row_index = row_index;
		
		// clear photo when moving among records
		document.getElementById('cnt_asset_image').innerHTML = '';
		
		
		// enable the second tab
		tabs.items.get(1).setDisabled(false);
		
		// fill the hidden field for photo upload
		file_upload_form.get('hdn_upld_asset_id').setValue(r.data['rec_id'], true);
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
            {contentEl:'tab1', title: 'Assets Details'},
            {contentEl:'tab2', title: 'Additional Info', disabled: true}
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
var ast_asset_code = null;
var ast_short_name = null;
var ast_description = null;
var ast_asset_category = null;
var ast_supplier = null;
var ast_purchase_price = null;
var ast_purchase_date = null;
var ast_lifespan = null;
var ast_salvage_value = null;


var rec_id = null;
var action = null;

var status_div = null;

var btn_popup_upload = null;
var btn_load_image = null;


Ext.onReady(function(){
    ast_asset_code = new Ext.form.TextField({
    			id: 'txt_ast_asset_code',
    			validateOnBlur: true,
    			invalidText: 'The value in this field is invalid',
    			maxLength : 5,
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_ast_asset_code',
    		    msgTarget: 'under',
    		    allowBlank:false
    });

	ast_short_name = new Ext.form.TextField({
    			id: 'txt_ast_short_name',
    			width: 600,
    			disabled: true,
    		    renderTo: 'cnt_ast_short_name',
    		    allowBlank:false
    });

    
	ast_description = new Ext.form.TextField({
    			id: 'txt_ast_description',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_ast_description',
    		    allowBlank:false
    });
    
	// Get the data for asset category selection drop down list
	asset_category_json = Ext.util.JSON.decode('<?php echo $javascript->object($asset_categories_data); ?>');
	
	ast_asset_category = new Ext.form.ComboBox({
    			id: 'txt_ast_asset_category',
    			width: 200,
    			disabled: true,
    			editable: false,
    			store: new Ext.data.SimpleStore({
									fields:['cid', 'category_code', 'name', 'description'],
									data: asset_category_json.asset_categories_data // Set asset category data from json string
									}),
				valueField: 'cid',
				displayField:'name',
				forceSelection: true,
				mode: 'local',
				triggerAction: 'all',
    		    renderTo: 'cnt_ast_asset_category',
    		    allowBlank:false
    });

	// Get the data for supplier selection drop down list
	ast_supplier_json = Ext.util.JSON.decode('<?php echo $javascript->object($suppliers_data); ?>');
	
	ast_supplier = new Ext.form.ComboBox({
    			id: 'txt_ast_supplier',
    			width: 200,
    			disabled: true,
    			editable: false,
    			store: new Ext.data.SimpleStore({
									fields:['sid', 'supplier_code', 'description'],
									data: ast_supplier_json.suppliers_data // Set supplier data from json string
									}),
				valueField: 'sid',
				displayField:'supplier_code',
				forceSelection: true,
				mode: 'local',
				triggerAction: 'all',
    		    renderTo: 'cnt_ast_supplier',
    		    allowBlank:false
    });

	ast_purchase_price = new Ext.form.TextField({
    			id: 'txt_ast_purchase_price',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_ast_purchase_price',
    		    allowBlank:false
    });

	ast_purchase_date = new Ext.form.DateField({
    			id: 'dat_ast_purchase_date',
    			width: 200,
    			disabled: true,
    			format: 'm/d/Y',
    		    renderTo: 'cnt_ast_purchase_date',
    		    allowBlank:false
    });

	ast_lifespan = new Ext.form.TextField({
    			id: 'txt_ast_lifespan',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_ast_lifespan',
    		    allowBlank:false
    });

	ast_salvage_value = new Ext.form.TextField({
    			id: 'txt_ast_salvage_value',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_ast_salvage_value',
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
/**/
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
/*		action.setValue('__d');
		btn_add.setDisabled(true);
		btn_edit.setDisabled(true);
		btn_delete.setDisabled(true);
		
		Ext.MessageBox.confirm("FAMS", "Do you want to delete this record?", 
									function(btn){
										if(btn == "yes") {
											ajaxClass.request({
														url: '/employees/emplayee_update',
														params: { 
															id: rec_id.getValue(),
															action: action.getValue()
														},
														callback : function(options, success, response) { 
															obj = Ext.util.JSON.decode(response.responseText);
															grid_data_store.loadData(obj.employee_data);
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
*/
	}

	function save() {
/*
		// Validate fields before submit
		if(!is_form_valid()) {
			Ext.MessageBox.alert("FAMS", "Please check the values you have entered.");
			return false;
		}

		ajaxClass.request({
				   url: '/employees/emplayee_update',
				   params: { 
				   			employee_id: emp_id.getValue(), 
				   			full_name: emp_full_name.getValue(),
				   			name_with_initials: emp_name_with_init.getValue(),
				   			date_of_birth: emp_dob.getValue().format('Y-m-d'),
				   			gender: (emp_gender.items.get(0).checked) ? 'M' : 'F',
				   			email: emp_email.getValue(),
				   			address: emp_address.getValue(),
				   			contact_number: emp_phone.getValue(),
				   			branch_id: emp_branch.getValue(),
				   			division_id: emp_division.getValue(),
				   			id: rec_id.getValue(),
				   			action: action.getValue()
		   			},
				   callback : function(options, success, response) { 
				   				obj = Ext.util.JSON.decode(response.responseText);
				   				grid_data_store.loadData(obj.employee_data);
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
		grid.getSelectionModel().deselectRow(current_row_index);
		disable_fields(true);
		grid.setDisabled(false);
	}

	
	// Clear all text fields and error messages
	function clear() {
		ast_asset_code.setValue(''); ast_asset_code.clearInvalid();
		
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
	}

	function disable_fields(bool) {
		ast_asset_code.setDisabled(bool);
		ast_short_name.setDisabled(bool);
		ast_description.setDisabled(bool);
		ast_asset_category.setDisabled(bool);
		ast_supplier.setDisabled(bool);
		ast_purchase_price.setDisabled(bool);
		ast_purchase_date.setDisabled(bool);
		ast_lifespan.setDisabled(bool);
		ast_salvage_value.setDisabled(bool);
	}
	
	function display_message(text) {
		status_div.highlight("ffffff");		
		status_div.insertHtml("beforeEnd", text);
		setTimeout("status_div.dom.innerHTML=''", 5000);
	}
	
	function is_form_valid() {
		
		return (ast_asset_code.validate() &&
					ast_short_name.validate() &&
					ast_description.validate() &&
					ast_asset_category.validate() &&
					ast_supplier.validate() &&
					ast_purchase_price.validate() &&
					ast_purchase_date.validate() &&
					ast_lifespan.validate() &&
					ast_salvage_value.validate() );

	}
</script>
<script>
Ext.onReady(function(){

    btn_popup_upload = new Ext.Button({
							text: 'Upload Photo',
							id: 'btn_popup_upload',
							icon: '/img/image_add.png',
							minWidth: 100,
							renderTo: 'cnt_upload_button'
						});

    var win;
    
	var upload_success = function(fp, o) {
							
							if(o.result.success == true) {
								display_message("Image uploaded successfully.");
							} else {
								display_message("Image upload failed.");
							}
							
							btn_load_image.fireEvent('click');
							win.hide();
							
							// Reset page-mask for normal ajax operations
                				enable_mask = true;
	                    };

	var load_image = function(options, success, response) { 
					   		asset_img = document.getElementById('cnt_asset_image');
					   		asset_img.innerHTML = response.responseText;
					 };

    btn_popup_upload.on('click', function() {
        // create the window on the first click and reuse on subsequent clicks
        if(!win){
            win = new Ext.Window({
                applyTo:'cnt_photo_win',
                layout:'fit',
                width:510,
                height:122,
                closeAction:'hide',
                plain: true,
				title: 'File Upload Form',
                items: file_upload_form
            });
        }
        win.show(this);
    });

    file_upload_form = new Ext.FormPanel({
        renderTo: 'cnt_photo_form',
        fileUpload: true,
        width: 500,
        frame: true,
        autoHeight: true,
        bodyStyle: 'padding: 10px 10px 0 10px;',
        labelWidth: 50,
        defaults: {
            anchor: '95%',
            allowBlank: false,
            msgTarget: 'side'
        },
        items: [{
            xtype: 'hidden',
            id: 'hdn_upld_asset_id',
            name: 'hdn_upld_asset_id'
        },{
            xtype: 'fileuploadfield',
            id: 'photo',
            emptyText: 'Select an image',
            fieldLabel: 'Photo',
            name: 'photo',
            buttonText: '',
            buttonCfg: {
                iconCls: 'upload-icon'
            }
        }],
        buttons: [{
            text: 'Save',
            handler: function() {
            	// Disable ajax page-mask when uploading image
            	enable_mask = false;

                if(file_upload_form.getForm().isValid()){
                	
	                file_upload_form.getForm().submit({
	                    url: '/assets/asset_registry_upload_photo',
	                    waitMsg: 'Uploading your photo...',
	                    success: upload_success
	                });
	                
                }

            }
        }, {
            text: 'Reset',
            handler: function(){
               file_upload_form.getForm().reset();
            }
        }]
    });

	btn_load_image =  new Ext.Button({
		text: 'Load Photo',
		id: 'btn_load_image',
		icon: '/img/load_image.png',
		minWidth: 100,
		renderTo: 'cnt_load_image'
	});
	
	btn_load_image.on('click', function(){
			ajaxClass.request({
					   url: '/assets/asset_registry_load_photo',
					   params: { 
					   			id: rec_id.getValue(),
				   			},
					   callback : load_image
					});
        });
});
</script>

<div id="status_div"></div>

<div id="grid_area" style="width:100%"></div>
<div id="fields_div" style="margin-top:5px">
    <div id="tab1">
		<table border="0" width="100%">
			<tr>
				<td width="150px">Asset Code</td>
				<td width="5px">:</td>
				<td colspan="4" id="cnt_ast_asset_code"><!-- asset code (ext gen.) --></td>
			</tr>
			<tr>
				<td>Short Name</td>
				<td width="5px">:</td>
				<td colspan="4" id="cnt_ast_short_name"><!-- short name (ext gen.) --></td>
			</tr>
			<tr>
				<td>Description</td>
				<td width="5px">:</td>
				<td colspan="4" id="cnt_ast_description"><!-- description (ext gen.) --></td>
			</tr>
			<tr>
				<td>Asset Category</td>
				<td width="5px">:</td>
				<td id='cnt_ast_asset_category'><!-- asset category (ext gen.) --></td>
				<td width="80px">Supplier</td>
				<td width="5px">:</td>
				<td id="cnt_ast_supplier" valign="middle"><!-- Supplier (ext gen.) --></td>
			</tr>
			<tr>
				<td>Purchase Price</td>
				<td width="5px">:</td>
				<td colspan="4" id="cnt_ast_purchase_price"><!-- purchase price (ext gen.) --></td>
			</tr>
			<tr>
				<td>Purchase Date</td>
				<td width="5px">:</td>
				<td id="cnt_ast_purchase_date"><!-- purchase date (ext gen.) --></td>
				<td>Lifespan</td>
				<td>:</td>
				<td id="cnt_ast_lifespan"><!-- lifespan (ext gen.) --></td>
			</tr>
			<tr>
				<td>Salvage Value</td>
				<td width="5px">:</td>
				<td colspan="4" id="cnt_ast_salvage_value"><!-- salvage value (ext gen.) --></td>
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
    <div id="tab2">
    			<table border="0" width="100%">
				<tr>
					<td width="10%" id="cnt_upload_button"><!--upload buton container--></td>
					<td id="cnt_load_image"><!--load image buton container--></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<!--asset image container-->
						<div style="background-color:#c6d9f1;border:#d3e1f1 5px solid;width:180px;height:180px" id="cnt_asset_image">
						
						</div>
					</td>
				</tr>
			</table>
	</div>
</div>

<div id="cnt_photo_win" class="x-hidden">
	<div id="cnt_photo_form"></div>
</div>
<?php echo $this->renderElement('command_buttons'); ?>

