<?php

session_start();

include_once "../inc/config.inc.php";
include_once "../inc/class.search.inc.php";
$searchObj = new MLFSearch();

if(!empty($_POST['action'])) {
	switch ($_POST['action']) {
		case 'quicksearch' :
			
			$_SESSION['results'] = $searchObj->searchLife();
			header("Location: ../search/results.php");
			break;
			
		case 'advancedsearch' :
			break;
			
		case 'customsearch' :
			break;
			
		default : 
			echo "There was an error processing the page request";
	}
}
