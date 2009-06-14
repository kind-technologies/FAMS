<div id="div_00" style="">
	<div id="div_01">
		<div style="float:left;margin-left:20px">
			<img src="/img/fams-logo-small.png" />
		</div>
	</div>
	<div id="div_02">

	</div>
	<div id="div_03" style="top: 200px;width:300px;left:500px">
		<?php
			$session->flash('auth');
			echo $form->create('User', array('action' => 'login'));
			echo $form->input('username');
			echo $form->input('password');
			echo $form->end('Login');
		?>
	</div>
</div>

