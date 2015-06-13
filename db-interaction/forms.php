<?php

session_start();

include_once "../inc/config.inc.php";
include_once "../inc/class.forms.inc.php";
$formObj = new MLFForms();

if(!empty($_POST['action']) ) {
	switch ($_POST['action']) {
		case 'createfield' :
			$formObj->createField();
			break;
		case 'getfield' :
			$formObj->getField();
			break;
		case 'editfield' :
			$formObj->editField();
			break;
		case 'deletefield' :
			$formObj->deleteField();
			break;
		default : 
			echo "There was an error processing the field";
			break;
	}
}

?>