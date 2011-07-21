<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#login').submit(function(e){
			e.preventDefault();
			
			var username = $('input#username').val();
			var password = $('input#password').val();
			
			var dataString = 'username=' + username + '&password=' + password;
			
			$.ajax({
				type: "POST",
				url: "<?php echo SITE_PATH; ?>app/login.php",
				data: dataString,
				cache: false,
				success: function(html) {
					$('#cboxLoadedContent').html(html);
				}
			});
		});
		
		$('#fp_cancel').live('click', function(e){
			e.preventDefault();

			$.colorbox.close();
			var page = window.location.href;
			page = page.substring(0, page.lastIndexOf('?'));
			window.location = page;
		});
		
	});
</script>

<div id="fp_wrapper">
	<div id="fp_login">
		<div id="logo_container">
			<img src="<?php echo APP_RESOURCES; ?>images/logo_small.png" />
		</div>
		<div id="fp_content">
		
			<form action="" method="post" id="login">
			<div>
			
				<?php
					$alerts = $this->getAlerts();
					if ($alerts != '') { echo '<ul class="alerts">' . $alerts . '</ul>'; }
				?>
				
				<table>
					<tr class="row">
						<td><label for="username">Username: *&nbsp;</label></td>
						<td><input type="text" id="username" name="username" value="<?php echo $this->getData('input_user'); ?>" class="<?php echo $this->getData('error_user'); ?>"></td>
					</tr>
					<tr class="row">
						<td><label for="password">Password: *&nbsp;</label></td>
						<td><input type="password" id="password" name="password" value="<?php echo $this->getData('input_pass'); ?>" class="<?php echo $this->getData('error_pass'); ?>"></td>
					</tr>
					<tr class="row submitrow">
						<td colspan="2">
						<a href="#" id="fp_cancel">Cancel</a>						
						&nbsp;<input type="submit" name="submit" class="submit" value="Log In">
						</td>
					</tr>
				</table>		

			</div>
			</form>
		
		</div>
	</div>
</div>