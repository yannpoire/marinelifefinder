<?php
session_start();
include_once "../inc/config.inc.php";
include_once "../inc/class.tree.inc.php";
$treeObj = new MLFTree();
	/*
	 * Check user access and validate post from form is not empty
	 */
if(!empty($_POST['action']) && $_POST['action'] == 'addbranch' && isset ($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1) {

	//echo "Logged in and all values good";
	$bn = trim($_POST['bname']);
	$ba = preg_replace('/\s+/', '', strtolower($bn));
	$bc = trim($_POST['bcommonname']);
	$bf;
	$bt = $_POST['btaxonomy'];
	$bs = trim($_POST['bsummary']);
	$r = trim($_POST['brank']);
	// get mother branch name

	if (!empty($r)) {
		switch ($r) {
			case 's':
				$bf = $_POST['bfromselected'];
				break;
			case 't':
				$bf = preg_replace('/\s+/', '', trim($_POST['bfromtyped']));
				break;
			default:
				echo "No value for rank radio?";
				break;
		}
	}
	
	$treeObj->growBranch($bn, $ba, $bc, $bf, $bt, $bs);

} else {
	echo "<h2>Error!</h2><p>Invalid form or not logged in</p>";
}

?>