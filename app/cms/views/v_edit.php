<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#edit').submit(function(e){
			e.preventDefault();
			
			var id = "<?php echo $this->getData('block_id'); ?>";
			var type = $('#type').val();
			
			<?php if ($this->getData('block_type') == 'wysiwyg') { ?>
				tinyMCE.triggerSave();
			<?php } ?>
			
			var content = $('#field').val();
			
			var dataString = 'id=' + id + '&field=' + content + '&type=' + type;
			
			$.ajax({
				type: "POST",
				url: "<?php echo SITE_PATH; ?>app/cms/edit.php",
				data: dataString,
				cache: false,
				success: function(html) {
					$('#cboxLoadedContent').html(html);
				}
			});
		});
		
		$('#fp_cancel').live('click', function(){
			if (tinyMCE.getInstanceById('field'))
			{
			    tinyMCE.execCommand('mceFocus', false, 'field');                    
			    tinyMCE.execCommand('mceRemoveControl', false, 'field');
			}
		});
		
	});
</script>
<?php if ($this->getData('block_type') == 'wysiwyg')
{ ?>
<script type="text/javascript">
	tinyMCE.init({
        // General options
        mode : "none",
        theme : "advanced",
        plugins : "style,table,advimage,advlink,inlinepopups,media,contextmenu,paste,fullscreen,noneditable,visualchars,xhtmlxtras",
        width : "700",
        height : "300",

        // Theme options
        theme_advanced_buttons1 : "styleselect,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor,bold,italic,underline,strikethrough",
        theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|, cut,copy,paste,undo,redo,|,link,unlink,anchor,image,charmap,|,attribs,code,preview,fullscreen",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "<?php echo SITE_CSS; ?>, <?php echo APP_RESOURCES; ?>css/tiny_mce_style.css"
});
setTimeout(function() {tinyMCE.execCommand('mceAddControl', false, 'field');}, 0);

</script>
<?php } ?>

<div id="fp_wrapper">

		<h1>Edit: <i><?php echo $this->getData('block_id'); ?></i></h1>
		<div id="fp_content">
		
			<form action="" method="post" id="edit">
			<div>
				
				<div class="row">
					<label for="field">Block Content:</label>
				</div>
				<div class="row">
					<?php echo $this->getData('cms_field'); ?>
					<input type="hidden" id="type" value="<?php $this->getData('block_type'); ?>">
				</div>
			
				<div class="row submitrow" id="submitrow_content">
					<a href="#" id="fp_cancel">Cancel</a>&nbsp;
					<input type="submit" name="submit" class="submit" value="Submit">
				</div>

			</div>
			</form>
		
		</div>
</div>