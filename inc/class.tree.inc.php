<?php

class MLFTree {
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
	
	public function createTreeItem () {
		// check if it exist
		
	}
	
	public function createAccount() {
        $b = trim($_POST['branchname']);
        $f = trim($_POST['branchfrom']);
		$c = trim($_POST['branchcommonname']);

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
	
}

?>