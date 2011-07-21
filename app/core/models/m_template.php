<?php

/*
	Template Class
	Handles all templating tasks - displaying templates, alerts & errors
*/

class Template
{
	private $data;
	private $alertTypes;
	
	/*
		Construtor
	*/
	function __construct() {}
	
	/*
		Functions
	*/
	function load($url)
	{
		include($url);
	}
	
	function redirect($url)
	{
		header("Location: $url");
	}
	
	/*
		Get / Set Data
	*/
	function setData($name, $value, $clean = true)
	{
		if ($clean)
		{
			$this->data[$name] = htmlentities($value, ENT_QUOTES);
		}
		else
		{
			$this->data[$name] = $value;
		}
	}
	
	function getData($name)
	{
		if (isset($this->data[$name]))
		{
			return $this->data[$name];
		}
		else
		{
			return '';
		}
	}
	
	/*
		Get / Set Alerts
	*/
	function setAlertTypes($types)
	{
		$this->alertTypes = $types;
	}
	function setAlert($value, $type = null)
	{
		if ($type == '') { $type = $this->alertTypes[0]; }
		$_SESSION[$type][] = $value;
	}
	function getAlerts()
	{
		$data = '';
		foreach($this->alertTypes as $alert)
		{			
			if (isset($_SESSION[$alert]))
			{
				foreach($_SESSION[$alert] as $value)
				{
					$data .= '<li class="'. $alert .'">' . $value . '</li>';
				}
				unset($_SESSION[$alert]);
			}
		}
		return $data;
	}
	
	function error($type = '', $message = '')
	{
		if ($type == 'unauthorized')
		{
			$this->load(APP_PATH . 'core/views/v_unauthorized.php');
		}
		else
		{ 
			if ($message != '')
			{
				$this->setData('message', $message);    
			}
			else
			{
				$this->setData('message', "An error has occurred. Please contact the website administrator."); 
			}
			$this->load(APP_PATH . 'core/views/v_error.php');
		}
	}
	
	function cms_nav($selected_section = '', $selected_subsection = '')
	{
		$sections = array(
			array(
				'dashboard' => 'inactive'
			),
			array(
				'users' => 'inactive',
				'manage_users' => 'inactive',
				'create_user' => 'inactive'
			),	
			array(
				'settings' => 'inactive',
				'change_password' => 'inactive'
			)
		);
		
		foreach ($sections as &$section)
		{
			if (array_key_exists($selected_section, $section))
			{
				$section[$selected_section] = 'active';
			}
			if (array_key_exists($selected_subsection, $section))
			{
				$section[$selected_subsection] = 'active';
			}
		}
		
		$nav = '<ul class="fp_nav">';
		$nav .= '<li class="' . $sections[0]['dashboard'] . '">
					<a href="../dashboard/index.php">Dashboard</a>
				</li>';
		$nav .= '<li class="' . $sections[1]['users'] . '">
					<span>Users</span>
					<ul>
						<li class="' . $sections[1]['manage_users'] . '">
							<a href="#">Manage Users</a>
						</li>
						<li class="' . $sections[1]['create_user'] . '">
							<a href="#">Create User</a>
						</li>
					</ul>
				</li>';
		$nav .= '<li class="' . $sections[2]['settings'] . '">
					<span>Settings</span>
					<ul>
						<li class="' . $sections[2]['change_password'] . '">
							<a href="../settings/password.php">Change Password</a>
						</li>
					</ul>
				</li>';
		$nav .= '</ul>';
		
		echo $nav;
	}
}

