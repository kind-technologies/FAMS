<script>
var win_request = null;
var view_form = null;


function view_request() {
    
    from_name = 'Keerthi Bandara';
    subject = 'I wanna go home now';
    description = 'This is my first request';
    
    if(!view_form){
		view_form = new Ext.FormPanel({
		    renderTo: 'cnt_view_form',
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
		    items: [
					{
						fieldLabel: 'From',
						xtype: 'textfield',
						name: 'to',
						anchor:'100%',  // anchor width by percentage
						value: from_name
					},{
						fieldLabel: 'Subject',
						xtype: 'textfield',
						name: 'subject',
						anchor: '100%',  // anchor width by percentage
						value: subject
					}, {
						xtype: 'textarea',
						hideLabel: true,
						readOnly: true,
						name: 'msg',
						anchor: '100% -53',  // anchor width by percentage and height by raw adjustment
						value: description
					}
		    ]
		});
	}
	
	if(!win_request){
		win_request = new Ext.Window({
			applyTo:'cnt_win_request',
			autoHeight: true,
			layout:'fit',
			width:450,
			height:200,
			closeAction:'hide',
			plain: true,
			title: 'Request Details',
			items: view_form
		});
	}

	win_request.show(this);
}
</script>
<!-- Containers for popup windows -->
<div id="cnt_win_request" class="x-hidden"><!-- employee browser container --></div>
<!-- End containers for popup windows -->
<div id="fields_div">
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="font-weight:bold;color:#15428b;margin-top:5px;border:#8db2e3 2px solid;width:700px;">
			<tr>
				<td align="center">Asset Requests</td>
			</tr>
		</table>
	</div>
    <div align="center" style="padding: 10px 0px 10px 0px;">
		<table border="0" bgcolor="#ffffff" style="border:#8db2e3 2px solid;width:700px">
			<tr>
				<td style="background-color:#e4ebf6">
					From
				</td>
				<td style="background-color:#e4ebf6">
					Subject
				</td>
				<td style="background-color:#e4ebf6">
					Status
				</td>
				<td style="background-color:#e4ebf6">
					
				</td>
			</tr>
	<!--data-->
			<tr>
				<td style="background-color:#ffffff">
					Keerthi Bandara
				</td>
				<td style="background-color:#ffffff">
					I wanna computer
				</td>
				<td style="background-color:#ffffff">
					Resolved
				</td>
				<td style="background-color:#ffffff">
					<a onclick="view_request()" style="text-decoration:none" href="#">view <img style="vertical-align:middle" src="/img/data_browser_view.png"><a>
				</td>
			</tr>
			<tr><td colspan="8" style="height:3px;background-color:#e4ebf6"></td></tr>
			<tr>
				<td style="background-color:#ffffff">
					Keerthi Bandara
				</td>
				<td style="background-color:#ffffff">
					I wanna computer
				</td>
				<td style="background-color:#ffffff">
					Resolved
				</td>
				<td style="background-color:#ffffff">
					<a onclick="view_request()" style="text-decoration:none" href="#">view <img style="vertical-align:middle" src="/img/data_browser_view.png"><a>
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="cnt_photo_win" class="x-hidden">
	<div id="cnt_view_form"></div>
</div>

