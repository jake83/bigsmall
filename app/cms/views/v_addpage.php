<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#addpage').submit(function(e){
			e.preventDefault();
			
			var pagetitle = $('input#pagetitle').val();
			
			var dataString = 'pagetitle=' + pagetitle;
			
			$.ajax({
				type: "POST",
				url: "<?php echo SITE_PATH; ?>app/cms/addpage.php",
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

		<h1>Add new page</h1>
		<div id="fp_content">
		
			<form action="" method="post" id="addpage">
			<div>
				
				<?php
					$alerts = $this->getAlerts();
					if ($alerts != '') { echo '<ul class="alerts">' . $alerts . '</ul>'; }
				?>
				
				<table>
					<tr class="row">
						<td><label for="pagetitle">Page title: *&nbsp;</label></td>
						<td><input type="text" id="pagetitle" name="pagetitle" value="<?php echo $this->getData('input_pagetitle'); ?>" class="<?php echo $this->getData('error_pagetitle'); ?>"></td>
					</tr>
					<tr class="row submitrow">
						<td colspan="2">
							<a href="#" id="fp_cancel">Cancel</a>						
							&nbsp;<input type="submit" name="submit" class="submit" value="Add Page">
						</td>
					</tr>
				</table>	

			</div>
			</form>
		
		</div>
</div>