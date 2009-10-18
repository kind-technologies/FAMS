<?php echo $this->renderElement('common_js_objects'); ?>

<script type="text/javascript" language="javascript">

/* Asset Category Browser Script*/

var btn_popup_ast_cat = null;
var ast_cat_name = null;
var ast_cat_id = null;
var win_ast_cat;
var grid_asset_cat_data_store = null;

Ext.onReady(function(){

	// Data grid for Asset Category Browser	
	var myData = [
        [0, 'AAA', 'AAAAAAAAAAAAAAAA'],
        [1, 'BBB', 'BBBBBBBBBBBBBBBB'],
        [2, 'CCC', 'CCCCCCCCCCCCCCCC'],
        [3, 'DDD', 'DDDDDDDDDDDDDDDD'],
        [4, 'EEE', 'EEEEEEEEEEEEEEEE'],
        [5, 'FFF', 'FFFFFFFFFFFFFFFF']
    ];
    
    var store = new Ext.data.ArrayStore({
        fields: [
           {name: 'ast_cat_id', type: 'int'},
           {name: 'ast_cat_code'},
           {name: 'ast_cat_name'}
	 	]
    });
    
	store.loadData(myData);

    grid_asset_cat = new Ext.grid.GridPanel({
						store: store,
						columns: [
							{header: 'Category Code', width: 100, sortable: true, dataIndex: 'ast_cat_code'},
							{header: 'Description', width: 310, sortable: true, dataIndex: 'ast_cat_name'}
						],
					   /* stripeRows: true,
						autoExpandColumn: 'company',*/
						height: 350,
						width: 420/*,
						title: 'Asset Categories',
						// config options for stateful behavior
						stateful: true,
						stateId: 'grid'   */     
					});
					
    grid_asset_cat.on('rowdblclick', function(sm, row_index, r) {
					/*
					category_code.setValue(r.data['category_code']);
					category_name.setValue(r.data['category_name']);
					category_description.setValue(r.data['category_description']);

					rec_id.setValue(r.data['rec_id'], true);
					current_row_index = row_index;
					*/
					var record = grid_asset_cat.getStore().getAt(row_index);
					var callref = record.get('ast_cat_name');

					ast_cat_name.setValue(callref);
					win_ast_cat.hide(this);
					//alert('hi');
				});

});

Ext.onReady(function(){
    ast_cat_name = new Ext.form.TextField({
				id: 'ast_cat_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				//maxLength : 5,
				width: 300,
				disabled: false,
				renderTo: 'cnt_asset_cat',
				msgTarget: 'under',
				allowBlank:false,
				value: 'Computer'
    		});

    btn_popup_ast_cat = new Ext.Button({
							text: '',
							id: 'btn_popup_ast_cat',
							icon: '/img/data_browser_view.png',
							minWidth: 50,
							renderTo: 'cnt_asset_cat_btn'
						});
	
	
	btn_popup_ast_cat.on('click', function() {
        // create the window on the first click and reuse on subsequent clicks
        if(!win_ast_cat){
            win_ast_cat = new Ext.Window({
                applyTo:'cnt_asst_cat_browser',
                layout:'fit',
                width:450,
                height:200,
                closeAction:'hide',
                plain: true,
				title: 'Asset Category Browser',
                items: grid_asset_cat
            });
        }
        win_ast_cat.show(this);
    });


});

</script>

<script type="text/javascript" language="javascript">

/* Asset Browser Script*/

var btn_popup_ast = null;
var ast_name = null;
var ast_id = null;
var win_ast;
var grid_asset_data_store = null;

