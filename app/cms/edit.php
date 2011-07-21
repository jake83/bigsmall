<?php

include("../init.php");

$FP->Auth->checkAuthorization();

if (isset($_POST['field']) && (isset($_POST['id']) == FALSE || isset($_POST['type']) == FALSE))
{
	$FP->Template->error('', 'Please do not open up edit windows within a new window or tab.');
	exit;
}
else if (isset($_POST['field']))
{
	// get data
	$id = $FP->Cms->clean_block_id($_POST['id']);
	$FP->Template->setData('block_id', $id);
	
	$type = htmlentities($_POST['type'], ENT_QUOTES);
	$content = $_POST['field'];
	
	$FP->Cms->update_block($id, $content);
	
	// close colorbox and refresh page
	$FP->Template->load(APP_PATH . "cms/views/v_saving.php");
}
else
{
	if (isset($_GET['id']) == FALSE || isset($_GET['type']) == FALSE)
	{
		$FP->Template->error();
		exit;
	}
	
	$id = $_GET['id'];
	$type = htmlentities($_GET['type'], ENT_QUOTES);
	
	$content = $FP->Cms->load_block($id);
	
	$FP->Template->setData('block_id', $id);
	$FP->Template->setData('block_type', $type);
	$FP->Template->setData('cms_field', $FP->Cms->generate_field($type, $content), false);
	
	// load view
	$FP->Template->load(APP_PATH . 'cms/views/v_edit.php');
}