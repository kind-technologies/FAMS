<style type="text/css">
.btn_img {
	vertical-align: left;
	font-weight: bold;
}
</style>


<script type="text/javascript" language="javascript">
Ext.onReady(function(){
	
	var btnAdd = new Ext.Button({
		text: 'Add',
		handler: add,
		id: 'add_button',
		icon: '/img/add.png',
		iconCls: 'btn_img',
		minWidth: 100,
		renderTo: add_
	});
	
	var btnEdit = new Ext.Button({
		text: 'Edit',
		handler: edit,
		id: 'edit_button',
		icon: '/img/edit.png',
		iconCls: 'btn_img',
		minWidth: 100,
		renderTo: edit_
	});
	
	var btnDelete = new Ext.Button({
		text: 'Delete',
		handler: del,
		minWidth: 100,
		id: 'delete_button',
		icon: '/img/delete.png',
		iconCls: 'btn_img',
		renderTo: del_
	});

	var btnSave = new Ext.Button({
		text: 'Save',
		handler: save,
		minWidth: 100,
		id: 'save_button',
		icon: '/img/save.png',
		iconCls: 'btn_img',
		renderTo: save_
	});
	
	var btnClear = new Ext.Button({
		text: 'Cancel',
		handler: cancel,
		minWidth: 100,
		id: 'Clear_button',
		icon: '/img/cancel.png',
		iconCls: 'btn_img',
		renderTo: cancel_
	});
	
});
</script>

<div id="buttons_div" style="margin:10px;  ">
	<!-- New / Edit / Save / Delete/ Clear-->
	<div id="left_buttons" style="float: left; padding: 2px; width: 310px; background-color:#ffffff">
		<table bgcolor="#c6d9f1">
			<tr>
				<td id="add_"></td><td id="edit_"></td><td id="del_"></td>
			</tr>
		</table>
	</div>
	<div id="right_buttons" style="float:right; padding: 2px; width: 310px; background-color:#ffffff">
		<table bgcolor="#c6d9f1" align="right">
			<tr>
				<td width="100%">&nbsp;</td><td id="save_"></td><td id="cancel_"></td>
			</tr>
		</table>
	</div>
</div>

