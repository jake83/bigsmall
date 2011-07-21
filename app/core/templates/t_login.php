<link href="<?php echo APP_RESOURCES; ?>css/fp_style.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
<script type="text/javascript">$.noConflict();</script>

<script type="text/javascript" src="<?php echo APP_RESOURCES; ?>javascript/colorbox/colorbox.js"></script>
<link href="<?php echo APP_RESOURCES; ?>javascript/colorbox/colorbox.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript">

	jQuery(document).ready(function($) {
		
		$.colorbox({
			transition: 'fade',
			initialWidth: '50px',
			initialHeight: '50px',
			overlayClose: false,
			escKey: false,
			scrolling: false,
			opacity: .6,
			href: '<?php echo SITE_PATH; ?>app/login.php'
		});
		
	});

</script>