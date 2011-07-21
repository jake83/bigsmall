<?php

include("../init.php");
include("models/m_settings.php");
$Settings = new Settings();

$FP->Auth->checkAuthorization();

if (isset($_POST['submit']))
{
	// get data
	$FP->Template->setData('oldpass', $_POST['oldpass']);
	$FP->Template->setData('newpass', $_POST['newpass']);
	$FP->Template->setData('newpass2', $_POST['newpass2']);
	
	// validate data
	if ($_POST['oldpass'] == '' || $_POST['newpass'] == '' || $_POST['newpass2'] == '')
	{
		if ($_POST['oldpass'] == '') { $FP->Template->setData('error_oldpass', 'required field!'); }
		if ($_POST['newpass'] == '') { $FP->Template->setData('error_newpass', 'required field!'); }
		if ($_POST['newpass2'] == '') { $FP->Template->setData('error_newpass2', 'required field!'); }
		$FP->Template->setAlert('Please fill in all required fields.', 'error');
		$FP->Template->load(APP_PATH . 'settings/views/v_password.php');
	}
	else if ($_POST['newpass'] != $_POST['newpass2'])
	{
		$FP->Template->setData('error_newpass', 'must match!');
		$FP->Template->setData('error_newpass2', 'must match!');
		$FP->Template->setAlert('Please make sure that both new password fields match.', 'error');
		$FP->Template->load(APP_PATH . 'settings/views/v_password.php');
	}
	else if ($FP->Auth->validateLogin($FP->Auth->getCurrentUserName(), $FP->Template->getData('oldpass')) == FALSE)
	{
		// invalid old password	
		$FP->Template->setData('error_oldpass', 'incorrect password!');
		$FP->Template->setAlert('Old password is incorrect. Please re-enter.', 'error');
		$FP->Template->load(APP_PATH . 'settings/views/v_password.php');
	}
	else
	{
		$changed = $Settings->changePassword($FP->Auth->getCurrentUserName(), $FP->Template->getData('newpass'));
		
		if ($changed == TRUE)
		{
			$FP->Template->setData('oldpass', '');
			$FP->Template->setData('newpass', '');
			$FP->Template->setData('newpass2', '');
			$FP->Template->setAlert('Password has been changed successfully.');
			$FP->Template->load(APP_PATH . 'settings/views/v_password.php');
		}
		else
		{
			$FP->Template->setData('oldpass', '');
			$FP->Template->setData('newpass', '');
			$FP->Template->setData('newpass2', '');
			$FP->Template->setAlert('An error has occurred. Please try again later.', 'error');
			$FP->Template->load(APP_PATH . 'settings/views/v_password.php');
		}
	}
}
else
{
	// load view
	$FP->Template->load(APP_PATH . 'settings/views/v_password.php');
}