<!DOCTYPE html>
<html>
<head>
	<title>Stockpyle.net - <?=$title?></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>styles/reset.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>styles/style.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>styles/black-tie/jquery-ui-1.8.7.custom.css" />
	<script type="text/javascript" src="<?=base_url()?>scripts/jquery.js"></script>
	<script type="text/javascript" src="<?=base_url()?>scripts/jquery-ui-1.8.7.custom.min.js"></script>
	<base href="<?=base_url();?>" />
</head>
<body>
<div id="page">
	<div id="header">
		<div id="heading">
			<h1>Stockpyle</h1>
			<h4>Home inventory management, for those just-in-case situations.</h4>
			<div id="navigation">
<?php
if (!$logged_in) {
?>
				<a href="<?=base_url();?>"><span>home</span></a>
				<a href="<?=base_url();?>signup"><span>signup</span></a>
				<a href="<?=base_url();?>login"><span>login</span></a>
				<a href="<?=base_url();?>about"><span>about</span></a>
<?php
		} else {
?>
				<a href="<?=base_url();?>"><span>home</span></a>
				<a href="<?=base_url();?>inventory"><span>browse</span></a>
				<a href="<?=base_url();?>logout"><span>logout</span></a>
				<a href="<?=base_url();?>about"><span>about</span></a>
<?php
}
?>
			</div>
		</div>
	</div>
	<?php
	if ($promo) {
	?>
	<div id="promo">
		<div class="inside">
			<?=$promo?>
		</div>
	</div>
	<?php
	}
	?>
	<div id="content">
		<div class="inside">