<?php

session_start();

include_once "../inc/config.inc.php";
include_once "../inc/class.pages.inc.php";
$pageObj = new MLFPages();

if(!empty($_POST['action']) && isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1) {
	switch ($_POST['action']) {
		case 'fetchlife' :
			echo"";
			break;
		case 'createlife' :
			$alias = strtolower(trim($_POST['pagetitle']));
			$ali = preg_replace('/\s+/', '-', $alias);
			$_POST['pagealias'] = $ali;
			$pageObj->createLife();
			break;
		case 'editlife' :
			$pageObj->editLife();
			break;
		case 'deletepage' :
			$pageObj->deleteLife();
			break;
		default : 
			echo "There was an error processing the page request";
	}
} 
