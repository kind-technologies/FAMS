<html>
<head>
    <title>Fixed Asset Management System : Laknipayum LLC</title>
	<?php echo $javascript->link('ext-3.0.0/adapter/ext/ext-base'); ?>
	<?php echo $javascript->link('ext-3.0.0/ext-all-debug'); ?>
	<?php echo $javascript->link('ext-3.0.0/src/util/Date'); ?>
	<link rel='StyleSheet' href="<?php echo $this->base ?>/js/ext-3.0.0/resources/css/ext-all.css" />
	<!--link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/borders.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/box.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/button.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/combo.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/core.css' />

	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/date-picker.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/dd.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/debug.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/dialog.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/editor.css' />

	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/form.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/grid.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/layout.css' />

	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/panel.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/progress.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/qtips.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/reset.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/resizable.css' />

	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/tabs.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/tree.css' />
	<link rel='StyleSheet' href='<?php echo $this->base ?>/js/ext-3.0.0/resources/css/structure/window.css' /-->

	<!--file upload user extension-->
	<link rel="stylesheet" type="text/css" href="<?php echo $this->base ?>/js/ext-3.0.0/ux/css/file-upload.css"/>
    <script type="text/javascript" src="<?php echo $this->base ?>/js/ext-3.0.0/ux/FileUploadField.js"></script>
    <!--script type="text/javascript" src="<?php echo $this->base ?>/js/ext-3.0.0/ux/file-upload.js"></script-->
    <style>
        .upload-icon {
            background: url('<?php echo $this->base ?>/js/ext-3.0.0/ux/images/image_add.png') no-repeat 0 0 !important;
        }
        #fi-button-msg {
            border: 2px solid #ccc;
            padding: 5px 10px;
            background: #eee;
            margin: 5px;
            float: left;
        }
    </style>

	<!--end-->

	<?=$javascript->link('fams'); ?>
    <?=$html->css('fams');?>
</head>
<body>
    <div id="container">
         <?=$content_for_layout;?>
    </div>
</body>
</html>
