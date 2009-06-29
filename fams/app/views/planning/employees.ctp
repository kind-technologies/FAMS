<script type="text/javascript" language="javascript">
/*
 * Grid Area
 */


Ext.onReady(function() {
	var myData = [
		['Apple',29.89,0.24,0.81,'9/1 12:00am'],
		['Ext',83.81,0.28,0.34,'9/12 12:00am'],
		['Google',71.72,0.02,0.03,'10/1 12:00am'],
		['Microsoft',52.55,0.01,0.02,'7/4 12:00am'],
		['Yahoo!',29.01,0.42,1.47,'5/22 12:00am'],
		['Yahoo!',29.01,0.42,1.47,'5/22 12:00am'],
		['Yahoo!',29.01,0.42,1.47,'5/22 12:00am']		
	];
	
	var myReader = new Ext.data.ArrayReader({}, [
		{name: 'company'},
		{name: 'price', type: 'float'},
		{name: 'change', type: 'float'},
		{name: 'pctChange', type: 'float'},
		{name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'}
	]);	
	
	var grid = new Ext.grid.GridPanel({
			store: new Ext.data.Store({
				data: myData,
				reader: myReader
			}),
			columns: [
				{header: 'Company', width: 120, sortable: true, dataIndex: 'company'},
				{header: 'Price', width: 90, sortable: true, dataIndex: 'price'},
				{header: 'Change', width: 90, sortable: true, dataIndex: 'change'},
				{header: '% Change', width: 90, sortable: true, dataIndex: 'pctChange'},
				{header: 'Last Updated', width: 320, sortable: true, 
					renderer: Ext.util.Format.dateRenderer('m/d/Y'), 
				                dataIndex: 'lastChange'}
			],
			viewConfig: {
				forceFit: true,
			 	fitContainer: true
			},
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
	
	grid.getSelectionModel().selectFirstRow();
	
});
</script>

<script type="text/javascript" language="javascript">
/*
 * Tab area
 */

Ext.onReady(function(){
    // basic tabs 1, built from existing content
    var tabs = new Ext.TabPanel({
        renderTo: 'fields_div',
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
		height: 250
    });

});
</script>

<script type="text/javascript" language="javascript">
/*
 * Ajax Call
 */
Ext.onReady(function(){
	Ext.get('okButton').on('click', function(){
		var msg = Ext.get('msg');
		msg.load({
			url: '/planning/emplayee_update', // <-- change if necessary
			params: 'name=' + Ext.get('name').dom.value,
			text: 'Updating...'
		});
		msg.show();
	});
});
</script>

<script type="text/javascript" language="javascript">
Ext.onReady(function(){
	
	function add() {
		alert('hi add');
	}
	
	function edit() {
		alert('hi edit');
	}

	function del() {
		alert('hi delete');
	}
	
	
	var btnAdd = new Ext.Button({
		text: 'Add',
		handler: add,
		id: 'add_button',
		renderTo: add_
	});
	
	var btnEdit = new Ext.Button({
		text: 'Edit',
		handler: edit,
		id: 'edit_button',
		renderTo: edit_
	});
	
	var btnDelete = new Ext.Button({
		text: 'Delete',
		handler: del,
		id: 'delete_button',
		renderTo: del_
	});

	var btnSave = new Ext.Button({
		text: 'Save',
		handler: del,
		id: 'save_button',
		renderTo: save_
	});
	
	var btnClear = new Ext.Button({
		text: 'Clear',
		handler: del,
		id: 'Clear_button',
		renderTo: clear_
	});
	
});
</script>


<div id="title_div">&nbsp;</div>
<div id="grid_area" style="width:100%"></div>

<div id="fields_div" style="margin-top:5px">
    <div id="tab1">
		<div>
    		Name: <input type="text" id="name" />
    		<input type="button" id="okButton" value="OK" />
		</div>
		<div id="msg"></div>        
    </div>

    <div id="tab2">
        
    </div>
</div>

<div id="buttons_div" style="margin-top:10px; padding:5px">
	<!-- New / Edit / Save / Delete/ Clear-->
	<div id="left_buttons" style="float:left">
		<table>
			<tr>
				<td id="add_"></td><td id="edit_"></td><td id="del_"></td>
			</tr>
		</table>
	</div>
	<div id="right_buttons" style="float:right">
		<table>
			<tr>
				<td id="save_"></td><td id="clear_"></td>
			</tr>
		</table>
	</div>
</div>



