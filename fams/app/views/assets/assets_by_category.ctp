<?php echo $this->renderElement('common_js_objects'); ?>


<script type="text/javascript" language="javascript">
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

					document.getElementById('hdn_ast_cat_name').value = cat_name;
					document.getElementById('hdn_ast_cat_id').value = ast_cat_id;
					
					document.getElementById('frm_ast_cat').submit();
				});

    ast_cat_name = new Ext.form.TextField({
				id: 'ast_cat_name',
				validateOnBlur: true,
				invalidText: 'The value in this field is invalid',
				width: 300,
				disabled: true,
				renderTo: 'cnt_asset_cat',
				msgTarget: 'under',
				allowBlank:false,
				value: '<?php echo @$ast_cat_name; ?>'
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
    	<form id="frm_ast_cat" method="post" action="/assets/assets_by_category">
			<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
				<tr>
					<td width="50px">
						<input type="hidden" id="hdn_ast_cat_id" name="hdn_ast_cat_id">
						<input type="hidden" id="hdn_ast_cat_name" name="hdn_ast_cat_name">
					</td>
					<td width="150px"> Asset Category	</td>
					<td id="cnt_asset_cat" width="300px"><!--asset category name container--></td>
					<td id="cnt_asset_cat_btn"><!--asset category load button container--></td>
				</tr>
			</table>
		</form>
	</div>
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<?php 
		
		if($rpt_status === 1) {
			foreach($asset_list as $asset) { 
		?>
			<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px">
				<tr>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Asset Code
					</td>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Name
					</td>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Location
					</td>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Status
					</td>
				</tr>
				<!--data-->
				<tr>
					<td style="background-color:#ffffff">
						<?php echo $asset[1]; ?>
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[2]; ?>
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[11]['location_code']; ?>
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[12]; ?>
					</td>
				</tr>
				<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
				<tr>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Purchase Date
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[7]; ?>
					</td>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Purchased Price
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[6]; ?>
					</td>
				</tr>
				<tr>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Lifespan
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[8]; ?> (Months)
					</td>
					<td style="background-color:#e4ebf6;font-weight:bold">
						Salvage Value
					</td>
					<td style="background-color:#ffffff">
						<?php echo $asset[9]; ?>
					</td>
				</tr>
				<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			</table>
		<?php
			}
		} elseif ($rpt_status === 2) {
		?>
			<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
				<tr>
					<td width="150px" align="center"> No data found </td>
				</tr>
			</table>		
		<?php
		} else {
		?>
			<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px;">
				<tr>
					<td width="150px" align="center"> Please select an asset category.</td>
				</tr>
			</table>	
		<?php
		}
		?>
		
	</div>
</div>

<div id="cnt_asst_cat_browser" class="x-hidden"><!--asset category browser container--></div>


