<?php

session_start();

include_once "../inc/config.inc.php";
include_once "../inc/class.life.inc.php";
$pageObj = new MLFLife();

if(!empty($_POST['action']) && isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1) {
	$lifegroup = $_POST['lifegroup'];
	switch ($_POST['action']) {
		case 'fetchlife' :
			echo"";
			break;
		case 'createlife' :
			$pageObj->createLife($lifegroup);
			break;
		case 'editlife' :
			$pageObj->editLife();
			break;
		case 'deletepage' :
			$pageObj->deleteLife();
			break;
		default : 
			echo "There was an error processing the page request";
			break;
	}
}
