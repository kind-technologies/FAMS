<?php echo $this->renderElement('common_js_objects'); ?>

<script type="text/javascript" language="javascript">
/*
 * Grid Area
 */
var grid = null;
var current_row_index = 0;

Ext.onReady(function() {
	/*
	// Sample data set, replaced with data from DB
	var empData = [
		['00001', 'MMCK Bandara', '94716833516', 'CMB','WEB', '04/11/1981', 'Chaminda Keerthi Bandara', 'M', '811021938V', '113/4, Kithulawila Uyana, Kiriwattuduwa', 1],
		['00002', 'MN Chaturanga', '94716833516', 'CMB','WEB', '05/23/1981', 'Nuwan Chaturanga', 'M', '811021938V', '', '', 2],
		['00003', 'J Cluff', '94716833516', 'UTH','MGT', '03/30/1955', 'James Cluff', 'M', '811021938V', '', '', 3],
		['00004', 'D Praneeth', '94716833516', 'UTH','MGT', '09/12/1965', 'Dihan Praneeth', 'M', '811021938V', '', '', 4],
		['00005', 'N Pradeep', '94716833516', 'CMB','MGT', '08/15/1974', 'Nishan Pradeep', 'M', '811021938V', '', '', 5],
		['00006', 'DD Weerasinghe', '94716833516', 'CMB','WEB', '08/21/1980', 'Darshika Weerasinghe', 'F', '811021938V', '', '', 6],
		['00007', 'N Kodithuwakku', '94716833516', 'CMB','WEB', '05/13/1983', 'Nishchala Kodithuwakku', 'F', '811021938V', '', '', 7]		
	];
	*/
	
	var empData = <?php echo $emp_data; ?>;
	
	var empReader = new Ext.data.ArrayReader({}, [
		{name: 'emp_empid'},
		{name: 'emp_name'},
		{name: 'emp_contact'},
		{name: 'emp_branch'},
		{name: 'emp_div'},
		{name: 'emp_dob', type: 'date', dateFormat: 'm/d/Y'}, /* : float */
		{name: 'emp_full_name'},
		{name: 'emp_gender'},
		{name: 'emp_nid'},
		{name: 'emp_address'},
		{name: 'rec_id', type: 'int'}
	]);	
	
	grid = new Ext.grid.GridPanel({
			store: new Ext.data.Store({
				data: empData,
				reader: empReader
			}),
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
		emp_nid.setValue(r.data['emp_nid']);
		emp_address.setValue(r.data['emp_address']);
		emp_phone.setValue(r.data['emp_contact']);
		emp_branch.setValue(r.data['emp_branch']);
		emp_division.setValue(r.data['emp_div']);
		
		current_row_index = row_index;
		
		
		
	});
	
	
});
</script>

<script type="text/javascript" language="javascript">
/*
 * Tab area
 */

Ext.onReady(function(){

    var tabs = new Ext.TabPanel({
        renderTo: 'fields_div',
        id:'tab_panel',
        activeTab: 0,
        frame:true,
        defaults:{autoHeight: true},
        items:[
            {contentEl:'tab1', title: 'Emp. Details'},
            {contentEl:'tab2', title: 'Additional Info'}
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
var emp_nid = null;
var emp_address = null;
var emp_phone = null;
var emp_branch = null;
var emp_division = null;

var rec_id = null;
var action = null;

var status_div = null;
	
Ext.onReady(function(){
    emp_id = new Ext.form.TextField({
    			id: 'txt_emp_id',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_emp_id'
    });

	emp_full_name = new Ext.form.TextField({
    			id: 'txt_full_name',
    			width: 700,
    			disabled: true,
    		    renderTo: 'cnt_full_name'
    });

	emp_name_with_init = new Ext.form.TextField({
    			id: 'txt_name_with_init',
    			width: 400,
    			disabled: true,
    		    renderTo: 'cnt_name_with_init'
    });
    
	emp_dob = new Ext.form.DateField({
    			id: 'dat_emp_id',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_dob'
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

	emp_nid = new Ext.form.TextField({
    			id: 'txt_nid',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_nid'
    });
    
	emp_address = new Ext.form.TextField({
    			id: 'txt_address',
    			width: 700,
    			disabled: true,
    		    renderTo: 'cnt_address'
    });

	emp_phone = new Ext.form.TextField({
    			id: 'txt_phone',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_phone'
    });

	emp_branch = new Ext.form.TextField({
    			id: 'txt_branch',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_branch'
    });

	emp_division = new Ext.form.TextField({
    			id: 'txt_division',
    			width: 200,
    			disabled: true,
    		    renderTo: 'cnt_division'
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
		//alert(Ext.get('txt_emp_id').dom.value);
		clear();
		disable_fields(false);
		btn_edit.setDisabled(true);
		btn_delete.setDisabled(true);
		btn_save.setDisabled(false);
		grid.setDisabled(true);
	}
	
	function edit() {
		disable_fields(false);
		btn_add.setDisabled(true);
		btn_delete.setDisabled(true);
		btn_save.setDisabled(false);
		grid.setDisabled(true);
	}

	function del() {
		

		status_div.highlight();
		//myDiv.addClass('red');  // Add a custom CSS class (defined in ExtStart.css)
		//myDiv.center();         // Center the element in the viewport
		//myDiv.setOpacity(.25);
		//alert('Clicked');
		//alert(myDiv.dom.innerHTML);

	}

	function save() {

		ajaxClass.on('beforerequest', show_mask);
		ajaxClass.on('requestcomplete', hide_mask); 
		
		ajaxClass.request({
				   url: '/planning/emplayee_update',
				   /*success: someFn,
				   failure: otherFn,
				   headers: {
					   'my-header': 'foo'
				   },*/
				   params: { name: Ext.get('txt_emp_id').dom.value },
				   callback : function(options, success, response) { 
				   				alert('got the response : ' 
				   								+ response.responseText);
				   			}
				});
		
	}
	
	function cancel() {
		clear();
		grid.getSelectionModel().deselectRow(current_row_index);
		disable_fields(true);
		grid.setDisabled(false);
	}

	
	// Clear all text fields
	function clear() {
		emp_id.setValue('');
		emp_full_name.setValue('');
		emp_name_with_init.setValue('');
		emp_dob.setValue('');
		emp_gender.setValue('');
		emp_nid.setValue('');
		emp_address.setValue('');
		emp_phone.setValue('');
		emp_branch.setValue('');
		emp_division.setValue('');

		rec_id.setValue('');
		action.setValue('');
		
		
	}

	function disable_fields(bool) {
		emp_id.setDisabled(bool);
		emp_full_name.setDisabled(bool);
		emp_name_with_init.setDisabled(bool);
		emp_dob.setDisabled(bool);
		emp_gender.setDisabled(bool);
		emp_nid.setDisabled(bool);
		emp_address.setDisabled(bool);
		emp_phone.setDisabled(bool);
		emp_branch.setDisabled(bool);
		emp_division.setDisabled(bool);
	}
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
				<td id="cnt_gender"><!-- gender (ext gen.) --></td>
			</tr>
			<tr>
				<td>National ID</td>
				<td width="5px">:</td>
				<td colspan="4" id="cnt_nid"><!-- NID (ext gen.) --></td>
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
        
    </div>
</div>

<?php echo $this->renderElement('command_buttons'); ?>




