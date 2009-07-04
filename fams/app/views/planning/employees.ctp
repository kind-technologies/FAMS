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
		height: 280
    });

});
</script>

<script type="text/javascript" language="javascript">
/*
 * Ajax Call
 */
Ext.onReady(function(){
	Ext.get('okButton').on('click', function(){
		var status_div = Ext.get('status_div');
		status_div.load({
			url: '/planning/emplayee_update', // <-- change if necessary
			params: 'name=' + Ext.get('name').dom.value,
			text: 'Updating...'
		});
		status_div.show();
	});
});
</script>

<script type="text/javascript" language="javascript">
/*
 * Event handlers for buttons
 */

	function add() {
		alert('hi add');
	}
	
	function edit() {
		alert('hi edit');
	}

	function del() {
		alert('hi delete');
	}

	function save() {
		alert('hi save');
	}
	
	function cancel() {
		alert('hi cancel');
	}

</script>

<div id="status_div"></div>

<div id="grid_area" style="width:100%"></div>

<div id="fields_div" style="margin-top:5px">
    <div id="tab1">
		<div>
    		Name: <input type="text" id="name" />
    		<input type="button" id="okButton" value="OK" />
		</div>
    </div>

    <div id="tab2">
        
    </div>
</div>

<?php echo $this->renderElement('command_buttons'); ?>