Ext.onReady(function(){

	// Data grid for Asset Browser	
	var myData = [
        [0, 'AAA', 'AAAAAAAAAAAAAAAA'],
        [1, 'BBB', 'BBBBBBBBBBBBBBBB'],
        [2, 'CCC', 'CCCCCCCCCCCCCCCC'],
        [3, 'DDD', 'DDDDDDDDDDDDDDDD'],
        [4, 'EEE', 'EEEEEEEEEEEEEEEE'],
        [5, 'FFF', 'FFFFFFFFFFFFFFFF'],
        [6, 'FFF', 'FFFFFFFFFFFFFFFF'],
        [7, 'FFF', 'FFFFFFFFFFFFFFFF']
    ];
    
    var store = new Ext.data.ArrayStore({
        fields: [
           {name: 'ast_id', type: 'int'},
           {name: 'ast_code'},
           {name: 'ast_name'}
	 	]
    });
    
	store.loadData(myData);

    grid_asset = new Ext.grid.GridPanel({
						store: store,
						columns: [
							{header: 'Asset Code', width: 100, sortable: true, dataIndex: 'ast_code'},
							{header: 'Short Name', width: 310, sortable: true, dataIndex: 'ast_name'}
						],
					   /* stripeRows: true,
						autoExpandColumn: 'company',*/
						height: 350,
						width: 420/*,
						title: 'Asset Categories',
						// config options for stateful behavior
						stateful: true,
						stateId: 'grid'   */     
					});
					
    grid_asset.on('rowdblclick', function(sm, row_index, r) {
					/*
					category_code.setValue(r.data['category_code']);
					category_name.setValue(r.data['category_name']);
					category_description.setValue(r.data['category_description']);

					rec_id.setValue(r.data['rec_id'], true);
					current_row_index = row_index;
					*/
					var record = grid_asset.getStore().getAt(row_index);
					var callref = record.get('ast_name');

					ast_name.setValue(callref);
					win_ast.hide(this);
					//alert('hi');
				});

});

Ext.onReady(function(){
    ast_name = new Ext.form.TextField({
				id: 'ast_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				//maxLength : 5,
				width: 300,
				disabled: false,
				renderTo: 'cnt_asset',
				msgTarget: 'under',
				allowBlank:false,
				value: 'AMD Athlon 2000+'
    		});

    btn_popup_ast = new Ext.Button({
							text: '',
							id: 'btn_popup_ast',
							icon: '/img/data_browser_view.png',
							minWidth: 50,
							renderTo: 'cnt_asset_btn'
						});
	
	
	btn_popup_ast.on('click', function() {
        // create the window on the first click and reuse on subsequent clicks
        if(!win_ast){
            win_ast = new Ext.Window({
                applyTo:'cnt_asst_browser',
                layout:'fit',
                width:450,
                height:200,
                closeAction:'hide',
                plain: true,
				title: 'Asset Browser',
                items: grid_asset
            });
        }
        win_ast.show(this);
    });


});

</script>

<script type="text/javascript" language="javascript">
/*
 * Tab area
 */

Ext.onReady(function(){

    tabs = new Ext.TabPanel({
        renderTo: 'tab_div',
        id:'tab_panel',
        activeTab: 0,
        frame: true,
        deferredRender: false,
        defaults:{autoHeight: true},
        items:[
            {contentEl:'tab1', title: 'Assign To a Person'},
            {contentEl:'tab2', title: 'Assign To a Location', disabled: true}
        ],
        viewConfig: {
			forceFit: true,
		 	fitContainer: true
		},
		height: 180,
		width:700
    });

});
</script>

<script>
var assign_to_opt = null;
var status_div = null;

