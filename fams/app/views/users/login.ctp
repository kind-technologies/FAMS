<script type="text/javascript" language="javascript1.2">
Ext.onReady(function(){

    Ext.QuickTips.init();

    // turn on validation errors beside the field globally
    Ext.form.Field.prototype.msgTarget = 'side';

    var bd = Ext.getBody();
	var loginDiv = Ext.get('div_03');
	
    
    var login = new Ext.FormPanel({
        labelWidth: 75, // label settings here cascade unless overridden
        url:'/users/login',
        frame:true,
        title: 'Sign in to FAMS',
        bodyStyle:'padding:5px 5px 0;',
        width: 370,
        defaults: {width: 230},
        defaultType: 'textfield',
		onSubmit: Ext.emptyFn,
		submit: function(){
			this.getForm().getEl().dom.submit();
		},
        items: [{
                fieldLabel: 'Username',
                name: 'data[User][username]',
                allowBlank:false
            },{
                fieldLabel: 'Password',
                name: 'data[User][password]', 
                inputType:'password', 
                allowBlank:false 
            }
        ],

        buttons: [{ 
                text:'Login',
                formBind: true,	 
                handler: function(){ login.submit(); } 
            },{
            text: 'Clear'
        }]
    });


    //loginDiv.style.left = left+"px";
    
    login.render(loginDiv);
    

});
</script>

<div id="div_00" style="">
	<div id="div_01">
		<div style="float:left;margin-left:20px">
			<img src="/img/fams-logo-small.png" />
		</div>
	</div>
	<?php if($session->read('Message')) { ?>
	<div id="error_message" style="position: absolute;top: 100px;left: 300px;">
		
		<?php $session->flash('auth'); ?>
		
	</div>
	<?php } ?>
	<div id="div_03" style="top: 250px;width:300px;">
	</div>
</div>

<script type="text/javascript" language="javascript1.2">
	loginDiv = document.getElementById("div_03");
    w = screen.availWidth - 50;
    left = (w/2) - 150;    
    left = left+"px";
    loginDiv.style.left=left;

</script>
