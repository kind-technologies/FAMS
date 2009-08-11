<?php echo $this->renderElement('common_js_objects'); ?>

<script type="text/javascript" language="javascript">
Ext.chart.Chart.CHART_URL = "<?php echo $this->base ?>/js/ext-3.0.0/resources/charts.swf";

Ext.onReady(function(){

    var store = new Ext.data.JsonStore({
        fields:['name', 'visits', 'views'],
        data: [
            {name:'Jul 07', visits: 3000, views: 17000},
            {name:'Jul 08', visits: 6000, views: 14000},
            {name:'Jul 09', visits: 9000, views: 11000},
            {name:'Jul 10', visits: 12000, views: 8000},
            {name:'Jul 11', visits: 15000, views: 5000}
        ]
    });

    // more complex with a custom look
    new Ext.Panel({
        iconCls:'chart',
        title: 'Depreciation Graph',
        frame:true,
        renderTo: 'graph_container',
        width:700,
        height:300,
        layout:'fit',

        items: {
            xtype: 'columnchart',
            store: store,
            url: Ext.chart.Chart.CHART_URL,
            xField: 'name',
            yAxis: new Ext.chart.NumericAxis({
                displayName: 'Visits',
                labelRenderer : Ext.util.Format.numberRenderer('0,0')
            }),
            tipRenderer : function(chart, record, index, series){
                if(series.yField == 'visits'){
                    return Ext.util.Format.number(record.data.visits, '0,0') + ' visits in ' + record.data.name;
                }else{
                    return Ext.util.Format.number(record.data.views, '0,0') + ' page views in ' + record.data.name;
                }
            },
            chartStyle: {
                padding: 10,
                animationEnabled: true,
                font: {
                    name: 'Tahoma',
                    color: 0x444444,
                    size: 11
                },
                dataTip: {
                    padding: 5,
                    border: {
                        color: 0x99bbe8,
                        size:1
                    },
                    background: {
                        color: 0xDAE7F6,
                        alpha: .9
                    },
                    font: {
                        name: 'Tahoma',
                        color: 0x15428B,
                        size: 10,
                        bold: true
                    }
                },
                xAxis: {
                    color: 0x69aBc8,
                    majorTicks: {color: 0x69aBc8, length: 4},
                    minorTicks: {color: 0x69aBc8, length: 2},
                    majorGridLines: {size: 1, color: 0xeeeeee}
                },
                yAxis: {
                    color: 0x69aBc8,
                    majorTicks: {color: 0x69aBc8, length: 4},
                    minorTicks: {color: 0x69aBc8, length: 2},
                    majorGridLines: {size: 1, color: 0xdfe8f6}
                }
            },
            series: [{
                type: 'column',
                displayName: 'Page Views',
                yField: 'views',
                style: {
                    image:'bar.gif',
                    mode: 'stretch',
                    color:0x99BBE8
                }
            },{
                type:'line',
                displayName: 'Visits',
                yField: 'visits',
                style: {
                    color: 0x15428B
                }
            }]
        }
    });
});
</script>

<script type="text/javascript" language="javascript">
var btn_popup_ast_cat = null;
var btn_popup_asset = null;

var ast_cat_name = null;
var asset_name = null;

var ast_cat_id = null;
var asset_id = null;

var win_ast_cat;
var win_ast;

var grid_asset_cat_data_store = null;
var grid_asset_cat = null;

var grid_asset_data_store = null;
var grid_asset = null;


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
           {name: 'ast_cat_desc'}
	 	]
    });
    
	store.loadData(myData);

    grid_asset_cat = new Ext.grid.GridPanel({
						store: store,
						columns: [
						   /* {header: 'Price', width: 75, sortable: true, renderer: 'usMoney', dataIndex: 'ast_cat_id'},*/
							{header: 'Category Code', width: 100, sortable: true, dataIndex: 'ast_cat_code'},
							{header: 'Description', width: 310, sortable: true, dataIndex: 'ast_cat_desc'}
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
    
	// Data grid for Asset Browser

	var myData2 = [
        [0, 'AAA', 'AAAAAAAAAAAAAAAA'],
        [1, 'BBB', 'BBBBBBBBBBBBBBBB'],
        [2, 'CCC', 'CCCCCCCCCCCCCCCC'],
        [3, 'DDD', 'DDDDDDDDDDDDDDDD'],
        [4, 'EEE', 'EEEEEEEEEEEEEEEE'],
        [5, 'FFF', 'FFFFFFFFFFFFFFFF']
    ];
    
    var store2 = new Ext.data.ArrayStore({
        fields: [
           {name: 'ast_cat_id', type: 'int'},
           {name: 'ast_cat_code'},
           {name: 'ast_cat_desc'}
	 	]
    });
    
	store2.loadData(myData2);

    grid_asset = new Ext.grid.GridPanel({
						store: store2,
						columns: [
						   /* {header: 'Price', width: 75, sortable: true, renderer: 'usMoney', dataIndex: 'ast_cat_id'},*/
							{header: 'Category Code', width: 100, sortable: true, dataIndex: 'ast_cat_code'},
							{header: 'Description', width: 310, sortable: true, dataIndex: 'ast_cat_desc'}
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

});

Ext.onReady(function(){
    ast_cat_name = new Ext.form.TextField({
				id: 'ast_cat_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				maxLength : 5,
				width: 300,
				disabled: true,
				renderTo: 'cnt_asset_cat',
				msgTarget: 'under',
				allowBlank:false
    		});
    
    asset_name = new Ext.form.TextField({
				id: 'asset_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				maxLength : 5,
				width: 300,
				disabled: true,
				renderTo: 'cnt_asset',
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

    btn_popup_asset = new Ext.Button({
							text: '',
							id: 'btn_popup_asset',
							icon: '/img/data_browser_view.png',
							minWidth: 50,
							renderTo: 'cnt_asset_btn'
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
    
	btn_popup_asset.on('click', function() {
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


<div id="fields_div">
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
			<tr>
				<td width="50px">&nbsp;</td>
				<td width="150px"> Asset Category	</td>
				<td id="cnt_asset_cat" width="300px"><!--asset category name container--></td>
				<td id="cnt_asset_cat_btn"><!--asset category load button container--></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td> Asset </td>
				<td id="cnt_asset"><!--asset name container--></td>
				<td id="cnt_asset_btn"><!--asset name load button container--></td>
			</tr>
		</table>
	</div>
	<div align="center" id="graph_container">
    
	</div>
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px">
			<tr>
				<td width="30%">
					Start Date
				</td>
				<td style="background-color:#e4ebf6">
					
				</td>
			</tr>
			<tr>
				<td>
					Accumulated Depreciation
				</td>
				<td style="background-color:#e4ebf6">
					
				</td>
			</tr>
			<tr>
				<td>
					Current Book Value
				</td>
				<td style="background-color:#e4ebf6">
					
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="cnt_asst_cat_browser" class="x-hidden"><!--asset category browser container--></div>
<div id="cnt_asst_browser" class="x-hidden"><!--asset browser container--></div>


