<?php

class MLFPages {
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
	
	public function fetchPages($scope) {
		$sql = "SELECT * WHERE pagecategory = :pagecat";
		if ( $stmt = $this->_db->prepare($sql) ) {
            $stmt->bindParam(":pagecat", $scope, PDO::PARAM_STR);
            $stmt->execute();
            $pages = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $pages;
		}
	}
	
	public function createPage() {
		$pagealias = strtolower(trim($_POST['pagetitle']));
		$created = date();
		$lastedit = $created;
		
		$sql = "SELECT COUNT(pagealias) AS theCount FROM mlf_pages WHERE pagealias= :pagealias";
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":pagealias", $_POST['pagealias'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
			$stmt->closeCursor();
			if ($row['theCount'] != 0) {
				echo '<h2>Error</h2><p>Oups! Sorry, that branch is already growing in the tree!</p><br />';
			} else {
				print_r($_POST);
				$sql = "INSERT INTO mlf_pages (pagetitle, pagealias, pagecategory, created, lastedit, pagecontent, metadesc, metakeys, pageurl, pagestatus) VALUES (:pagetitle, :pagealias, :pagecategory, :created, :lastedit, :pagecontent, :metadesc, :metakeys, :pageurl, :pagestatus)";
				$pagealias = strtolower(trim($_POST['pagetitle']));
				$created = date();
				$lastedit = $created;
				echo "Page alias is =  ".$pagealias."<br>Date created = ".$created;
				print_r ($elems);
				if(isset($elems) && !empty($elems) && $stmt = $this->_db->prepare($sql)) {
					$stmt->bindParam(":pagetitle", $_POST['pagetitle'], PDO::PARAM_STR);
					$stmt->bindParam(":pagealias", $pagealias, PDO::PARAM_STR);
					$stmt->bindParam(":pagecategory", $elems['pagecategory'], PDO::PARAM_STR);
					$stmt->bindParam(":created", $created, PDO::PARAM_STR);
					$stmt->bindParam(":lastedit", $lastedit, PDO::PARAM_STR);
					$stmt->bindParam(":pagecontent", $elems['pagecontent'], PDO::PARAM_STR);
					$stmt->bindParam(":metadesc", $elems['metadescription'], PDO::PARAM_STR);
					$stmt->bindParam(":metakeys", $elems['metakeywords'], PDO::PARAM_STR);
					$stmt->bindParam(":pageurl", $pagealias, PDO::PARAM_STR);
					$stmt->bindParam(":pagestatus", $pagestatus, PDO::PARAM_STR);
					$stmt->execute();
					$stmt->closeCursor();
					echo "Page successfully created";
					//header("Location: ../admin/pagemanager.php");
				} else {
					echo "There was an error creating the page";
					print_r($elems);
				}
			}	
		}
	}
}

?>