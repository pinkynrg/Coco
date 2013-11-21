<?php
	require("helper/helper.php");
	require("system/constant.php");
	require("system/settings.php");
	require("controller/controller.php");
 
	$Controller = new Controller();
	$Controller->catchBackgroundAction();
?>

<meta http-equiv="Content-Type" content="text/html;" charset="ISO-8859-1" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>
	<title> <?php echo $Controller->getPageTitle(); ?> </title>
	
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script src="/assets/assets.js"></script>

	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.2/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href="/style/style.css" rel="stylesheet"/>

</head>

<body>
	
	<?php if ($Controller->getSession()) : ?>

	<div id="header"> <h1> <?php echo "<i class='fa fa-align-left'></i> ".$Controller->getTitle(); ?> </h1> </div>

		<div id="main_wrapper">
			
			<div id="nav_wrapper"> 
				<div id="nav"> 
					
					<?php echo $Controller->getPath(); ?>

					<?php echo $Controller->getLogout(); ?>
				
				</div>
			</div>
			
			<div id="menu_wrapper">
				<div id="menu">
					 <?php echo $Controller->getMenu(); ?>
				</div>
			</div>
			
			<div id="content_wrapper">	
				<div id="content">

					<?php echo $Controller->getUserMessage(@$Controller->result); ?>

					<?php echo $Controller->getContent(); ?>
				
				</div>
			</div>

		</div>

		<div id="footer">  <?php echo $Controller->getFooter(); ?> </div>

	<?php else : ?>

	<?php echo $Controller->getAuthPanel(@$Controller->result); ?>

	<?php endif; ?>

</body>
<div class="overlay"></div>
</html>