<?php
//Check if user is authenticated and admin
// *** ADD ADMIN IN USER DB ***
if(!empty($_POST['action']) && $_POST['action'] == "addbranch" && isset ($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1) {
	$status = $userObj->addBranch();
    break;
} else {
    header("Location: ".ROOT_PATH."/index.php");
    exit;
}
?>