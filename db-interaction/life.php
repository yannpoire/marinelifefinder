<?php

session_start();

include_once "../inc/config.inc.php";
include_once "../inc/class.life.inc.php";
$lifeObj = new MLFLife();

if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1) {

	if(!empty($_GET) ) {
		
	}
	
	if(!empty($_POST['action']) ) {
		$lifegroup = $_POST['lifegroup'];
		switch ($_POST['action']) {
			case 'fetchlife' :
				$lifeObj->fetchLife($lifegroup);
				break;
			case 'createlife' :
				$lifeObj->giveLife($lifegroup);
				break;
			case 'editlife' :
				$lifeObj->editLife();
				break;
			case 'deletepage' :
				$lifeObj->deleteLife();
				break;
			default : 
				echo "There was an error processing the page request";
				break;
		}
	}
}