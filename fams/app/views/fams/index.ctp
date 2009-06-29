    <script type="text/javascript">
    //Fams = { version:"0.0.5" };
    var Fams = function(){};
    Fams.homePage = function() {};

	//Header for main screen
	Fams.homePage.header = '<div>' +
								'<div style="float:left;margin-left:20px;">' +
									'<img src="/img/fams-logo-small.png" >' +
								'</div>' +
								'<div id="logout_bar" style="float:right;margin-right:20px;">' +
									'<?=$html->link("logout", "/users/logout");?> | ' +
									'<?=$html->link("help", "#");?>' +
								'</div>' +
							'</div>';

	Fams.homePage.tree = '<iframe id="tree_frame" scrolling="no" style="height:100%;width:100%;" frameborder="0" src="/main_tree"></iframe>';
	
	Fams.homePage.form = '<iframe id="form_frame" style="height:100%;width:100%" frameborder="0" src="/fams/home"></iframe>';
    </script>
    
    
	<script type="text/javascript">

    Ext.onReady(function(){

       // NOTE: This is an example showing simple state management. During development,
       // it is generally best to disable state management as dynamically-generated ids
       // can change across page loads, leading to unpredictable results.  The developer
       // should ensure that stable state ids are set for stateful components in real apps.
       Ext.state.Manager.setProvider(new Ext.state.CookieProvider());

       var viewport = new Ext.Viewport({
            layout:'border',
            items:[
				{
					region: 'north',
					html: Fams.homePage.header,
					autoHeight: true,
					border: false,
					margins: '0 0 5 0'
				},
				{
                region:'west',
                id:'west-panel',
                title:'FAMS Menu',
                split:true,
                width: 200,
                minSize: 175,
                maxSize: 400,
                collapsible: true,
                margins:'2 0 5 5',
                cmargins:'35 5 5 5',
                layout:'accordion',
                layoutConfig:{
                    animate:true
                },
                items: [{
                    html: Fams.homePage.tree,
                    title:'Navigation',
                    autoScroll:true,
                    border:false,
                    iconCls:'nav'
                },{
                    title:'Settings',
                    html: '<p>test</p>',
                    border:false,
                    autoScroll:true,
                    iconCls:'settings'
                }]
            },{
                region:'center',
                margins:'2 5 5 0',
                html: Fams.homePage.form,
                autoScroll:true
            }]
        });
    });
	</script>
