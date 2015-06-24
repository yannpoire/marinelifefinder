<?php

class MLFModules {
	
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
	
	/*
	 * 
	 * Fish of the day display randomly a fish from the DB for everyday
	 * 
	 */

	public function fishoftheday () {
		// $sql = "SELECT fid, fcname FROM mlf_fish WHERE fid = ".rand(1, 3)." LIMIT 1";
		$sql = "SELECT fid, fcname FROM mlf_fish WHERE fid = 3 LIMIT 1";
		
		try {
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			$fishoftheday = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();		
		} catch (PDOException $e) {
			echo 'Error inserting into DB: ' . $e->getMessage();
			print_r($db->errorInfo());
			return FALSE;
		}
		
		// var_dump($fishoftheday);
		
		$name = $fishoftheday[0];
		
		echo "<h3>Fish of the Day</h1>",
		"<h4>".$name['fcname']."</h4>",
		"<p><a href=\"#\">Learn more about >></p>";
		
	}
}

?>