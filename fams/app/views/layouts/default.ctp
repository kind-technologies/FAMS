<html>
<head>
    <title>Fixed Asset Management System : Laknipayum LLC</title>
	<?php echo $javascript->link('ext-2.2.1/adapter/ext/ext-base'); ?>
	<?php echo $javascript->link('ext-2.2.1/ext-all-debug'); ?>

	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/borders.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/box.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/button.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/combo.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/core.css' />

	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/date-picker.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/dd.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/debug.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/dialog.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/editor.css' />

	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/form.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/grid.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/layout.css' />

	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/panel.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/progress.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/qtips.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/reset.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/resizable.css' />

	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/tabs.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/tree.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-2.2.1/resources/css/window.css' />

	<?=$javascript->link('fams'); ?>
    <?=$html->css('fams');?>
</head>
<body>
    <div id="container">
         <?=$content_for_layout;?>
    </div>
</body>
</html>
