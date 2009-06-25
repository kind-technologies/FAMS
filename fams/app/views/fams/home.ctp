<script>
Ext.onReady(function() {

	// Note: For the purposes of following along with the tutorial, all 
	// new code should be placed inside this method.  Delete the following
	// line after you have verified that Ext is installed correctly.
	
	//alert("Congratulations!  You have Ext configured correctly!");

	var myDiv = Ext.get('myDiv');

	var btnClick = function(e) {
		myDiv.highlight();
		//myDiv.addClass('red');  // Add a custom CSS class (defined in ExtStart.css)
		//myDiv.center();         // Center the element in the viewport
		//myDiv.setOpacity(.25);
		//alert('Clicked');
		//alert(myDiv.dom.innerHTML);
	}

	Ext.get('myButton').on('click', btnClick);

var myData = [
			['Apple',29.89,0.24,0.81,'9/1 12:00am'],
			['Ext',83.81,0.28,0.34,'9/12 12:00am'],
			['Google',71.72,0.02,0.03,'10/1 12:00am'],
			['Microsoft',52.55,0.01,0.02,'7/4 12:00am'],
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
				{header: 'Last Updated', width: 120, sortable: true, 
					renderer: Ext.util.Format.dateRenderer('m/d/Y'), 
				                dataIndex: 'lastChange'}
			],
			viewConfig: {
				forceFit: true
			},
			renderTo: 'content',
			title: 'My First Grid',
			width: 500,
			autoHeight: true,
			frame: true
		});
	 
		grid.getSelectionModel().selectFirstRow();

});
</script>

<div id="content" style="background-color: #d3e1f1;">    	<div id="myDiv">This is a test div.</div>	    	<input type="button" id="myButton" value="My Button" />
</div>
