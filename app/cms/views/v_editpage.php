<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#editpage').submit(function(e){
			e.preventDefault();
			
			var pageid = $('input#pageid').val();
			var pagetitle = $('input#pagetitle').val();
			
			var dataString = 'pageid=' + pageid + '&pagetitle=' + pagetitle;
			
			$.ajax({
				type: "POST",
				url: "<?php echo SITE_PATH; ?>app/cms/editpage.php",
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

		<h1><?php echo $this->getData('page_title'); ?></h1>
		<p class="fp_editview_link"><a href="app/cms/editpage.php?pageid=<?php echo $this->getData('page_id'); ?>">Open page in edit mode</a></p>
		<div id="fp_content">
		
			<form action="" method="post" id="editpage">
				<div>
				
					<?php
						$alerts = $this->getAlerts();
						if ($alerts != '') { echo '<ul class="alerts">' . $alerts . '</ul>'; }
					?>
					
					<?php // TODO remove table and put into divs ?>
					<input type="hidden" id="pageid" name="pageid" value="<?php echo $this->getData('page_id'); ?>">
					<table>
						<tr class="row">
							<td><label for="pagetitle">Page title: *&nbsp;</label></td>
							<td><input type="text" id="pagetitle" name="pagetitle" value="<?php echo $this->getData('page_title'); ?>" class="<?php echo $this->getData('error_pagetitle'); ?>"></td>
						</tr>
						<tr class="row submitrow">
							<td colspan="2">
								<a href="#" id="fp_cancel">Cancel</a>						
								&nbsp;<input type="submit" name="submit" class="submit" value="Submit">
							</td>
						</tr>
					</table>	

			</div>
			</form>
		
		</div>
</div>