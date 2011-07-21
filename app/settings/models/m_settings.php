<?php

/*
	Settings class
	Deal with currently logged in user's tasks
*/

class Settings
{
	function changePassword($user, $newpass)
	{
		global $FP;
		
		if ($stmt = $FP->Database->prepare("UPDATE users SET password = ? WHERE username = ?"))
		{
			$stmt->bind_param('ss', md5($newpass . $FP->Auth->getSalt()), $user);
			$stmt->execute();
			$stmt->close();
			
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}