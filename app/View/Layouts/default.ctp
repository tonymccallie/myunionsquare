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

<body class="">
	<div id="header" class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="left_col">
				<?php if(!$loggedIn): ?>
					Howdy
				<?php else: ?>
					<div id="self_picture"><img src="../img/teea-pic.png" alt="teea-pic" width="100" height="100" class="img-circle"/></div>
					<div id="self_name">Howdy <?php echo $USER['User']['first_name']?>,</div>
					<div id="self_position"><?php echo $USER['User']['position'] ?></div>
				<?php endif ?>
			</div>
			<div class="content">
				<!-- Mobile Menu Button -->
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- /Mobile Menu Button -->
				<img src="../img/logo.png" alt="logo"/ class="logo">
				<div id="header_ctrl" class="right_col">
					<?php echo $this->Html->link('<i class="icon-desktop"></i><br>Website','/pages/faq',array('escape'=>false)) ?>
					<?php if(!$loggedIn): ?>
						<?php echo $this->Html->link('<i class="icon-edit"></i><br>Register','/users/register',array('escape'=>false)) ?>
						<?php echo $this->Html->link('<i class="icon-signin"></i><br>Login','/users/login',array('escape'=>false)) ?>
					<?php else: ?>
						<?php echo $this->Html->link('<i class="icon-cog"></i><br>Settings','/users/password',array('escape'=>false)) ?>
						<?php echo $this->Html->link('<i class="icon-signout"></i><br>Logout','/users/logout',array('escape'=>false)) ?>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>

	<div id="navbar" class="left_col">
		<ul class="nav">
			<li class="active"><?php echo $this->Html->link('<i class="icon-dashboard"></i> Dashboard','/dashboard',array('escape'=>false)) ?></li>
			<?php if($USER['Role']['name'] == 'Admin'): ?>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="admin_dropdown"><i class="icon-group"></i> Admin <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><?php echo $this->Html->link('Announcements','/admin/news') ?></li>
					<li><?php echo $this->Html->link('Users','/admin/users') ?></li>
					<li><?php echo $this->Html->link('Posts','/admin/posts') ?></li>
					<li><?php echo $this->Html->link('Files','/admin/files') ?></li>
				</ul>
			</li>
			<?php endif ?>
			<?php if($loggedIn): ?>
			<li><?php echo $this->Html->link('<i class="icon-bullhorn"></i> Announcements','/pages/announcements',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-calendar"></i> Calendar','/pages/calendar',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-comments-alt"></i> Message Board','/pages/board',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-group"></i> Directory','/pages/directory',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-folder-open"></i> Resources','/pages/resources',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-random"></i> Training','/pages/training',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-legal"></i> Board','/pages/board',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-camera-retro"></i> Photos','/pages/photos',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-user-md"></i> Help Desk','/pages/help',array('escape'=>false)) ?></li>
			<?php endif ?>
		</ul>
		<?php if($loggedIn): ?>
			<?php echo $this->Html->link('') ?>
		<?php endif ?>
	</div>

	<div class="content">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<?php echo $this->Session->flash(); ?>
					<div class="row-fluid">
						<?php echo $content_for_layout ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