Ext.onReady(function(){
	assign_to_opt = new Ext.form.RadioGroup({
    			id: 'rdg_assign_to',
    			width: 150,
    			disabled: false,
    			items: [{
                        checked: true,
                        id: 'opt_person',
                        boxLabel: 'Person',
                        name: 'rdo_assign_to',
                        inputValue: 'P'
                    },{
                    		checked: false,
                    		id: 'opt_location',
                        boxLabel: 'Location',
                        name: 'rdo_assign_to',
                        inputValue: 'L'
                    }],
            style: 'margin-top:5px',
    		    renderTo: 'cnt_opt_assign'
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
</script>

<div id="status_div"></div>

<div id="fields_div">
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="margin-top:50px;border:#8db2e3 2px solid;width:700px;">
			<tr>
				<td width="50px">&nbsp;</td>
				<td width="150px"> Asset Category	</td>
				<td id="cnt_asset_cat" width="300px"><!--asset category name container--></td>
				<td id="cnt_asset_cat_btn"><!--asset category load button container--></td>
			</tr>
			<tr>
				<td width="50px">&nbsp;</td>
				<td width="150px"> Asset </td>
				<td id="cnt_asset" width="300px"><!--asset name container--></td>
				<td id="cnt_asset_btn"><!--asset load button container--></td>
			</tr>

		</table>
	</div>
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
			<tr>
				<td width="50px">&nbsp;</td>
				<td width="150px"> Assign Asset To a</td>
				<td id="cnt_opt_assign" style="height:25px;vertical-align:bottom"><!-- assign to option buttons container--></td>
			</tr>
		</table>
	</div>
</div>
<div align="center" style="margin-top:5px;width:100%;">
	<div id="tab_div" align="center" style="margin-top:5px;width:700px;">
		<div id="tab1">
			<?php /*?><table border="0" width="100%">
				<tr>
					<td width="150px">Employee ID</td>
					<td width="5px">:</td>
					<td colspan="4" id="cnt_emp_id"><!-- employee id (ext gen.) --></td>
				</tr>
				<tr>
					<td>Full Name</td>
					<td width="5px">:</td>
					<td colspan="4" id="cnt_full_name"><!-- full name (ext gen.) --></td>
				</tr>
				<tr>
					<td>Name with Initials</td>
					<td width="5px">:</td>
					<td colspan="4" id="cnt_name_with_init"><!-- name with init (ext gen.) --></td>
				</tr>
				<tr>
					<td>Date of Birth</td>
					<td width="5px">:</td>
					<td id='cnt_dob'><!-- date of birth (ext gen.) --></td>
					<td width="80px">Gender</td>
					<td width="5px">:</td>
					<td id="cnt_gender" valign="middle"><!-- gender (ext gen.) --></td>
				</tr>
				<tr>
					<td>Email</td>
					<td width="5px">:</td>
					<td colspan="4" id="cnt_email"><!-- email (ext gen.) --></td>
				</tr>
				<tr>
					<td>Address</td>
					<td width="5px">:</td>
					<td colspan="4" id="cnt_address"><!-- address (ext gen.) --></td>
				</tr>			
				<tr>
					<td>Contact Number</td>
					<td width="5px">:</td>
					<td colspan="4" id="cnt_phone"><!-- contact number (ext gen.) --></td>
				</tr>
				<tr>
					<td>Branch</td>
					<td width="5px">:</td>
					<td id="cnt_branch"><!-- branch (ext gen.) --></td>
					<td>Division</td>
					<td>:</td>
					<td id="cnt_division"><!-- divsion (ext gen.) --></td>
				</tr>
				<tr>
					<td></td>
					<td width="5px"></td>
					<td id="cnt_hdn_rec_id"><!-- hidden field employee record id (ext gen.) --></td>
					<td></td>
					<td></td>
					<td id="cnt_hdn_action"><!-- hidden field action (ext gen.) --></td>
				</tr>
			</table> <?php*/?>
		</div> 
		<div id="tab2">
					<?php /*?><table border="0" width="100%">
					<tr>
						<td width="10%" id="cnt_upload_button"><!--upload buton container--></td>
						<td id="cnt_load_image"><!--load image buton container--></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
						<!--employee image container-->
							<div style="background-color:#c6d9f1;border:#d3e1f1 5px solid;width:180px;height:180px" id="cnt_emp_image">
						
							</div>
						</td>
					</tr>
				</table><?php*/?>
		</div>
	</div>
</div>

<!-- Containers for popup windows -->
<div id="cnt_asst_cat_browser" class="x-hidden"><!--asset category browser container--></div>
<div id="cnt_asst_browser" class="x-hidden"><!--asset browser container--></div>

<?php echo $this->renderElement('command_buttons_mini'); ?>
