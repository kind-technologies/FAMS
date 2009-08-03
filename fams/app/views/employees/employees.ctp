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
	
	// Sample data set, replaced with data from DB
	/*
	empData_test = [
		['00001', 'MMCK Bandara', '94716833516', 'CMB','WEB', '04/11/1981', 'Madakumbure Keerthi Bandara', 'M', '811021938V', '113/4, Kithulawila Uyana, Kiriwattuduwa', 1],
		['00002', 'MN Chaturanga', '94716833516', 'CMB','WEB', '05/23/1981', 'Nuwan Chaturanga', 'M', '811021938V', '', '', 2],
		['00003', 'J Cluff', '94716833516', 'UTH','MGT', '03/30/1955', 'James Cluff', 'M', '811021938V', '', '', 3],
		['00004', 'D Praneeth', '94716833516', 'UTH','MGT', '09/12/1965', 'Dihan Praneeth', 'M', '811021938V', '', '', 4],
		['00005', 'N Pradeep', '94716833516', 'CMB','MGT', '08/15/1974', 'Nishan Pradeep', 'M', '811021938V', '', '', 5],
		['00006', 'DD Weerasinghe', '94716833516', 'CMB','WEB', '08/21/1980', 'Darshika Weerasinghe', 'F', '811021938V', '', '', 6],
		['00007', 'N Kodithuwakku', '94716833516', 'CMB','WEB', '05/13/1983', 'Nishchala Kodithuwakku', 'F', '811021938V', '', '', 7]		
	];
	*/
	
	
	//var empData = <?php echo $emp_data; ?>;
	
	var empReader = new Ext.data.ArrayReader({}, [
		{name: 'emp_empid'},
		{name: 'emp_name'},
		{name: 'emp_contact'},
		{name: 'emp_branch'},
		{name: 'emp_div'},
		{name: 'emp_dob', type: 'date', dateFormat: 'm/d/Y'}, /* : float */
		{name: 'emp_full_name'},
		{name: 'emp_gender'},
		{name: 'emp_email'},
		{name: 'emp_address'},
		{name: 'rec_id', type: 'int'},
		{name: 'emp_branch_id'},
		{name: 'emp_div_id'}
	]);	
	
	
	grid_data_store =  new Ext.data.Store({
				reader: empReader
			});


	employees_json = Ext.util.JSON.decode('<?php echo $javascript->object($employee_data); ?>');
	grid_data_store.loadData(employees_json.employee_data);

	
	grid = new Ext.grid.GridPanel({
			store: grid_data_store,
			columns: [
				{header: 'Emp. ID', width: 120, sortable: true, dataIndex: 'emp_empid'},
				{header: 'Name', width: 90, sortable: true, dataIndex: 'emp_name'},
				{header: 'Contact No.', width: 90, sortable: true, dataIndex: 'emp_contact'},
				{header: 'Branch', width: 90, sortable: true, dataIndex: 'emp_branch'},
				{header: 'Division', width: 90, sortable: true, dataIndex: 'emp_div'}
				/*{header: 'Last Updated', width: 320, sortable: true, 
					renderer: Ext.util.Format.dateRenderer('m/d/Y'), 
				                dataIndex: 'lastChange'}*/
			],
			viewConfig: {
				forceFit: true,
			 	fitContainer: true
			},
			sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
			renderTo: 'grid_area',
			title: 'Employees',
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
		emp_id.setValue(r.data['emp_empid']);
		emp_full_name.setValue(r.data['emp_full_name']);
		emp_name_with_init.setValue(r.data['emp_name']);
		emp_dob.setValue(r.data['emp_dob']);

		if(r.data['emp_gender'] == 'M'){
			emp_gender.items.get(0).setValue(true);
			emp_gender.items.get(1).setValue(false);
		} else {
			emp_gender.items.get(0).setValue(false);
			emp_gender.items.get(1).setValue(true);
		}
		emp_email.setValue(r.data['emp_email']);
		emp_address.setValue(r.data['emp_address']);
		emp_phone.setValue(r.data['emp_contact']);
		
		emp_branch.focus();
		emp_branch.setValue(r.data['emp_branch_id'], true);
		emp_division.focus();
		emp_division.setValue(r.data['emp_div_id'], true);
		rec_id.setValue(r.data['rec_id'], true);
		current_row_index = row_index;
		
		// clear photo when moving among records
		document.getElementById('cnt_emp_image').innerHTML = '';
		
		
		// enable the second tab
		tabs.items.get(1).setDisabled(false);
		
		// fill the hidden field for photo upload
		file_upload_form.get('hdn_upld_emp_id').setValue(r.data['rec_id'], true);
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
            {contentEl:'tab1', title: 'Emp. Details'},
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
var emp_id = null;
var emp_full_name = null;
var emp_name_with_init = null;
var emp_dob = null;
var emp_gender = null;
var emp_email = null;
var emp_address = null;
var emp_phone = null;
var emp_branch = null;
var emp_division = null;

var rec_id = null;
var action = null;

var status_div = null;

var btn_popup_upload = null;
var btn_load_image = null;


Ext.onReady(function(){
    emp_id = new Ext.form.TextField({
    			id: 'txt_emp_id',
    			validateOnBlur: true,
    			invalidText: 'The value in this field is invalid',
    			maxLength : 5,
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_emp_id',
    		    msgTarget: 'under',
    		    allowBlank:false
    });

	emp_full_name = new Ext.form.TextField({
    			id: 'txt_full_name',
    			width: 600,
    			disabled: true,
    		    renderTo: 'cnt_full_name',
    		    allowBlank:false
    });

	emp_name_with_init = new Ext.form.TextField({
    			id: 'txt_name_with_init',
    			width: 400,
    			disabled: true,
    		    renderTo: 'cnt_name_with_init',
    		    allowBlank:false
    });
    
	emp_dob = new Ext.form.DateField({
    			id: 'dat_emp_id',
    			width: 200,
    			disabled: true,
    			format: 'm/d/Y',
    		    renderTo: 'cnt_dob',
    		    allowBlank:false
    });

	emp_gender = new Ext.form.RadioGroup({
    			id: 'rdg_gender',
    			width: 150,
    			disabled: true,
    			items: [{
                        checked: true,
                        id: 'opt_male',
                        boxLabel: 'Male',
                        name: 'rdo_gender',
                        inputValue: 'M'
                    },{
                    		checked: false,
                    		id: 'opt_female',
                        boxLabel: 'Female',
                        name: 'rdo_gender',
                        inputValue: 'F'
                    }],
    		    renderTo: 'cnt_gender'
    });

	emp_email = new Ext.form.TextField({
    			id: 'txt_email',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_email',
			vtype:'email',
			vtypeText:"The from field should be an email address in the format of user@domain.com",
    		    allowBlank:false
    });
    
	emp_address = new Ext.form.TextField({
    			id: 'txt_address',
    			width: 600,
    			disabled: true,
    		    renderTo: 'cnt_address',
    		    allowBlank:false
    });

	emp_phone = new Ext.form.TextField({
    			id: 'txt_phone',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_phone',
    		    allowBlank:false
    });

	emp_branch = new Ext.form.ComboBox({
    			id: 'txt_branch',
    			width: 200,
    			disabled: true,
    			editable: false,
    			store: new Ext.data.SimpleStore({
									fields:['bid', 'branch_code'],
									data: [['1', 'STG'], ['2', 'CMB']]
									}),
				valueField: 'bid',
				displayField:'branch_code',
				forceSelection: true,
				mode: 'local',
				triggerAction: 'all',
    		    renderTo: 'cnt_branch',
    		    allowBlank:false
    });

	emp_division = new Ext.form.ComboBox({
    			id: 'txt_division',
    			width: 200,
    			disabled: true,
    			editable: false,
    			lazyInit: false,
    			store: new Ext.data.SimpleStore({
									fields:['id', 'division_code'],
									data: [['1', 'MGT'], ['2', 'WEB']]
								}),
			displayField: 'division_code',
			valueField: 'id',
			mode: 'local',
			triggerAction: 'all',
		    renderTo: 'cnt_division',
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
													   url: '/employees/emplayee_update',
													   params: { 
													   	id: rec_id.getValue(),
													   	action: action.getValue()
													   },
													   callback : function(options, success, response) { 
													   	obj = Ext.util.JSON.decode(response.responseText);
													   	grid_data_store.loadData(obj.employee_data);
													   	//Ext.MessageBox.alert("FAMS", obj.params);
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
				   url: '/employees/emplayee_update',
				   /*success: someFn,
				   failure: otherFn,
				   headers: {
					   'my-header': 'foo'
				   },*/
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
				   				//Ext.MessageBox.alert("FAMS", obj.params);
				   				display_message("Record saved successfully");
				   															
				   				cancel();
								grid.getSelectionModel().selectRow(current_row_index);
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
		emp_id.setValue(''); emp_id.clearInvalid();
		
		emp_full_name.setValue(''); emp_full_name.clearInvalid();
		
		emp_name_with_init.setValue(''); emp_name_with_init.clearInvalid();
		
		emp_dob.setValue(''); emp_dob.clearInvalid();
		
		emp_gender.setValue(''); emp_gender.clearInvalid();
		
		emp_email.setValue(''); emp_email.clearInvalid();
		
		emp_address.setValue(''); emp_address.clearInvalid();
		
		emp_phone.setValue(''); emp_phone.clearInvalid();
		
		emp_branch.setValue(''); emp_branch.clearInvalid();
		
		emp_division.setValue(''); emp_division.clearInvalid();

		rec_id.setValue('');
		action.setValue('');
		
		document.getElementById('cnt_emp_image').innerHTML = '';
		tabs.items.get(1).setDisabled(true);
		tabs.setActiveTab(0);
	}

	function disable_fields(bool) {
		emp_id.setDisabled(bool);
		emp_full_name.setDisabled(bool);
		emp_name_with_init.setDisabled(bool);
		emp_dob.setDisabled(bool);
		emp_gender.setDisabled(bool);
		emp_email.setDisabled(bool);
		emp_address.setDisabled(bool);
		emp_phone.setDisabled(bool);
		emp_branch.setDisabled(bool);
		emp_division.setDisabled(bool);
	}
	
	function display_message(text) {
		
		status_div.insertHtml("beforeEnd", text);
		status_div.highlight();
		setTimeout("status_div.dom.innerHTML=''", 3000);
		//myDiv.addClass('red');  // Add a custom CSS class (defined in ExtStart.css)
		//myDiv.center();         // Center the element in the viewport
		//myDiv.setOpacity(.25);
		//alert('Clicked');
		//alert(myDiv.dom.innerHTML);
	}
	
	function is_form_valid() {
		
		return (	emp_id.validate() &&
					emp_full_name.validate() &&
					emp_name_with_init.validate() &&
					emp_dob.validate() &&
					emp_email.validate() &&
					emp_address.validate() &&
					emp_phone.validate() &&
					emp_branch.validate() &&
					emp_division.validate() );


	}
</script>
<script>
Ext.onReady(function(){

    btn_popup_upload = new Ext.Button({
							text: 'Upload Photo',
							//handler: add,
							id: 'btn_popup_upload',
							icon: '/img/image_add.png',
							minWidth: 100,
							renderTo: cnt_upload_button
						});

    var win;
    
	var upload_success = function(fp, o) {
							//msg('Success', 'Processed file "'+ o.result.employee_data +'" on the server');
							
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
					   		emp_img = document.getElementById('cnt_emp_image');
					   		emp_img.innerHTML = response.responseText;
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
            id: 'hdn_upld_emp_id',
            name: 'hdn_upld_emp_id'
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
	                    url: '/employees/employee_upload_photo',
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
		//handler: add,
		id: 'btn_load_image',
		icon: '/img/load_image.png',
		minWidth: 100,
		renderTo: cnt_load_image
	});
	
	btn_load_image.on('click', function(){
			ajaxClass.request({
					   url: '/employees/employee_load_photo',
					   params: { 
					   			employee_id: emp_id.getValue(), 
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
					<!--employee image container-->
						<div style="background-color:#c6d9f1;border:#d3e1f1 5px solid;width:180px;height:180px" id="cnt_emp_image">
						
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




