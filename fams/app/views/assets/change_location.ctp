<?php echo $this->renderElement('common_js_objects'); ?>

<script type="text/javascript" language="javascript">

/* Asset Category Browser Script*/

var btn_popup_ast_cat = null;
var ast_cat_name = null;
var ast_cat_id = null;
var win_ast_cat;
var asset_cat_data_store = null;

Ext.onReady(function(){

	var categoriesReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id'},
		{name: 'category_code'},
		{name: 'category_name'},
		{name: 'category_description'}
	]);	
    
	asset_cat_data_store =  new Ext.data.Store({
				reader: categoriesReader
			});

	asset_categories_json = Ext.util.JSON.decode('<?php echo $javascript->object($asset_categories_data); ?>');
	asset_cat_data_store.loadData(asset_categories_json.asset_categories_data);

    grid_asset_cat = new Ext.grid.GridPanel({
						store: asset_cat_data_store,
						columns: [
							{header: 'Category Code', width: 100, sortable: true, dataIndex: 'category_code'},
							{header: 'Category Name', width: 310, sortable: true, dataIndex: 'category_name'}
						],
						height: 350,
						width: 420
					});
					
    grid_asset_cat.on('rowdblclick', function(sm, row_index, r) {
					record = grid_asset_cat.getStore().getAt(row_index);
					cat_name = record.get('category_name');
					ast_cat_id = record.get('rec_id');
					
					ast_cat_name.setValue(cat_name);
					
					win_ast_cat.hide(this);

					btn_popup_ast.setDisabled(false);
				});

    ast_cat_name = new Ext.form.TextField({
				id: 'ast_cat_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				width: 300,
				disabled: true,
				renderTo: 'cnt_asset_cat',
				msgTarget: 'under',
				allowBlank:false
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
var asset_data_store = null;

Ext.onReady(function(){

	var assetsReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id'},
		{name: 'ast_code'},
		{name: 'ast_name'}
	]);	
    
	asset_data_store =  new Ext.data.Store({
				reader: assetsReader
			});
			
    grid_asset = new Ext.grid.GridPanel({
						store: asset_data_store,
						columns: [
							{header: 'Asset Code', width: 100, sortable: true, dataIndex: 'ast_code'},
							{header: 'Short Name', width: 310, sortable: true, dataIndex: 'ast_name'}
						],
						height: 350,
						width: 420     
					});
					
    grid_asset.on('rowdblclick', function(sm, row_index, r) {
					
					record = grid_asset.getStore().getAt(row_index);
					asset_name = record.get('ast_name');

					ast_name.setValue(asset_name);
					ast_id = record.get('rec_id');
					
					win_ast.hide(this);
					
					branch.setDisabled(false);
					
					btn_popup_resp_person.enable();
					btn_save.enable();
					
					get_data_for_browser('D', ast_id, null);
				});

    ast_name = new Ext.form.TextField({
				id: 'ast_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				width: 300,
				disabled: true,
				renderTo: 'cnt_asset',
				msgTarget: 'under',
				allowBlank:false
    		});

    btn_popup_ast = new Ext.Button({
							text: '',
							id: 'btn_popup_ast',
							disabled: true,
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

		// Load data for grid before popup the browser
		get_data_for_browser('AL', ast_cat_id, asset_data_store);
        
    });

});

</script>

<script type="text/javascript" language="javascript">

/* Location Browser Script*/

var btn_popup_location = null;
var location_name = null;
var location_id = null;
var win_location;
var location_data_store = null;

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
				style: 'margin:1px'
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


});

</script>

<script type="text/javascript" language="javascript">

/* Responsible Person Browser Script*/

var btn_popup_resp_person = null;
var resp_person_name = null;
var resp_person_id = null;
var win_resp_person;
var resp_person_data_store = null;

