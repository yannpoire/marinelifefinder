<?php
    include_once "common/base.php";
    if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1):
        $pageTitle = "Your Account";
        include_once "common/header.php";
        include_once 'inc/class.users.inc.php';
        $users = new MLFUsers($db);

        if(isset($_GET['email']) && $_GET['email']=="changed")
        {
            echo "<div class=\"alert alert-success alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Success!</strong> Your email has been changed</div>";
        }
        else if(isset($_GET['email']) && $_GET['email']=="failed")
        {
            echo "<div class=\"alert alert-danger alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Warning!</strong> There was a problem changing your email</div>";
        }

        if(isset($_GET['password']) && $_GET['password']=="changed")
        {
            echo "<div class=\"alert alert-success alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Success!</strong> Your password has been changed</div>";
        }
        elseif(isset($_GET['password']) && $_GET['password']=="nomatch")
        {
            echo "<div class=\"alert alert-warning alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Warning!</strong> The two passwords don't match</div>";
        }

        if(isset($_GET['delete']) && $_GET['delete']=="failed")
        {
            echo "<div class=\"alert alert-danger alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Warning!</strong> There was a problem deleting your account</div>";
        }

        list($id, $v) = $users->retrieveAccountInfo();
?>
</head>
<body>
	<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
?>
<div class="container">
	<!-- Example row of columns -->
	<div class="row">
		<div class="col-md-12">
	        <h2>Your Account details</h2>
	        <form method="post" action="db-interaction/users.php">
	            <div>
	                <input type="hidden" name="userid" value="<?php echo $id ?>" />
	                <input type="hidden" name="action" value="changeemail" />
	                <input type="text" name="username" id="username" class="form-control" />
	                <label for="username">Change Email Address</label>
	                <br /><br />
	                <input type="submit" name="change-email-submit" id="change-email-submit" value="Change Email" class="button" />
	            </div>
	        </form><br /><br />
	
	        <form method="post" action="db-interaction/users.php" id="change-password-form">
	            <div>
	                <input type="hidden" name="user-id" value="<?php echo $id ?>" />
	                <input type="hidden" name="v" value="<?php echo $v ?>" />
	                <input type="hidden" name="action" value="changepassword" />
	                <label for="password">New Password</label>
	                <input type="password" name="p" id="new-password" class="form-control" />
	                <br /><br />
	                <label for="password">Repeat New Password</label>
	                <input type="password" name="r" id="repeat-new-password" class="form-control" />
	                <br /><br />
	                <input type="submit" name="change-password-submit" id="change-password-submit" value="Change Password" class="button" />
	            </div>
	        </form>
	        <hr />
	
	        <form method="post" action="deleteaccount.php" id="delete-account-form">
	            <div>
	                <input type="hidden" name="user-id" value="<?php echo $id ?>" />
	                <input type="submit" name="delete-account-submit" id="delete-account-submit" value="Delete Account?" class="button" />
	            </div>
	        </form>
	    </div>
	</div>
</div>

<?php
    else:
        header("Location: index.php");
        exit;
    endif;
?>

<?php include_once(ROOT_PATH."common/footer.php"); ?>
<script>
	$(function(){
		$('.adminnav > li').bind('mouseover', openSubMenu);
		$('.adminnav > li').bind('mouseout', closeSubMenu);
		function openSubMenu() {
			$(this).find('ul').css('visibility', 'visible');	
		};
		function closeSubMenu() {
			$(this).find('ul').css('visibility', 'hidden');	
		};	   
	});
</script>
<script>
	$(function() {
		if ($('div.timedmsg')) {
			$( "div.timedmsg" ).slideDown( 1800, function() {
		  	}).delay( 5000 ).slideUp(1600);
		 }
	});
</script>