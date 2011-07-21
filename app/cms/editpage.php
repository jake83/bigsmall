<?php

include("../init.php");

$FP->Auth->checkAuthorization();

if (isset($_POST['field']) && (isset($_POST['id']) == FALSE || isset($_POST['type']) == FALSE))
{
	$FP->Template->error('', 'Please do not open up edit windows within a new window or tab.');
	exit;
}
else if (isset($_POST['pagetitle']))
{
	// submit edited page title to database	
	$pageid = $_POST['pageid'];
	$pagetitle = $_POST['pagetitle'];
	
	$FP->Template->setData('pagetitle', $pagetitle);
	$FP->Cms->update_pagetitle($pagetitle, $pageid);
	
	// TODO - re-add ID clean method
	
	// close colorbox and refresh page
	$FP->Template->load(APP_PATH . "cms/views/v_saving.php");
}
else
{
	if (isset($_GET['pid']) == FALSE)
	{
		$FP->Template->error();
		exit;
	}
	
	$page_id = $_GET['pid'];
	
	$page_title = $FP->Cms->get_pagetitle($page_id);
	
	$FP->Template->setData('page_id', $page_id);
	$FP->Template->setData('page_title', $page_title);
	//$FP->Template->setData('cms_field', $FP->Cms->generate_field($type, $content), false);
	
	// load view
	$FP->Template->load(APP_PATH . 'cms/views/v_editpage.php');
}