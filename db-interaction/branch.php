<?php
session_start();
include_once "../inc/config.inc.php";
include_once "../inc/class.tree.inc.php";
$treeObj = new MLFTree();

if(!empty($_POST['action']) && isset ($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1) {
	
	switch ($_POST['action']) {
		case 'createbranch' :
			try { $treeObj->createBranch(); } catch (PDOException $e) { echo 'Error inserting into DB: ' . $e->getMessage(); print_r($db->errorInfo()); return FALSE; }
			break;
		case 'updatebranch' :
			try { $treeObj->updateBranch(); } catch (PDOException $e) { echo 'Error updating the DB: ' . $e->getMessage(); print_r($db->errorInfo()); return FALSE; }
			break;
		default :
			header("Location: ../index.php");
	}

} else {
	echo "<h2>Error!</h2><p>Invalid form or not logged in</p>";
}

?>