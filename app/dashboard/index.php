<?php 
	
include('../init.php'); 
$FP->Auth->checkAuthorization();

// load view
$FP->Template->load(APP_PATH . 'dashboard/views/v_dashboard.php');