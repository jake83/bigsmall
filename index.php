<?php include("app/init.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>	
		<title>Test</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<link href="resources/css/style.css" media="screen" rel="stylesheet" type="text/css" />
		
		<?php $FP->head(); ?>
	</head>
	<body class="home <?php $FP->body_class(); ?>">
	
		<?php $FP->toolbar(); ?>
		
		<div id="wrapper">
			<div id="siteheader">
				<div id="siteheader_left">
					<h1>website</h1>
				</div>
				<div id="siteheader_right">
					<p>mission statement</p>
				</div>
			</div>
		
			<?php // Display top nav ?>	
			<?php $FP->Cms->display_pagelinks(); ?>
			
			<div id="content">
				<div class="left">
					<?php
					if (isset($_GET['pid']))
						$page_id = $_GET['pid'];
					else 
						$page_id = 1;
					//$content_id = $_GET['cid'];
					?>
					<h2><?php $FP->Cms->display_block($page_id, 0, 'oneline'); ?></h2>
					<?php $FP->Cms->display_block($page_id, 1); ?>
				</div>
				<?php /* Commented out for the time being ?>
				<div class="right">
					<?php $FP->Cms->display_block(3); ?>
					<?php $FP->Cms->display_block(4, 'textarea'); ?>
				</div>
				<?php */ ?>
			</div>
			
		</div>
		
		<div id="footer">
			&copy; 2011 Test Website. | <?php $FP->login_link(); ?>
		</div>
	</body>
</html>