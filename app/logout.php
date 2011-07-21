<?php

include("init.php");

// log out 
$FP->Auth->logout();

// redirect
$FP->Template->redirect(SITE_PATH);