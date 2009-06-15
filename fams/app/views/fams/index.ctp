<div id="div_00">
	<div id="div_01">
		<div style="float:left;margin-left:20px;">
			<img src="/img/fams-logo-small.png" />
		</div>
		<div style="float:right;margin-right:20px;">
			<?=$html->link('logout', '/users/logout');?>
		</div>
	</div>
	<div id="div_02">
		<table border="0" style="width:234px;height:26px;margin-left:3px">
			<tr>
				<td style="background: transparent url(<?php echo $this->base ?>/js/ext-2.2.1/resources/images/default/tabs/tabs-sprite.gif) repeat-x 0 -201px;">
					<!--<img class="closeLink" width="16" height="16" onclick="initSlideLeftPanel();return false" border="0" src="images/cancel.png" /></a>-->
				</td>
			</tr>
		</table>
		<div style="position:relative;float:left;">
			<iframe style="width:230px;height:728px;background-color: #b2c8e2;margin-left:5px" frameborder="0" src="/main_tree"></iframe>
		</div>
	</div>
	<div id="div_03">
		<iframe id="frm" style="width:100%;height:752px;background-color: #d3e1f1;" frameborder="0" src="/fams/home"></iframe>
	</div>
</div>	

