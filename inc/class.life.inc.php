<?php

class MLFLife {
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
	
	public function showLife($url) {
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
	
	public function fetchLife($lifegroup) {
		if (empty($lifegroup)) {
			echo "Needs life group to operate. Precise what you are looking for";
		} else {
			switch ($lifegroup) {
				case 'Fish' :
					$sql = "SELECT fid, fstatus, falias, fcname, ffamilycname, fbinomialfirst, fbinomiallast, fclassification, fmetadesc, fmetakeys, fmodified FROM mlf_fish GROUP BY fbinomialfirst ORDER BY fbinomiallast";
					break;
				case 'Nudibranch' :
					$sql = "SELECT * FROM mlf_nudi GROUP BY nbinomialfirst ORDER BY fbinomiallast";
					break;
				default:
					echo "Something went wrong";
					break;
			}
			try {
				$stmt = $this->_db->prepare($sql);
				$stmt->execute();
            	$fishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $fishes;
			} catch (PDOException $e) {
				return FALSE;
			}
		}
	}
	
	public function giveLife($lifegroup) {
		$queryarr = array();
		
	// Get the lifegroup the new creature belongs to and set variables accordingly;
		
		switch ($lifegroup) {
			case "Fish" :
				$pre ="f";
				$table = "fish";
				break;
			case "Nudi" :
				$pre ="n";
				$table = "nudi";
				break;
			default :
				echo "No group selected";
				break;
		}
		
		$queryarr[$pre.'alias'] = strtolower($_POST['binomialfirst']."-".$_POST['binomiallast']);
		
	// Convert the $_POST multidimensional array to an regular array of string values
	
		$excluded = array("lifegroup", "modified", "created", "createlife", "action");
		
		foreach ($_POST as $key => &$value) {
			if (!in_array($key, $_POST)) {
				if (is_string($value) && strlen($value) > 0) {
					$queryarr[$pre.$key] = $value;
				} elseif 	(is_array($value) && count($value) > 0) {
					$paramval = join(", " , $value);
					$queryarr[$pre.$key] = $paramval;
					unset($paramval);
				}
			}
		}
		
	// See if it exist in the DB already using the alias which is the binomial of the fish
		$sql = "SELECT ".$pre."alias FROM mlf_".$table." WHERE ".$pre."alias = :falias LIMIT 1";
		try {
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':falias', $queryarr['falias'], PDO::PARAM_STR);
			$stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			if ($result) {
				header("Location: ../admin/givelife.php?status=2");
				//echo "This already exist in the DB";
				exit;
			}
		} catch (PDOException $e) {
			echo 'Error checking DB with falias: ' . $e->getMessage();
			print_r($db->errorInfo());
			return FALSE;
		}
		
		// Doesnt Exist
		// If it doesnt exist in the DB insert the values of $queryarr in the appropriate table in the DB
		$queryarr['fcreated'] = (int)time();
		$queryarr['fmodified'] = (int)time();
		$queryarr['fusername'] = $_SESSION['username'];
		$cols = implode(",", array_keys($queryarr));
		$vals = preg_replace("/,/", ",:", $cols);
		$sql = "INSERT INTO mlf_fish (".$cols.") VALUES (:".$vals.")";
		//echo "MySQL query string = ".$sql."<br>";
		try {
			$stmt = $this->_db->prepare($sql);
			$stmt->execute(array_combine(explode(',',$cols), array_values($queryarr)));
			$stmt->closeCursor();
			echo "Went through with insert";
		} catch (PDOException $e) {
			echo 'Error INSERT to DB: ' . $e->getMessage();
			print_r($db->errorInfo());
			return FALSE;
		}
			
	}
	
}

?>