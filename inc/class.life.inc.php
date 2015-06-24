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

	
	/*
	 * 
	 * fetchLife query the DB to get the values back for a specific life form or all in a group
	 * @ param string $group group of life
	 * @ param string $id the unique id of a life form or empty for all in group
	 * @ return array $results array of row array
	 * 
	 */
	
	public function fetchLife($group, $id) {
		
		if (isset($group) && !empty($group)) {
			
			// Set default field names which are common to all in array
			$defaults = array("status");
			$cols = array("id", "alias", "cname", "othercnames", "familycname", "binomialfirst", "binomiallast", "classification", "summary", "content");
			
			// Define sql query from groups and ids or all from group if id is empty
			switch ($group) {
				
				case 'Fish' :
					// If id is present make a query for one row for the requested id
					if (!empty($id)) {
						foreach ($cols as $key => $value) {
							$cols[$key] = "f".$value;
						}
						$select = implode(", ", $defaults).", ".implode(", ", $cols);
						$sql = "SELECT ".$select." FROM mlf_fish WHERE fid = ".$id." LIMIT 1";
					
					// If no id is present then request all rows from db for a given group	
					} else {
						$sql = "SELECT * from mlf_fish GROUP BY fbinomialfirst ORDER BY fbinomiallast";
					}
					break;
					
				case 'Nudibranch' :
					$sql = "SELECT * FROM mlf_nudi GROUP BY nbinomialfirst ORDER BY fbinomiallast";
					break;
					
				default:
					echo "Something went wrong";
					break;
			}
			
			// Run the assembled sql query to fetch results
			try {
				$stmt = $this->_db->prepare($sql);
				$stmt->execute();
            	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();

			} catch (PDOException $e) {
				echo 'Error inserting into DB: ' . $e->getMessage();
				print_r($db->errorInfo());
				return FALSE;
			}
			
			return $results;
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