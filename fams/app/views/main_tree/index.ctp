<script>
Ext.onReady(function(){
    // shorthand
    var Tree = Ext.tree;
    
    var tree = new Tree.TreePanel({
        el:'tree_div',
        border: false,
        useArrows:true,
        autoScroll:true,
        animate:true,
        enableDD:true,
        containerScroll: true,

        // auto create TreeLoader
        dataUrl: '/main_tree/tree_view',

        root: {
            nodeType: 'async',
            text: 'FAMS',
            draggable:false,
            id:'source'
        }
    });

	tree.on('click', function(node, e){
		//If program node is selected
		if(node.attributes.program_name != null) {
			//Get iframe to load program
			_form_window = window.parent.document.getElementById('form_frame');
			_form_window.src = node.attributes.program_name;
		}
	});

    // render the tree
    tree.render();
    tree.getRootNode().expand();
});

</script>
<div id="tree_div" style="background-color:#ffffff;overflow:auto; height:100%; _height:700px; text-align:left;">

</div>
