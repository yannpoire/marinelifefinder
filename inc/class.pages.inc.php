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
	
	public function showPage($url) {
		$sql = "SELECT * FROM mlf_pages WHERE pagealias= :pageurl LIMIT 1";
		try {
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':pageurl', $url, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			if (isset($result) && $result['pagestatus'] == 0) {
				echo "This is not published";
				$result = NULL;
				header("Location : index.php");
			} else {
				return $result;
			}
		} catch (PDOException $e) {
            return FALSE;
		}
	}
	
	public function getPage($pageID) {
		if(isset($pageID) && !empty($pageID)) {
			$sql = "SELECT * FROM mlf_pages WHERE pageID = :pageID LIMIT 1";
			try {
				$stmt = $this->$_db->prepare($sql);
				$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
				$stmt->execute();
            	$page = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
			} catch (PDOException $e) {
            	return FALSE;
			}
			return $page;
		}
	}
	
	public function fetchPages($scope) {
		if (empty($scope)) {
			$sql = "SELECT pagestatus, pagetitle, pagealias, pagecat, pagecontent, metadesc, metakeys, pageurl FROM mlf_pages GROUP BY pagetitle ASC";
		} else {
			$sql = "SELECT * FROM mlf_pages WHERE pagecat = :pagecat";
		}
		if ( $stmt = $this->_db->prepare($sql) ) {
			if (!empty($scope)) {
            	$stmt->bindParam(":pagecat", $scope, PDO::PARAM_STR);
			}
            $stmt->execute();
            $pages = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $pages;
		}
	}
	
	public function createPage() {
		$alias = $_POST['pagealias'];
		$sql = "SELECT COUNT(pagealias) AS theCount FROM mlf_pages WHERE pagealias= :pagealias";
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":pagealias", $alias, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
			$stmt->closeCursor();
			if ($row['theCount'] != 0) {
				echo '<h2>Error</h2><p>Oups! Sorry, that page already exist!</p><br />';
			} else {
				switch ($_POST['pagestatus']) {
					case 'draft':
						$status = 0;
						break;
					case 'published':
						$status = 1;
						break;
					default :
						$status = 0;
						break;
				}
				$currenttime = time();
				//echo "Page status return from switch ====".$status;
				//echo "Starting to insert into DB";
				//echo "The POST is equal to = "; print_r($_POST);
				//echo "Current UNIX time ====".$currenttime;
				$sql = "INSERT INTO mlf_pages (pagestatus, pagetitle, pagealias, pagecat, pagecontent, metadesc, metakeys, pageurl, created, modified, username ) VALUES (:pagestatus, :pagetitle, :pagealias, :pagecat, :pagecontent, :metadesc, :metakeys, :pageurl, :created, :modified, :username )";
				if ($stmt = $this->_db->prepare($sql)) {
					try { 
						$stmt->bindParam(":lifestatus", $status, PDO::PARAM_INT);
						$stmt->bindParam(":lifetitle", $_POST['pagetitle'], PDO::PARAM_STR);
						$stmt->bindParam(":lifealias", $alias, PDO::PARAM_STR);
						$stmt->bindParam(":lifegenus", $_POST['pagecat'], PDO::PARAM_STR);
						$stmt->bindParam(":lifecontent", $_POST['pagecontent'], PDO::PARAM_STR);
						$stmt->bindParam(":metadesc", $_POST['metadesc'], PDO::PARAM_STR);
						$stmt->bindParam(":metakeys", $_POST['metakeys'], PDO::PARAM_STR);
						$stmt->bindParam(":pageurl", $_POST['pageurl'], PDO::PARAM_STR);
						$stmt->bindParam(":created", $currenttime, PDO::PARAM_INT);
						$stmt->bindParam(":modified", $currenttime, PDO::PARAM_INT);
						$stmt->bindParam(":username", $_SESSION['username'], PDO::PARAM_STR);
						$stmt->execute();
						$stmt->closeCursor(); 
						}	catch (PDOException $e) {
							$e->getMessage();
						}
						
					echo "Page successfully created";
					//header("Location: ../admin/pagemanager.php");
				} else {
					echo "There was an error creating the page";
				}
			}	
		}
	}
}

?>