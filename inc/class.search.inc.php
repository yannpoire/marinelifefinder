<?php


class MLFSearch {
	
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
	
	

	
	public function searchLife () {
		
		if (isset($_POST) && !empty($_POST)) {
			$searchexact = $searchmatch = "";
			$excluded = array("action", "quicksearch");
			$cols = "fcname, fothercnames, fbinomialfirst, fbinomiallast, fsummary";

			foreach ($_POST as $key => &$value) {
				if(is_array($value)) {
					$value = implode(", ", $value);
				}
				if (!in_array($key, $excluded) && !empty($value)) {
					$searchexact .= $key." = '".$value."', ";
					$searchmatch .= $key." LIKE '%".preg_replace("/, /", "%' OR '%", $value)."%' AND ";
					$cols .= ", ".$key;
				}
			}
		}
		
		$searchexact = rtrim($searchexact, ", ");
		$sql = "SELECT ".$cols." FROM mlf_fish WHERE ".$searchexact." LIMIT 10";
		echo $sql;
		try {
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			$exactmatch = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			
		} catch (PDOException $e) {
			echo 'Error inserting into DB: ' . $e->getMessage();
			print_r($db->errorInfo());
			return FALSE;
		}
		
		$searchmatch = rtrim($searchmatch, " AND ");
		
		$sql = "SELECT ".$cols." FROM mlf_fish WHERE ".$searchmatch." LIMIT 50";
		echo $sql;
		
		try {
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			$partialmatch = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			
		} catch (PDOException $e) {
			echo 'Error inserting into DB: ' . $e->getMessage();
			print_r($db->errorInfo());
			return FALSE;
		}
		
		foreach ($partialmatch as $key => &$value) {
			if (in_array($value, $exactmatch)) {
				unset($partialmatch[$key]);
				echo "Removed from array";
			}
		}

		$results['exact'] = $exactmatch;
		$results['partial'] = $partialmatch;
		
		return $results;
		
	}

	/*
	 * 
	 * Will display results for exact and partial and display them in results page template columns
	 * @param $results
	 * 
	 */
	
	public function displayResults ($results) {
		
		
		
		
		if (isset($results['exact']) && !empty($results['exact'])) {
			echo "<div class=\"row\"><div class=\"col-md-12\"><h2>Exact matches</h2>";
			$exactmatch = $results['exact'];
			foreach ($exactmatch as $key => $value) {
				echo "<div class=\"col-md-4\"><a href=\"../viewlife.php?group=fish&fid=".$value['fid']."\">",
				"<h3>".$value['fcname']."</h3>",
				"<img src=\"\">",
				"<span class=\"binomial\">".$value['fbinomialfirst'].$value['fbinomiallast']."</span>",
				"<p>".$value['fsummary']."</p>",
				"<span>Show more</span>";		
			}
			echo "</a></div></div></div>";
		}
		
		if (isset($results['partial']) && !empty($results['partial'])) {
			echo "<div class=\"row\"><div class=\"col-md-12\"><h2>Partial matches</h2>";
			$partialmatch = $results['partial'];
			echo "";
			foreach ($partialmatch as $key => $value) {
				echo "<div class=\"col-md-4\">",
				"<h3>".$value['fcname']."</h3>",
				"<span class=\"binomial\">".$value['fbinomialfirst'].$value['fbinomiallast']."</span>";	
			}
			echo "</div></div></div>";
		}
		
	}
	
}
?>
