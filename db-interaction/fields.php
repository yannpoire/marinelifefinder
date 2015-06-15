<?php

session_start();

include_once "../inc/config.inc.php";
include_once "../inc/class.fields.inc.php";

$fieldObj = new MLFFields();

if(isset($_GET) && !empty($_GET)) {
	var_dump($_GET);
	if ($_GET['status'] == 1 && isset($_GET['id']) && !empty($_GET['id'])) {
		$fieldObj->updateField();
	}
}

if ($_POST) {
	switch ($_POST['action']) {
		case 'createfield':
			$fieldObj->createField();
			break;
		case 'updatefield':
			$fieldObj->updateField();
			break;
		default:
			echo "There is a problem with fields";
			break;
	}
}

?>