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
				<h2>Change Password</h2>
				
				<form action="" method="post" id="edit" class="widelabel">
					<div>
						<?php
							$alerts = $this->getAlerts();
							if ($alerts != '') { echo '<ul class="alerts"' . $alerts . '</ul>'; } ?>
					</div>
					
					<div class="row">
						<label for="oldpass">Old Password <span class="required">*</span></label>
						<input type="password" name="oldpass" id="oldpass" value="<?php echo $this->getData('oldpass'); ?>"/>
						<div class="error"><?php echo $this->getData('error_oldpass'); ?></div>
					</div>
					<div class="row">
						<label for="newpass">New Password <span class="required">*</span></label>
						<input type="password" name="newpass" id="newpass" value="<?php echo $this->getData('newpass'); ?>"/>
						<div class="error"><?php echo $this->getData('error_newpass'); ?></div>
					</div>
					<div class="row">
						<label for="newpass2">New Password (again) <span class="required">*</span></label>
						<input type="password" name="newpass2" id="newpass2" value="<?php echo $this->getData('newpass2'); ?>"/>
						<div class="error"><?php echo $this->getData('error_newpass2'); ?></div>
					</div>
					<div class="row submitrow">
						<input type="submit" name="submit" class="submit" value="Submit">
					</div>
				</form>
			
			</div>
		
		</div>
</div>

<?php
	$this->load(APP_PATH . 'core/templates/t_page_foot.php');
?>