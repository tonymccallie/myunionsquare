<?php
	$loggedIn = false;
	if($USER['User']['email'] != 'guest@greyback.net') {
		$loggedIn = true;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Team Union Square: <?php echo $title_for_layout ?></title>
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
	<script src="<?php echo $this->webroot ?>js/moment.min.js"></script>
	<script src="<?php echo $this->webroot ?>js/jquery.prettyPhoto.js"></script>
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
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=165321740206477";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div id="header" class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="left_col">
				<?php if($loggedIn): ?>
					<div id="self_picture"><?php echo !empty($USER['User']['photo'])?$this->Html->image('thumb/'.$USER['User']['photo'].'/width:200/height:200/crop:true/zoom:auto/'.$USER['User']['photo'],array('class'=>'img-circle')):'' ?></div>
					<div id="self_name"><?php echo $greeting ?> <?php echo $USER['User']['first_name']?></div>
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
				<?php echo $this->Html->image('logo.png',array('class'=>'logo')) ?>
				<div id="header_ctrl" class="right_col">
					<?php if($USER['Role']['name'] == 'Admin'): ?>
						<a href="#" class="dropdown-toggle" data-toggle="admin_dropdown"><i class="icon-group"></i><br>Admin</a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link('Announcements','/admin/news') ?></li>
							<li><?php echo $this->Html->link('Users','/admin/users') ?></li>
							<li><?php echo $this->Html->link('Files/Folders','/admin/folders') ?></li>
							<li><?php echo $this->Html->link('Galleries','/admin/galleries') ?></li>
							<li><?php echo $this->Html->link('Greetings','/admin/greetings') ?></li>
							<li><?php echo $this->Html->link('Feedback','/admin/feedback') ?></li>
							<li><?php echo $this->Html->link('High Fives','/admin/accolades') ?></li>
							<li><?php echo $this->Html->link('Marketing','/admin/news/marketing') ?></li>
						</ul>
					<?php else: ?>
						<?php echo $this->Html->link('<i class="icon-desktop"></i><br>Website','http://www.unionsquare.org',array('escape'=>false)) ?>
					<?php endif ?>
					<?php echo $this->Html->link('<i class="icon-cog"></i><br>Settings','/users/password',array('escape'=>false)) ?>
					<?php echo $this->Html->link('<i class="icon-signout"></i><br>Logout','/users/logout',array('escape'=>false)) ?>
				</div>
			</div>
		</div>
	</div>

	<div id="navbar" class="left_col">
		<ul class="nav">
			<li class="active"><?php echo $this->Html->link('<i class="icon-dashboard"></i> Dashboard','/dashboard',array('escape'=>false)) ?></li>
			<?php if($loggedIn): ?>
			<!--
			<li><?php echo $this->Html->link('<i class="icon-bullhorn"></i> Announcements','/pages/announcements',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-calendar"></i> Calendar','/pages/calendar',array('escape'=>false)) ?></li>
			
			-->
			<li><?php echo $this->Html->link('<i class="icon-group"></i> Directory','/users/directory',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-folder-open"></i> Resources','/folders/resources',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-random"></i> Training','/folders/view/9',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-legal"></i> Board','/folders/board',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-camera-retro"></i> Photos','/galleries/',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-tasks"></i> Classifieds','/classifieds',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-bullhorn"></i> Marketing','/marketing',array('escape'=>false)) ?></li>
			<li><?php echo $this->Html->link('<i class="icon-user-md"></i> Help Desk','https://unionsquarehelp.zendesk.com',array('escape'=>false,'target'=>'_blank')) ?></li>
			<?php endif ?>
		</ul>
		<?php if($loggedIn): ?>
			<div class="text-center open_door">
				<?php echo $this->Html->link('The Open Door','/feedback/add',array('class'=>'btn')) ?>
			</div>
			<div class="bank_login">
				<form method="post" action="https://olb.usfcu.us/ISuite5/Features/Auth/MFA/IFrameLoginMFA.aspx" onsubmit="javascript:return WebForm_OnSubmit();" id="form1" target="_blank" class="form-search">
					<input type="hidden" name="LoginJSDetector" id="LoginJSDetector" value="" />
					<input type="hidden" name="pm_fp" id="pm_fp" value="" />
					<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="" />
					<input type="hidden" name="IS5_2PostFixer" id="IS5_2PostFixer" value="1" />
					<input type="hidden" name="IS5_2PostMsg" id="IS5_2PostMsg" value="1" />
					<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="ZDDvBikP+4H4r90jRcSYBjLFC499hWr4Nb/DOD2dnhxUx2I6hxLCa3seGgvBqXhN4ttOPphdHa5UQJi/CgwktJam+oNxwLGJm1ikc4xgwmYwJ4zBsIMNavhu0wmESuwnjp0O0xCOy8zEeI9dd6gQQSRSZbkiKDYpjqZCMFnhjbRFLLYJUHPO/YCfeSDgEiiDGDROgM5tOSrA4ZcoLUexjZael9/6MKw7rtLD0E5hCnGDOcMEY/lnE0l45SyOB0M5y6luMpD+U/70pXwDz6g2f0F1QxooKI/55atG0iZ81KsdyNWMeMl05b1azb7wNtsi80pteIGhUO2G1mefph2OvmxhoAsFYfFBzOPVKwc2dFD7j9PWRhflkmlNBs0286adBIFy+Nf8v5OehXG6oiYHQ4Gp211lqtLWNV3jJnBFMDqtlRDVNALq6t32bZHxmLfExbJBDD6BIJqG/+QmoSQ8mf9L/74KW6ZRgMH4C/bUu0FsH34xeOgidf5SiDdANRNEdfF5HjMVgVYbDDNd/fXpUip7VqfgyMHAFCk9i41zoq3w/zqpLWcxCnz7YjNxa3MhkjTJu++Lg1XDGutLxSIF5ZzTATQAiuMjX1Y5R/TMHtvjIIUdypAnwKUTktEv02UbwPPXYd0/6YqgC+jSPjNUVb3uomT6MDCSFkgBQZ1BllTXZbEqJ4L0qXMlfZIlkhj9Zj8S3p9H+TNyar2UsUSNrLfbnhoLtnF8+yCAcXqICl87Hn8yD9asOrROAmF/L6NziHfC4UKi55xpX57kYvUNSz4bnNDfGgjoEHrQhuercvq/KiFCpZaROYAoBekY/hlfD+v9k3LkR1YWRpKHl1tsNmYSr7KdYszhpyPaSyn0bVnowbkxqzZKkvMcpvEd5EItH7yuDjd/hqdij2CIKqVXGWXf9wfyHJyxDlQfp/grPXyNSOlUXEfp2NB/Vckl2buMquMC8t9hphLwfBWMNFwGKH4kgm1zWTV6ZQAmSTn35bvgXsC/d0jcpNC+Y42V8izE1bNdeGlY7TwMu+I16FeL3lR2MQKfDebkU/1TgKgena1flnCCnB9sZdrMBHAU2U7aVea+xQ==" />
					<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
					<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
					<input type="hidden" name="__VIEWSTATEENCRYPTED" id="__VIEWSTATEENCRYPTED" value="" />
					<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="fNeFcf1YlKNvT9S/2k7KbGbGr1vXkIL6i/uhcIeuke9Z6gwmkkmihP43vBmy8wuZxuXkEUkFhS5IkiH9qLL2FjR99n02Pyj5jZB7wTauqOuUqDh0" />
					<span class="errorMessage"></span>
					<label for="UserIDTextbox"><i class="icon-laptop"></i> Online Banking</label>
					<input name="UserIDTextbox" type="text" maxlength="20" size="20" id="UserIDTextbox" class="input" AutoComplete="Off" placeholder="USER ID" />
					<input type="text" style="display: none" />
					<input type="submit" name="LoginBtn" value="Log In" onclick="UISButton_OnClick(this, UISButton_List, 'There is currently a submission in process.  Please wait until it completes.  Do not use your Back or Stop buttons as this will make your submission fail.');" id="LoginBtn" class="btn" />
					<div id="UserIDValSummary" class="errorMessage" style="color:Red;display:none;"></div>
					<span id="DataSafe_ReadFlash"></span>
					<script type="text/javascript">
						//<![CDATA[
						var Page_ValidationSummaries =  new Array(document.getElementById("UserIDValSummary"));
						//]]>
					</script>
					<script type="text/javascript">
						//<![CDATA[
						var UserIDValSummary = document.all ? document.all["UserIDValSummary"] : document.getElementById("UserIDValSummary");
						UserIDValSummary.validationGroup = "UserID";
						//]]>
					</script>
					<script type="text/javascript">
						//<![CDATA[
						
						 post_deviceprint();
						
						 RSAMFA_ReadFlashObject('DataSafe_ReadFlash', 'https://olb.usfcu.us/ISuite5/Features/Auth/MFA/RSAMFA6/pmfso.swf', '%2fISuite5%2fFeatures%2fAuth%2fMFA%2fLogin%2fMFAReceiveFSO.aspx%3fg%3d4OfotwE%252b7w7zy%252f6AM%252b1dhomEr373LPgfoaeqIs0Pd1oeHGKZRZA8ytIoc61Vhkgk46WzCGUZncKCEpRrN5jk%252f9XmpVkHTO%252b9MDWGpTIDysQ%253d');
						
						 var UISButton_List = new Array();
						
						
						 UISButton_List.push('LoginBtn');
						
						
						 UISButton_List.push('ResetBtn');
						WebForm_AutoFocus('UserIDTextbox');//]]>
					</script>
				</form>
			</div>
		<?php endif ?>
		
		<p><br /></p>
		<p><br /></p>
	</div>

	<div class="content">
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
	</div>

</body>
</html>
