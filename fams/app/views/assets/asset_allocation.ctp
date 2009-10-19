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

/* Employee Browser Script for first tab */

var btn_popup_employee = null;
var employee_name = null;
var employee_id = null;
var win_employee;
var grid_employee_data_store = null;

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
           {name: 'employee_id', type: 'int'},
           {name: 'employee_name'}
	 	]
    });
    
	store.loadData(myData);

    grid_employee = new Ext.grid.GridPanel({
						store: store,
						columns: [
							{header: 'Employee ID', width: 100, sortable: true, dataIndex: 'employee_id'},
							{header: 'Name', width: 310, sortable: true, dataIndex: 'employee_name'}
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
					
    grid_employee.on('rowdblclick', function(sm, row_index, r) {
					/*
					category_code.setValue(r.data['category_code']);
					category_name.setValue(r.data['category_name']);
					category_description.setValue(r.data['category_description']);

					rec_id.setValue(r.data['rec_id'], true);
					current_row_index = row_index;
					*/
					var record = grid_employee.getStore().getAt(row_index);
					var callref = record.get('employee_name');

					employee_name.setValue(callref);
					win_employee.hide(this);
					//alert('hi');
				});

});

Ext.onReady(function(){
    employee_name = new Ext.form.TextField({
				id: 'employee_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				//maxLength : 5,
				width: 300,
				disabled: false,
				renderTo: 'cnt_employee_name',
				msgTarget: 'under',
				allowBlank:false,
				style: 'margin:0px',
				value: 'AMD Athlon 2000+'
    		});

    btn_popup_employee = new Ext.Button({
							text: '',
							id: 'btn_popup_employee',
							icon: '/img/data_browser_view.png',
							minWidth: 50,
							renderTo: 'cnt_employee_btn',
							style: 'margin:0px'
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

<script type="text/javascript" language="javascript">

/* Location Browser Script*/

var btn_popup_location = null;
var location_name = null;
var location_id = null;
var win_location;
var grid_location_data_store = null;

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
           {name: 'location_id', type: 'int'},
           {name: 'location_code'},
           {name: 'location_name'}
	 	]
    });
    
	store.loadData(myData);

    grid_location = new Ext.grid.GridPanel({
						store: store,
						columns: [
							{header: 'Location Code', width: 100, sortable: true, dataIndex: 'location_code'},
							{header: 'Name', width: 310, sortable: true, dataIndex: 'location_name'}
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
					
    grid_location.on('rowdblclick', function(sm, row_index, r) {
					/*
					category_code.setValue(r.data['category_code']);
					category_name.setValue(r.data['category_name']);
					category_description.setValue(r.data['category_description']);

					rec_id.setValue(r.data['rec_id'], true);
					current_row_index = row_index;
					*/
					var record = grid_location.getStore().getAt(row_index);
					var callref = record.get('location_name');

					location_name.setValue(callref);
					win_location.hide(this);
					//alert('hi');
				});

});

Ext.onReady(function(){
    location_name = new Ext.form.TextField({
				id: 'location_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				//maxLength : 5,
				width: 300,
				disabled: false,
				renderTo: 'cnt_location_name',
				msgTarget: 'under',
				allowBlank:false,
				style: 'margin:1px',
				value: 'AMD Athlon 2000+'
    		});

    btn_popup_location = new Ext.Button({
							text: '',
							id: 'btn_popup_location',
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
        win_location.show(this);
    });


});

</script>

<script type="text/javascript" language="javascript">

/* Responsible Person Browser Script*/

var btn_popup_resp_person = null;
var resp_person_name = null;
var resp_person_id = null;
var win_resp_person;
var grid_resp_person_data_store = null;

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
           {name: 'resp_person_id', type: 'int'},
           {name: 'resp_person_name'}
	 	]
    });
    
	store.loadData(myData);

    grid_resp_person = new Ext.grid.GridPanel({
						store: store,
						columns: [
							{header: 'Employee ID', width: 100, sortable: true, dataIndex: 'resp_person_id'},
							{header: 'Name', width: 310, sortable: true, dataIndex: 'resp_person_name'}
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
					
    grid_resp_person.on('rowdblclick', function(sm, row_index, r) {
					/*
					category_code.setValue(r.data['category_code']);
					category_name.setValue(r.data['category_name']);
					category_description.setValue(r.data['category_description']);

					rec_id.setValue(r.data['rec_id'], true);
					current_row_index = row_index;
					*/
					var record = grid_resp_person.getStore().getAt(row_index);
					var callref = record.get('resp_person_name');

					resp_person_name.setValue(callref);
					win_resp_person.hide(this);
					//alert('hi');
				});

});

Ext.onReady(function(){
    resp_person_name = new Ext.form.TextField({
				id: 'resp_person_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				//maxLength : 5,
				width: 300,
				disabled: false,
				renderTo: 'cnt_resp_person_name',
				msgTarget: 'under',
				allowBlank:false,
				style: 'margin:1px;',
				value: 'AMD Athlon 2000+'
    		});

    btn_popup_resp_person = new Ext.Button({
							text: '',
							id: 'btn_popup_resp_person',
							icon: '/img/data_browser_view.png',
							minWidth: 50,
							renderTo: 'cnt_resp_person_btn',
							style: 'margin:0px'
						});
	
	
	btn_popup_resp_person.on('click', function() {
        // create the window on the first click and reuse on subsequent clicks
        if(!win_resp_person){
            win_resp_person = new Ext.Window({
                applyTo:'cnt_resp_person_browser',
                layout:'fit',
                width:450,
                height:200,
                closeAction:'hide',
                plain: true,
				title: 'Employee Browser',
                items: grid_resp_person
            });
        }
        win_resp_person.show(this);
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
            {contentEl:'tab2', title: 'Assign To a Location', disabled: false}
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
var branch = null;
var com_date_person = null;
var com_date_loc = null;


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
    		    allowBlank:false
    });

	com_date_person = new Ext.form.DateField({
    			id: 'dat_com_date_person',
    			width: 200,
    			disabled: false,
    			format: 'm/d/Y',
    		    renderTo: 'cnt_com_date_person',
    		    allowBlank:false
    });

	com_date_loc = new Ext.form.DateField({
    			id: 'dat_com_date_loc',
    			width: 200,
    			disabled: false,
    			format: 'm/d/Y',
    		    renderTo: 'cnt_com_date_loc',
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
</script>

<div id="status_div"></div>

<div id="fields_div">
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="font-weight:bold;color:#15428b;margin-top:5px;border:#8db2e3 2px solid;width:700px;">
			<tr>
				<td align="center">Allocating Assets</td>
			</tr>
		</table>
	</div>
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="margin-top:5px;border:#8db2e3 2px solid;width:700px;">
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
<div id="fields_div" align="center" style="margin-top:5px;width:100%;">
	<div id="tab_div" align="center" style="margin-top:5px;width:700px;">
		<div id="tab1">
				<table border="0" width="100%">
					<tr>
						<td colspan="5" style="height:30px"></td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td width="22%">Responsible Person</td>
						<td width="1%">:</td>
						<td width="20%" id="cnt_employee_name" style="padding:0px;height:10px"><!-- person container--></td>
						<td id="cnt_employee_btn" style="padding:0px;height:10px"></td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td width="10%">Commencement Date</td>
						<td width="1%">:</td>
						<td id="cnt_com_date_person"><!-- commencement date container--></td>
						<td></td>
					</tr>
				</table>
		</div> 
		<div id="tab2">
				<table border="0" width="100%">
					<tr>
						<td colspan="5" style="height:10px"></td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td width="22%">Branch</td>
						<td width="1%">:</td>
						<td width="20%" id="cnt_branch"><!-- branch container--></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td>Location</td>
						<td>:</td>
						<td id="cnt_location_name" style="padding:2px;height:10px"><!-- location container--></td>
						<td id="cnt_location_btn" style="padding:0px;height:10px"></td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td>Responsible Person</td>
						<td>:</td>
						<td id="cnt_resp_person_name" style="padding:2px;height:10px"><!-- person container--></td>
						<td id="cnt_resp_person_btn" style="padding:0px;height:10px"></td>
					</tr>
					<tr>
						<td width="10%">&nbsp;</td>
						<td>Commencement Date</td>
						<td>:</td>
						<td id="cnt_com_date_loc"><!-- commencement date container--></td>
						<td></td>
					</tr>
				</table>
		</div>
	</div>
</div>

<!-- Containers for popup windows -->
<div id="cnt_asst_cat_browser" class="x-hidden"><!--asset category browser container--></div>
<div id="cnt_asst_browser" class="x-hidden"><!--asset browser container--></div>
<div id="cnt_employee_browser" class="x-hidden"><!-- employee browser container --></div>
<div id="cnt_location_browser" class="x-hidden"><!-- location browser container--></div>
<div id="cnt_resp_person_browser" class="x-hidden"><!-- location person browser container --></div>

<?php echo $this->renderElement('command_buttons_mini'); ?>
