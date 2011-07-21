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
	// submit new page to database	
	$pagetitle = $_POST['pagetitle'];
	$FP->Template->setData('pagetitle', $pagetitle);
	
	$FP->Cms->create_page($pagetitle);
	
	// close colorbox and refresh page
	$FP->Template->load(APP_PATH . "cms/views/v_saving.php");
}
else
{
	// load view
	$FP->Template->load(APP_PATH . 'cms/views/v_addpage.php');
}