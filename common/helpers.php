<?php

function displayFeedback ($type, $message) {
	
	switch ($type) {
		case 'success' :
			echo "<div class=\"alert alert-success alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
				</button><strong>Success!</strong>".$message." You can view <a class=\"alert-link\" href=\"fieldmanager.php\">all the fields</a> or use the form to make more changes</div>";
			break;
		case 'warning':
			echo "<div class=\"alert alert-warning alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
				</button><strong>Warning!</strong>No changes has been made because no fields were modified. If you do not want to make changes you can go back to the list of <a class=\"alert-link\" href=\"fieldmanager.php\">all the fields</a></div>";
			break;
		case 'failure' :
			echo "<div class=\"alert alert-failure alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
				</button><strong>Success!</strong>".$message."</div>";
			break;
		default:
			echo "<div class=\"alert alert-danger alert-dismissible\"><strong>Failed!</strong> something went wrong... Very wrong... Very very wrong...</div>";
			break;
		} 
	}
	
}


?>