<?php

class MLFUsers {
    /**
     * The database object
     *
     * @var object
     */
    private $_db;

    /**
     * Checks for a database object and creates one if none is found
     *
     * @param object $db
     * @return void
     */
    public function __construct($db=NULL) {
        if(is_object($db)) {
            $this->_db = $db;
        } else {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }
	/**
     * Checks and inserts a new account email into the database
     *
     * @return string    a message indicating the action status
     */
    public function createAccount() {
        $u = trim($_POST['username']);
        $v = sha1(time());

        $sql = "SELECT COUNT(username) AS theCount FROM marine_users WHERE username=:email";
        if ( $stmt = $this->_db->prepare($sql) ) {
            $stmt->bindParam(":email", $u, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if($row['theCount']!=0) {
                return "<h2> Error </h2>" . "<p> Sorry, that email is already in use. " . "Please try again. </p>";
            }
            if ( !$this->sendVerificationEmail($u, $v) ) {
                return "<h2> Error </h2>" . "<p> There was an error sending your" . " verification email. Please " . "<a href='mailto:help@coloredlists.com'>contact " . "us</a> for support. We apologize for the " . "inconvenience. </p>";
            }
            $stmt->closeCursor();
        }

        $sql = "INSERT INTO marine_users(username, ver_code) VALUES(:email, :ver)";
        if ( $stmt = $this->_db->prepare($sql) ) {
            $stmt->bindParam(":email", $u, PDO::PARAM_STR);
            $stmt->bindParam(":ver", $v, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();

            $userID = $this->_db->lastInsertId();
            $url = dechex($userID);

            /*
             * If the UserID was successfully
             * retrieved, create a default list.
             */
            $sql = "INSERT INTO marine_lists (UserID, ListURL) VALUES ($userID, $url)";
            if(!$this->_db->query($sql)) {
                return "<h2> Error </h2>" . "<p> Your account was created, but " . "creating your first list failed. </p>";
            } else {
                return "<h2> Success! </h2>" . "<p> Your account was successfully " . "created with the username <strong>$u</strong>." . " Check your email!";
            }
        } else {
            return "<h2> Error </h2><p> Couldn't insert the " . "user information into the database. </p>";
        }
    }

	/**
     * Sends an email to a user with a link to verify their new account
     *
     * @param string $email    The user's email address
     * @param string $ver    The random verification code for the user
     * @return boolean        TRUE on successful send and FALSE on failure
     */
    private function sendVerificationEmail($email, $ver)
    {
        $e = sha1($email); // For verification purposes
        $to = trim($email);

        $subject = "[Marine Life Finder] Please Verify Your Account";

        $headers = <<<MESSAGE
From: Marine Life Finder <donotreply@marinelifefinder.com>
Content-Type: text/plain;
MESSAGE;

        $msg = <<<EMAIL
You have a new account at Marine Life Finder!

To get started, please activate your account and choose a
password by following the link below.

Your Username: $email

Activate your account: http://marinelifefinder.com/accountverify.php?v=$ver&e=$e

If you have any questions, please contact help@coloredlists.com.

--
Thanks!

Yann Poire
www.marinelifefinder.com
EMAIL;
        return mail($to, $subject, $msg, $headers);
    }

	/**
     * Checks credentials and verifies a user account
     *
     * @return array    an array containing a status code and status message
     */
    public function verifyAccount() {
        $sql = "SELECT username FROM marine_users WHERE ver_code=:ver AND SHA1(username)=:user AND verified=0";

        if( $stmt = $this->_db->prepare($sql) ) {
            $stmt->bindParam(':ver', $_GET['v'], PDO::PARAM_STR);
            $stmt->bindParam(':user', $_GET['e'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if (isset($row['username'])) {
                // Logs the user in if verification is successful
                $_SESSION['username'] = $row['username'];
                $_SESSION['LoggedIn'] = 1;
            } else {
                return array(4, "<h2>Verification Error</h2>" . "<p>This account has already been verified. " . "Did you <a href='password.php'>forget " . "your password?</a>");
            }
            $stmt->closeCursor();

            // No error message is required if verification is successful
            return array(0, NULL);
        } else {
            return array(2, "<h2>Error</h2><p>Database error.</p>");
        }
    }

	/**
     * Changes the user's password
     *
     * @return boolean    TRUE on success and FALSE on failure
     */
    public function updatePassword() {
        if ( isset($_POST['p']) && isset($_POST['r']) && $_POST['p'] == $_POST['r'] ) {
            $sql = "UPDATE marine_users SET password=MD5(:pass), verified=1 WHERE ver_code=:ver LIMIT 1";
            try {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(":pass", $_POST['p'], PDO::PARAM_STR);
                $stmt->bindParam(":ver", $_POST['v'], PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();

                return TRUE;
            }
            catch(PDOException $e) {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
	
	/**
     * Checks credentials and logs in the user
     *
     * @return boolean    TRUE on success and FALSE on failure
     */
    public function accountLogin() {
        $sql = "SELECT username FROM marine_users WHERE username=:user  AND password=MD5(:pass) LIMIT 1";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':user', $_POST['username'], PDO::PARAM_STR);
            $stmt->bindParam(':pass', $_POST['password'], PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount()==1) {
                $_SESSION['username'] = htmlentities($_POST['username'], ENT_QUOTES);
                $_SESSION['LoggedIn'] = 1;
                return TRUE;
            } else {
                return FALSE;
            }
        }
        catch(PDOException $e) {
            return FALSE;
        }
    }
    
    /**
     * Retrieves the ID and verification code for a user
     *
     * @return mixed    an array of info or FALSE on failure
     */
    public function retrieveAccountInfo() {
        $sql = "SELECT id, ver_code FROM marine_users WHERE username=:user";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':user', $_SESSION['username'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $stmt->closeCursor();
            return array($row['id'], $row['ver_code']);
        }
        catch(PDOException $e) {
            return FALSE;
        }
    }
	
	/**
     * Changes a user's email address
     *
     * @return boolean    TRUE on success and FALSE on failure
     */
    public function updateEmail() {
        $sql = "UPDATE marine_users SET username=:email WHERE id=:user LIMIT 1";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':email', $_POST['username'], PDO::PARAM_STR);
            $stmt->bindParam(':user', $_POST['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();

            // Updates the session variable
            $_SESSION['username'] = htmlentities($_POST['username'], ENT_QUOTES);

            return TRUE;
        }
        catch(PDOException $e) {
            return FALSE;
        }
    }
	
	/**
     * Deletes an account and all associated lists and items
     *
     * @return void
     */
    public function deleteAccount()
    {
        if ( isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == 1) {
            // Delete list items
            $sql = "DELETE FROM marine_list_items WHERE ListID=( SELECT ListID FROM lists WHERE UserID=:user LIMIT 1 ";
            try {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(":user", $_POST['user-id'], PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
            }
            catch(PDOException $e) {
                die($e->getMessage());
            }

            // Delete the user's list(s)
            $sql = "DELETE FROM marine_lists WHERE id=:user";
            try {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(":user", $_POST['user-id'], PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
            }
            catch(PDOException $e) {
                die($e->getMessage());
            }

            // Delete the user
            $sql = "DELETE FROM marine_users WHERE id=:user AND username=:email";
            try {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(":user", $_POST['user-id'], PDO::PARAM_INT);
                $stmt->bindParam(":email", $_SESSION['username'], PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();
            }
            catch(PDOException $e) {
                die($e->getMessage());
            }

            // Destroy the user's session and send to a confirmation page
            unset($_SESSION['LoggedIn'], $_SESSION['username']);
            header("Location: /gone.php");
            exit;
        } else {
            header("Location: /account.php?delete=failed");
            exit;
        }
    }

	/**
     * Resets a user's status to unverified and sends them an email
     *
     * @return mixed    TRUE on success and a message on failure
     */
    public function resetPassword() {
        $sql = "UPDATE marine_users SET verified=0 WHERE username=:user LIMIT 1";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(":user", $_POST['username'], PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
        }
        catch(PDOException $e) {
            return $e->getMessage();
        }

        // Send the reset email
        if ( !$this->sendResetEmail($_POST['username'], $v) ) {
            return "Sending the email failed!";
       }
        return TRUE;
    }
	
	/**
     * Sends a link to a user that lets them reset their password
     *
     * @param string $email    the user's email address
     * @param string $ver    the user's verification code
     * @return boolean        TRUE on success and FALSE on failure
     */
    private function sendResetEmail($email, $ver) {
        $e = sha1($email); // For verification purposes
        $to = trim($email);

        $subject = "[Marine Life Finder] Request to Reset Your Password";

        $headers = <<<MESSAGE
From: Marine Life Finder <donotreply@marinelifefinder.com>
Content-Type: text/plain;
MESSAGE;

        $msg = <<<EMAIL
We just heard you forgot your password! Bummer! To get going again,
head over to the link below and choose a new password.

Follow this link to reset your password:
http://marinelifefinder.com/resetpassword.php?v=$ver&e=$e

If you have any questions, please contact y@nnpoire.com.

--
Thanks!

Yann Poiré
www.marinelifefinder.com
EMAIL;

        return mail($to, $subject, $msg, $headers);
    }
	
	
	
}


?>