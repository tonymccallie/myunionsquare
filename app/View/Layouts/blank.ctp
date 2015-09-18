<?php
	$USER = Authsome::get();
	$loggedIn = false;
	if($USER['User']['email'] != 'guest@greyback.net') {
		$loggedIn = true;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Union Square: <?php echo $title_for_layout ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

<?php
	$develop = true;
	if($develop):
?>
	<link rel="stylesheet/less" type="text/css" href="<?php echo $this->webroot ?>css/styles.less" />
	<script type="text/javascript">
		less = {
			env: "development", // or "production"
			poll: 1000,         // when in watch mode, time in ms between polls - add '#!watch' to url to enable or less.watch(); in console
			dumpLineNumbers: "mediaQuery", // or "mediaQuery" or "all"
		};
	</script>
	<script src="<?php echo $this->webroot ?>js/less-1.4.1.min.js"></script>
<?php else: ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot ?>css/styles.min.css" />
<?php endif ?>
	
	
	<!-- Le Scripts -->
	<script src="<?php echo $this->webroot ?>js/jquery-1.10.2.min.js"></script>
	<script src="<?php echo $this->webroot ?>js/bootstrap.min.js"></script>
	<script src="<?php echo $this->webroot ?>js/custom.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
	<![endif]-->
	
	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->webroot ?>ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->webroot ?>ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->webroot ?>ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo $this->webroot ?>ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="<?php echo $this->webroot ?>ico/favicon.png">
	
	<!-- Google Analytics -->
	<!-- /Google Analytics -->
</head>

<body class="blank">
	<div id="header" class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<?php echo $this->Html->image('logo.png',array('class'=>'logo')) ?>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<?php echo $this->Session->flash(); ?>
				<div class="row-fluid">
					<?php echo $content_for_layout ?>
					<?php //echo $this->element('sql_dump'); ?>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
