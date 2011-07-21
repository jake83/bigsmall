<?php 
	$this->load(APP_PATH . 'core/templates/t_page_head.php'); 
?>

<div id="fp_wrapper" class="fp_page">

		<h1>CMS Settings<div id="fp_close">Close Popup</div></h1>
		<div id="fp_content">
		
			<div class="fp_left">
				<?php $this->cms_nav('settings', 'change_password'); ?>
			</div>
			<div class="fp_right">
				<h2>Dashboard</h2>
			
				<p>Welcome to the BIGsmall Dashboard. Select from the options to the left.</p>
			</div>
		
		</div>
</div>

<?php
	$this->load(APP_PATH . 'core/templates/t_page_foot.php'); 
?>