<?php
session_start();
include_once "../inc/config.inc.php";
include_once "../inc/class.tree.inc.php";
$treeObj = new MLFTree();
$formVal = array();

print_r($_POST);

$bn = trim($_POST['branchname']);
$ba = preg_replace($pattern, ' ', $bn);
$bc = trim($_POST['branchcommonname']);
$typ = NULL;
$sb = trim($_POST['selectbranch']);
$kb = trim($_POST['knownbranch']);

$bt;
$bs = trim($_POST['branchsummary']);

$formval = array(trim($_POST['branchname']),
	preg_replace('/\s+/', '', trim(strtolower($_POST['branchname']))),
	trim($_POST['branchcommonname']) ) ;
		
		/*
		 * Check required fields for empty values 
		 */
		if (empty($ba)) {
			return '<h2>Error</h2><p>Houston! We have a big problem, there were no alias set for the branch</p>';
		} elseif (empty($bn)) {
			return '<h2>Error</h2><p>Oups! Sorry, a branch must have a name';
		} elseif (empty($kb) && empty($sb) || $kb !== $sb) {
	/// Will require client side disabling of one or another field
			return '<h2>Error</h2><p>Oups! Sorry, no mother branch to grow on or two different mother branch has been selected</p>';
		} else {
			if (!empty($kb)) {
				$bf = $kb;
			} else {
				$bf = $sb;
			}
		}
//Check if user is authenticated and admin
// *** ADD ADMIN IN USER DB ***
if(!empty($_POST['action']) && $_POST == 'addbranch' && isset ($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1) {
	echo "add branch";
	print_r($treeObj);
	//$treeObj->addBranch();
	//$status = $userObj->addBranch();
} else {
	echo "else";
    //header("Location: ../index.php");
    exit;
}
?>