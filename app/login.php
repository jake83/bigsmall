<?php

include("init.php");

if (isset($_POST['username']))
{
	// get data
	$FP->Template->setData('input_user', $_POST['username']);
	$FP->Template->setData('input_pass', $_POST['password']);
	
	// validate data
	if ($_POST['username'] == '' || $_POST['password'] == '')
	{
		// show error
		if ($_POST['username'] == '') { $FP->Template->setData('error_user', 'required'); }
		if ($_POST['password'] == '') { $FP->Template->setData('error_pass', 'required'); }
		$FP->Template->setAlert('Please fill in all required fields', 'error');
		echo '<script type="text/javascript">jQuery.colorbox.resize();</script>';
		$FP->Template->load(APP_PATH . "core/views/v_login.php");
	}
	else if ($FP->Auth->validateLogin($FP->Template->getData('input_user'), $FP->Template->getData('input_pass')) == FALSE)
	{
		// invalid login
		$FP->Template->setAlert('Invalid username or password!', 'error');
		echo '<script type="text/javascript">jQuery.colorbox.resize();</script>';
		$FP->Template->load(APP_PATH . "core/views/v_login.php");
	}
	else
	{
		// successful log in	
		$_SESSION['username'] = $FP->Template->getData('input_user');
		$_SESSION['loggedin'] = TRUE;
		$FP->Template->load(APP_PATH . "core/views/v_loggingin.php");
	}
}
else
{
	$FP->Template->load(APP_PATH . "core/views/v_login.php");
}