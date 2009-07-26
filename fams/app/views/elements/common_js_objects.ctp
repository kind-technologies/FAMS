<script type="text/javascript" language="javascript">

var page_mask = new Ext.LoadMask(Ext.getBody(), {msg:"Please wait..."});

var ajaxClass = Ext.Ajax;

var show_mask = function (conn, request) {
					page_mask.show();
				}

var hide_mask = function (conn, response, options )  {
					page_mask.hide();
				}
				
var msg = function(title, msg){
	Ext.Msg.show({
		title: title,
		msg: msg,
		minWidth: 200,
		modal: true,
		icon: Ext.Msg.INFO,
		buttons: Ext.Msg.OK
	});
};

</script>
