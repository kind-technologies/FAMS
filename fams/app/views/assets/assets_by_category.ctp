<?php echo $this->renderElement('common_js_objects'); ?>


<script type="text/javascript" language="javascript">
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
						   /* {header: 'Price', width: 75, sortable: true, renderer: 'usMoney', dataIndex: 'ast_cat_id'},*/
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


<div id="fields_div">
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
			<tr>
				<td width="50px">&nbsp;</td>
				<td width="150px"> Asset Category	</td>
				<td id="cnt_asset_cat" width="300px"><!--asset category name container--></td>
				<td id="cnt_asset_cat_btn"><!--asset category load button container--></td>
			</tr>

		</table>
	</div>
	<div align="center" id="graph_container">
    
	</div>
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:900px">
			<tr>
				<td style="background-color:#e4ebf6">
					Asset Code
				</td>
				<td style="background-color:#e4ebf6">
					Name
				</td>
				<td style="background-color:#e4ebf6">
					Location/Branch
				</td>
				<td style="background-color:#e4ebf6">
					Status
				</td>
				<td style="background-color:#e4ebf6">
					Purchase Date
				</td>
				<td style="background-color:#e4ebf6">
					Purchased Price
				</td>
				<td style="background-color:#e4ebf6">
					Lifespan
				</td>
				<td style="background-color:#e4ebf6">
					Salvage Value
				</td>
			</tr>
	<!--data-->
			<tr>
				<td style="background-color:#ffffff">
					00001
				</td>
				<td style="background-color:#ffffff">
					AMD Athlon 2000+
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					07/14/2006
				</td>
				<td style="background-color:#ffffff">
					36000.00
				</td>
				<td style="background-color:#ffffff">
					48
				</td>
				<td style="background-color:#ffffff">
					4000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#ffffff">
					00002
				</td>
				<td style="background-color:#ffffff">
					IBM Workstation (P IV)
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					08/10/2007
				</td>
				<td style="background-color:#ffffff">
					46000.00
				</td>
				<td style="background-color:#ffffff">
					60
				</td>
				<td style="background-color:#ffffff">
					5000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#ffffff">
					00003
				</td>
				<td style="background-color:#ffffff">
					Apple Mac book (2.4GHz)
				</td>
				<td style="background-color:#ffffff">
					STG/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					05/05/2007
				</td>
				<td style="background-color:#ffffff">
					96000.00
				</td>
				<td style="background-color:#ffffff">
					60
				</td>
				<td style="background-color:#ffffff">
					5000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#ffffff">
					00004
				</td>
				<td style="background-color:#ffffff">
					AMD Athlon (64 Bit)
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					07/01/2006
				</td>
				<td style="background-color:#ffffff">
					54000.00
				</td>
				<td style="background-color:#ffffff">
					48
				</td>
				<td style="background-color:#ffffff">
					4000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#ffffff">
					00005
				</td>
				<td style="background-color:#ffffff">
					IBM PIII 1.8GHz
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					Damaged
				</td>
				<td style="background-color:#ffffff">
					05/12/2005
				</td>
				<td style="background-color:#ffffff">
					32000.00
				</td>
				<td style="background-color:#ffffff">
					36
				</td>
				<td style="background-color:#ffffff">
					2000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#ffffff">
					00006
				</td>
				<td style="background-color:#ffffff">
					Sony Vio Latop
				</td>
				<td style="background-color:#ffffff">
					STG/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					06/14/2006
				</td>
				<td style="background-color:#ffffff">
					85000.00
				</td>
				<td style="background-color:#ffffff">
					48
				</td>
				<td style="background-color:#ffffff">
					5000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#ffffff">
					00007
				</td>
				<td style="background-color:#ffffff">
					Apple iMac 2.6GHz
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					Pending
				</td>
				<td style="background-color:#ffffff">
					06/15/2008
				</td>
				<td style="background-color:#ffffff">
					86000.00
				</td>
				<td style="background-color:#ffffff">
					60
				</td>
				<td style="background-color:#ffffff">
					4000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#ffffff">
					00008
				</td>
				<td style="background-color:#ffffff">
					PIV Assembled PC. 2.6GHz Core 2 Duo
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					08/20/2007
				</td>
				<td style="background-color:#ffffff">
					56000.00
				</td>
				<td style="background-color:#ffffff">
					48
				</td>
				<td style="background-color:#ffffff">
					4000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#ffffff">
					00009
				</td>
				<td style="background-color:#ffffff">
					PIV Assembled PC. 3GHz Core 2 Duo
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					07/14/2006
				</td>
				<td style="background-color:#ffffff">
					36000.00
				</td>
				<td style="background-color:#ffffff">
					48
				</td>
				<td style="background-color:#ffffff">
					4000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#ffffff">
					00010
				</td>
				<td style="background-color:#ffffff">
					Acer Extensa 5630 Notebook
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					05/25/2009
				</td>
				<td style="background-color:#ffffff">
					92000.00
				</td>
				<td style="background-color:#ffffff">
					60
				</td>
				<td style="background-color:#ffffff">
					5000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>

			<tr>
				<td style="background-color:#ffffff">
					00011
				</td>
				<td style="background-color:#ffffff">
					HP Notebook.
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					04/16/2009
				</td>
				<td style="background-color:#ffffff">
					106000.00
				</td>
				<td style="background-color:#ffffff">
					60
				</td>
				<td style="background-color:#ffffff">
					5000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>

		<tr>
				<td style="background-color:#ffffff">
					00012
				</td>
				<td style="background-color:#ffffff">
					Dell 3GHz Core2 Duo
				</td>
				<td style="background-color:#ffffff">
					STG/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					05/05/2008
				</td>
				<td style="background-color:#ffffff">
					67000.00
				</td>
				<td style="background-color:#ffffff">
					36
				</td>
				<td style="background-color:#ffffff">
					4000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>

		<tr>
				<td style="background-color:#ffffff">
					00013
				</td>
				<td style="background-color:#ffffff">
					Sun Workstation (2.2GHz)
				</td>
				<td style="background-color:#ffffff">
					STG/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					05/14/2006
				</td>
				<td style="background-color:#ffffff">
					65000.00
				</td>
				<td style="background-color:#ffffff">
					60
				</td>
				<td style="background-color:#ffffff">
					3000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>

		<tr>
				<td style="background-color:#ffffff">
					00014
				</td>
				<td style="background-color:#ffffff">
					Acer Aspire (2.4GHz) Core2 Duo
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					03/23/2008
				</td>
				<td style="background-color:#ffffff">
					86000.00
				</td>
				<td style="background-color:#ffffff">
					48
				</td>
				<td style="background-color:#ffffff">
					4000.00
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>

		<tr>
				<td style="background-color:#ffffff">
					00015
				</td>
				<td style="background-color:#ffffff">
					Assembled PC AMD AthlonXP
				</td>
				<td style="background-color:#ffffff">
					CMB/HO
				</td>
				<td style="background-color:#ffffff">
					In Use
				</td>
				<td style="background-color:#ffffff">
					03/17/2006
				</td>
				<td style="background-color:#ffffff">
					36000.00
				</td>
				<td style="background-color:#ffffff">
					36
				</td>
				<td style="background-color:#ffffff">
					2000.00
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="cnt_asst_cat_browser" class="x-hidden"><!--asset category browser container--></div>
<div id="cnt_asst_browser" class="x-hidden"><!--asset browser container--></div>


