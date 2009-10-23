<?php echo $this->renderElement('common_js_objects'); ?>

<script type="text/javascript" language="javascript">
Ext.chart.Chart.CHART_URL = "<?php echo $this->base ?>/js/ext-3.0.0/resources/charts.swf";

var graph_store = null;

Ext.onReady(function(){

	var graph_reader = new Ext.data.ArrayReader({}, [
		{name: 'date_at'},
		{name: 'accumulate'},
		{name: 'depreciate'}
	]);	
    
	graph_store =  new Ext.data.Store({
				reader: graph_reader
			});


	//graph_json = Ext.util.JSON.decode('<?php echo $javascript->object($graph_data); ?>');
	//graph_store.loadData(graph_json.graph_data);

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
            store: graph_store,
            url: Ext.chart.Chart.CHART_URL,
            xField: 'date_at',
            yAxis: new Ext.chart.NumericAxis({
                displayName: 'Accumulated Amt.',
                labelRenderer : Ext.util.Format.numberRenderer('0,0.00')
            }),
            tipRenderer : function(chart, record, index, series){
                if(series.yField == 'accumulate'){
                    return ' accumulated depreciation at ' + 
                    			record.data.date_at + '(' + Ext.util.Format.number(record.data.accumulate, '0,0.00') + ')';
                }else{
                    return ' net book value at ' + record.data.date_at + '(' +Ext.util.Format.number(record.data.depreciate, '0,0.00') + ')';
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
                displayName: 'Depreciate',
                yField: 'depreciate',
                style: {
                    image:'bar.gif',
                    mode: 'stretch',
                    color:0x99BBE8
                }
            },{
                type:'line',
                displayName: 'Accumulate',
                yField: 'accumulate',
                style: {
                    color: 0x15428B
                }
            }]
        }
    });
});
</script>

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
		get_data_for_browser('A', ast_cat_id, asset_data_store);
        
    });

});

</script>

<script>
function get_data_for_browser(request_type, type_id, grid_data_store) {
	ajaxClass.request({
			   url: '/depreciation/depreciation_report_browsers',
			   params: { 
			   			request_type: request_type,
			   			type_id: type_id
	   			},
			   callback : function(options, success, response) { 
			   				obj = Ext.util.JSON.decode(response.responseText);
			   				
			   							   				// If type is not an asset information request
			   				if(obj.request_type == 'D') {
								document.getElementById('cnt_comm_date').innerHTML = obj.grid_data[0].com_date;
								document.getElementById('cnt_acc_dep').innerHTML = obj.grid_data[0].cur_tot_depr;
								document.getElementById('cnt_nbv').innerHTML = obj.grid_data[0].nbv;
			   					graph_store.loadData(obj.grid_data[0].chart_data);
			   				} else {
			   					grid_data_store.loadData(obj.grid_data);
			   				}
			   				
			   				// If request is for asset browser
			   				if(obj.request_type == 'A') {
			   					win_ast.show();
			   				}
	   			}
			});
}
</script>
<!-- Containers for popup windows -->
<div id="cnt_asst_cat_browser" class="x-hidden"><!--asset category browser container--></div>
<div id="cnt_asst_browser" class="x-hidden"><!--asset browser container--></div>
<!-- End containers for popup windows -->


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
					Commencement Date
				</td>
				<td id="cnt_comm_date" style="background-color:#e4ebf6">
					
				</td>
				<td width="20%">&nbsp;</td>
			</tr>
			<tr>
				<td>
					Accumulated Depreciation
				</td>
				<td id="cnt_acc_dep" style="background-color:#e4ebf6">
					
				</td>
				<td>$&nbsp;</td>
			</tr>
			<tr>
				<td>
					Current Book Value
				</td>
				<td id="cnt_nbv" style="background-color:#e4ebf6">
					
				</td>
				<td>$&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