Ext.onReady(function(){

	var resp_personReader = new Ext.data.ArrayReader({}, [
		{name: 'rec_id'},
		{name: 'resp_person_id'},
		{name: 'resp_person_name'}
	]);	
    
	resp_person_data_store =  new Ext.data.Store({
				reader: resp_personReader
			});

	resp_person_json = Ext.util.JSON.decode('<?php echo $javascript->object($employee_data); ?>');
	resp_person_data_store.loadData(resp_person_json.employee_data);

    grid_resp_person = new Ext.grid.GridPanel({
						store: resp_person_data_store,
						columns: [
							{header: 'Employee ID', width: 100, sortable: true, dataIndex: 'resp_person_id'},
							{header: 'Name', width: 310, sortable: true, dataIndex: 'resp_person_name'}
						],
						height: 350,
						width: 420  
					});
					
    grid_resp_person.on('rowdblclick', function(sm, row_index, r) {
					record = grid_resp_person.getStore().getAt(row_index);
					p_name = record.get('resp_person_name');

					resp_person_name.setValue(p_name);
					resp_person_id = record.get('rec_id');
					
					win_resp_person.hide(this);
				});

    resp_person_name = new Ext.form.TextField({
				id: 'resp_person_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				width: 300,
				disabled: true,
				renderTo: 'cnt_resp_person_name',
				msgTarget: 'under',
				allowBlank:false,
				style: 'margin:1px;'
    		});

    btn_popup_resp_person = new Ext.Button({
							text: '',
							id: 'btn_popup_resp_person',
							icon: '/img/data_browser_view.png',
							minWidth: 50,
							renderTo: 'cnt_resp_person_btn',
							disabled: true,
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
<script>
var status_div = null;
var branch = null;

Ext.onReady(function(){

	// Get the data for branch selection drop down list
	branch_json = Ext.util.JSON.decode('<?php echo $javascript->object($branch_data); ?>');
	
	branch = new Ext.form.ComboBox({
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
    		    allowBlank:true
    });

	branch.on('select', function() {
					btn_popup_location.enable();
				});

    status_div = Ext.get('status_div');
});
</script>


<script>
function save() {
	parameters = null;

/*
	if(!is_form_valid()) {
		Ext.MessageBox.alert("FAMS", "Please check the values you have entered.");
		return false;
	}
*/	
	
	parameters = {
			asset_id: ast_id,
			location_id: location_id,
			person_id: resp_person_id
	};

	ajaxClass.request({
			   url: '/assets/change_location_update',
			   params: parameters,
			   callback : function(options, success, response) { 
			   				obj = Ext.util.JSON.decode(response.responseText);

			   				display_message("Record saved successfully");
  							
  							get_data_for_browser('D', ast_id, null);						

	   			}
			});
	
}
function cancel() {
	clear();

	disable_fields(true);
}

// Clear all text fields and error messages
function clear() {

	ast_cat_name.setValue(''); ast_cat_name.clearInvalid();
	ast_cat_id = '';

	ast_name.setValue(''); ast_name.clearInvalid();
	ast_id = '';
	
	location_name.setValue(''); location_name.clearInvalid();
	location_id = '';
	
	resp_person_name.setValue(''); resp_person_name.clearInvalid();
	resp_person_id = '';

	branch.setValue('');

	document.getElementById('cur_branch').innerHTML = '';
	document.getElementById('cur_location').innerHTML = '';
	document.getElementById('cur_custodian').innerHTML = '';

}
function disable_fields(bool) {
	btn_popup_ast.setDisabled(bool);
	btn_popup_location.setDisabled(bool);
	btn_popup_resp_person.setDisabled(bool);
	
	branch.setDisabled(bool);
}

function display_message(text) {
	status_div.highlight("ffffff");		
	status_div.insertHtml("beforeEnd", text);
	setTimeout("status_div.dom.innerHTML=''", 5000);
}

function is_form_valid() {
	/*
	return (ast_asset_code.validate() &&
				ast_short_name.validate() &&
				ast_description.validate() &&
				ast_asset_category.validate() &&
				ast_supplier.validate() &&
				ast_purchase_price.validate() &&
				ast_purchase_date.validate() &&
				ast_lifespan.validate() &&
				ast_salvage_value.validate() );
	*/
}

function get_data_for_browser(request_type, type_id, grid_data_store) {
	ajaxClass.request({
			   url: '/assets/change_location_browsers',
			   params: { 
			   			request_type: request_type,
			   			type_id: type_id
	   			},
			   callback : function(options, success, response) { 
			   				obj = Ext.util.JSON.decode(response.responseText);
			   				
			   				// If type is not an asset information request
			   				if(obj.request_type == 'D') {
			   					document.getElementById('cur_branch').innerHTML = obj.grid_data[0].branch;
			   					branch.setValue(obj.grid_data[0].branch_id);

			   					document.getElementById('cur_location').innerHTML = obj.grid_data[0].location;
								location_name.setValue(obj.grid_data[0].location);
			   					location_id = obj.grid_data[0].location_id;
			   					
			   					document.getElementById('cur_custodian').innerHTML = obj.grid_data[0].custodian;
			   					resp_person_name.setValue(obj.grid_data[0].custodian);
			   					resp_person_id = obj.grid_data[0].custodian_id;
			   					
			   				} else {
			   					grid_data_store.loadData(obj.grid_data);
			   				}
			   				
			   				// If request is for asset browser
			   				if(obj.request_type == 'AL') {
			   					win_ast.show();
			   				}else if(obj.request_type == 'L') {
			   					win_location.show();
			   				}
	   			}
			});
}
</script>

<div id="status_div"></div>

<div id="fields_div">
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="font-weight:bold;color:#15428b;margin-top:5px;border:#8db2e3 2px solid;width:700px;">
			<tr>
				<td align="center">Change Location</td>
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
		<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px">
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#e4ebf6;font-weight:bold;" width="25%">
					Current Branch
				</td>
				<td style="background-color:#ffffff" id="cur_branch">
					<!-- Current branch value-->
				</td>
				<td style="background-color:#e4ebf6;font-weight:bold" width="25%">
					Current Location
				</td>
				<td style="background-color:#ffffff" id="cur_location">
					<!-- Current location value-->
				</td>
			</tr>
			<tr>
				<td style="background-color:#e4ebf6;font-weight:bold">
					Responsible Person
				</td>
				<td colspan="3" style="background-color:#ffffff" id="cur_custodian">
					<!-- Responsible person value-->
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
		</table>	
	</div>
	
	<div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px">
			<tr>
				<td colspan="5" style="height:10px"></td>
			</tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td width="22%">New Branch</td>
				<td width="1%">:</td>
				<td width="20%" id="cnt_branch"><!-- branch container--></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td>New Location</td>
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
		</table>
		</div>
</div>

<!-- Containers for popup windows -->
<div id="cnt_asst_cat_browser" class="x-hidden"><!--asset category browser container--></div>
<div id="cnt_asst_browser" class="x-hidden"><!--asset browser container--></div>
<div id="cnt_location_browser" class="x-hidden"><!-- location browser container--></div>
<div id="cnt_resp_person_browser" class="x-hidden"><!-- location person browser container --></div>

<?php echo $this->renderElement('command_buttons_mini'); ?>
