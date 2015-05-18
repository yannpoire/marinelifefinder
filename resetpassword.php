<?php
    include_once "common/base.php";

    if(isset($_GET['v']) && isset($_GET['e']))
    {
        include_once "inc/class.users.inc.php";
        $users = new MLFUsers($db);
        $ret = $users->verifyAccount();
    }
    elseif(isset($_POST['v']))
    {
        include_once "inc/class.users.inc.php";
        $users = new MLFUsers($db);
        $status = $users->updatePassword() ? "changed" : "failed";
        header("Location: account.php?password=$status");
        exit;
    }
    else
    {
        header("Location: login.php");
        exit;
    }

    $pageTitle = "Reset Your Password";
    include_once "common/header.php";
	include_once "common/mainnav.php";

    if ( isset($ret[0])):
        echo isset($ret[1]) ? $ret[1] : NULL;

        if($ret[0]<3):
?>

<div class="container">
	<div class="row">
        <h2>Reset Your Password</h2>

        <form method="post" action="accountverify.php">
            <div class="form-group">
                <label for="p">Choose a New Password:</label>
                <input type="password" name="p" id="p" class="form-control" /><br />
                <label for="r">Re-Type Password:</label>
                <input type="password" name="r" id="r" class="form-control" /><br />
                <input type="hidden" name="v" value="<?php echo $_GET['v'] ?>" />
                <input type="submit" name="verify" id="verify" value="Reset Your Password" />
            </div>
        </form>
	</div>
</div>

<?php
        endif;
    else:
        echo '<meta http-equiv="refresh" content="0;/">';
    endif;

    include_once 'common/footer.php';
?>