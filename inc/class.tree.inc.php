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
	
	public function createBranch () {
		
		$qvalues = array();
		$excludes = array("action", "createbranch");
		
		$qvalues['alias'] = preg_replace('/ /', '-', strtolower(trim($_POST['name'])));
		
		// Check if it exist in the tree
		$sql = "SELECT alias FROM mlf_tree WHERE alias = :alias LIMIT 1";
		if ($stmt = $this->_db->prepare($sql)) {
			//$stmt->bindParam(":alias", $qvalues['alias'], PDO::PARAM_STR);
            $stmt->execute($qvalues);
            $result = $stmt->fetch();
			$stmt->closeCursor();
			if ($result) {
				//header("Location : ");
				echo "Already exist";
				die();
			}
		}
		
		// If it doesnt exist create a new entry
		
		/*$sql = "SELECT rgt FROM mlf_tree WHERE alias = :subof";
		if ( $stmt = $this->_db->prepare($sql) ) {					
			$stmt->bindParam(":subof", $qvalues['subof'], PDO::PARAM_STR);
			$stmt->execute();
		    $row = $stmt->fetch();
			$atmyright = (int)$row[0];
    		$stmt->closeCursor();
		}
		
		$sql = "UPDATE mlf_tree SET rgt = rgt + 2 WHERE rgt > :atmyright";
		try {
			echo "Adding right";
			$stmt = $this->_db->prepare($sql);
			$stmt->bindValue(":atmyright", $atmyright, PDO::PARAM_INT);
		    $stmt->execute();
    		$stmt->closeCursor();
		} catch(PDOException $e) {
			echo $e->getMessage();
        }
		
		$sql = "UPDATE mlf_tree SET lft = lft + 2 WHERE lft > :atmyright";
		try {
			echo "Adding left";
			$stmt = $this->_db->prepare($sql);
			$stmt->bindValue(":atmyright", $atmyright, PDO::PARAM_INT);
		    $stmt->execute();
    		$stmt->closeCursor();
    	} catch(PDOException $e) {
			echo $e->getMessage();
		}
		*/
		
		$sql = "SELECT lft FROM mlf_tree WHERE alias = :subof";
		if ( $stmt = $this->_db->prepare($sql) ) {					
			$stmt->bindParam(":subof", $qvalues['subof'], PDO::PARAM_STR);
			$stmt->execute();
		    $row = $stmt->fetch();
			$atmyleft = (int)$row[0];
    		$stmt->closeCursor();
		} 	
			
	/*
	 * Set right with leftof +2
	 */			
		
		$sql = "UPDATE mlf_tree SET rgt = rgt + 2 WHERE rgt > :atmyleft";
		try {
			$stmt = $this->_db->prepare($sql);
			$stmt->bindValue(":atmyleft", $atmyleft, PDO::PARAM_INT);
		    $stmt->execute();
    		$stmt->closeCursor();
		} catch(PDOException $e) {
			echo $e->getMessage();
        }
		
	/*
	 * Set left with leftof +2
	 */
		
		$sql = "UPDATE mlf_tree SET lft = lft + 2 WHERE lft > :atmyleft";
		try {
			$stmt = $this->_db->prepare($sql);
			$stmt->bindValue(":atmyleft", $atmyleft, PDO::PARAM_INT);
		    $stmt->execute();
    		$stmt->closeCursor();
    	} catch(PDOException $e) {
			echo $e->getMessage();
		}
		
		
			
		/*
		 * Trying to insert in DB
		 */
		 
		 foreach ($_POST as $key => $value) {
		 	if(!in_array($key, $excludes)) {
		 		$qvalues[$key] = trim($value);
		 	}
		 }

		 //$qvalues[':atmyright'] = $atmyright;
		 $qvalues[':atmyleft'] = $atmyleft;
		 
		 var_dump($qvalues);
								
		$sql = "INSERT INTO mlf_tree(name, alias, lft, rgt, cname, subof, taxonomy, summary) VALUES(:name, :alias, :atmyleft + 1, :atmyleft + 2, :cname, :subof, :taxonomy, :summary)";
		try {
			$stmt = $this->_db->prepare($sql);
		    $stmt->execute($qvalues);
    		$stmt->closeCursor();
    		
    		echo "Finished";
			
			//header("Location: ../admin/brancheditor.php?status=1");
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		
	}
	
	/*
	 * 
	 * Function to show the whole tree
	 * 
	 */
	public function showBranch ($rootbranch) {
			
		// Get the lft and right value of the root, the branch to start from
		$sql = "SELECT lft, rgt FROM mlf_tree WHERE alias = :rootbranch LIMIT 1";
		
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":rootbranch", $rootbranch, PDO::PARAM_STR);
			$stmt->execute();
			$rootrow = $stmt->fetch();
			$stmt->closeCursor();	
		}
		
		$right = array();
		
		$sql = "SELECT branchID, name, alias, lft, rgt FROM mlf_tree WHERE lft BETWEEN :rootlft AND :rootrgt ORDER BY lft ASC";
		
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":rootlft", $rootrow[0], PDO::PARAM_INT);
			$stmt->bindParam(":rootrgt", $rootrow[1], PDO::PARAM_INT);
			$stmt->execute();
		
			while ( $result = $stmt->fetch(PDO::FETCH_ASSOC) ) {

        	// Only check stack if there is one  

				if (count($right)>0) {  

           		 // Check if we should remove a node from the stack  

					while ($right[count($right)-1]<$result['rgt']) {  

						array_pop($right);  

					}  
				}  

				// Display indented node title  

				echo str_repeat("&nbsp;&nbsp;",count($right))."<a href=\"../admin/brancheditor.php?edit=TRUE&id=".$result['branchID']."\">".$result['name']."</a><br>";  

				// Add this node to the stack  

				$right[] = $result['rgt']; 
				
			}

			$stmt->closeCursor();
    	} 	
	}
	
	public function getBranch($id) {
		
		$sql = "SELECT name, alias, lft, rgt, subof, cname, taxonomy, summary FROM mlf_tree WHERE branchID = :id LIMIT 1";
		
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->execute();
			$branch = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
		}
		return $branch;
	}
	
	public function formselectBranch ($root, $selected) {
		
		// Get the lft and right value of the root, the branch to start from
		$sql = "SELECT lft, rgt FROM mlf_tree WHERE alias = :rootbranch LIMIT 1";
		
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":rootbranch", $root, PDO::PARAM_STR);
			$stmt->execute();
			$rootrow = $stmt->fetch();
			$stmt->closeCursor();	
		}
		
		$right = array();
		
		$sql = "SELECT name, alias, lft, rgt, subof FROM mlf_tree WHERE lft BETWEEN :rootlft AND :rootrgt ORDER BY lft ASC";
		
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":rootlft", $rootrow[0], PDO::PARAM_INT);
			$stmt->bindParam(":rootrgt", $rootrow[1], PDO::PARAM_INT);
			$stmt->execute();
		
			while ( $result = $stmt->fetch(PDO::FETCH_ASSOC) ) {

        	// only check stack if there is one  

				if (count($right)>0) {  

           		 // check if we should remove a node from the stack  

					while ($right[count($right)-1]<$result['rgt']) {  

						array_pop($right);  

					}  
				}  

				// display indented node title  
				
				if ($result['alias'] == $selected) {
						
					echo str_repeat("&nbsp;",count($right))."<option value=\"".$result['alias']."\" selected>".$result['name']."</option>";
						
				} else {	

					echo str_repeat("&nbsp;",count($right))."<option value=\"".$result['alias']."\">".$result['name']."</option>";
					
				}
				
				// add this node to the stack  

				$right[] = $result['rgt']; 
				
			}

			$stmt->closeCursor();
    	} 	
	}

	public function updateBranch () {
		if (isset($_POST) && !empty($_POST)) {
			
			var_dump($_POST);
				
			$branch = array();
			
			//Exclude values not saved in or to the DB that comes from submit and hidden fields
			$excluded = array("action", "updatebranch");
			foreach ($_POST as $key => &$value) {
				if (!in_array($key, $excluded) && !empty($value)) {
					$branch[$key] =  $value;
				}
			}
			
			// Get the difference between the posted values and the current DB values with getField function
			$currentbranch = $this->getBranch($branch['branchID']);
			$diff = array_diff($branch, $currentbranch);
			if(empty($diff)) {
				echo "Same same and no different";
				header("Location: ../admin/brancheditor.php?status=2&id=".$branch['branchID']);
				return;
			}
			
			if (!empty($diff) && in_array("subof", $diff)) {
			
				$sql = "SELECT lft FROM mlf_tree WHERE alias = :subof";
				if ( $stmt = $this->_db->prepare($sql) ) {					
					$stmt->bindParam(":subof", $branch['subof'], PDO::PARAM_STR);
					$stmt->execute();
				    $row = $stmt->fetch();
					$atmyleft = (int)$row[0];
		    		$stmt->closeCursor();
				} 	
				
				/*
				 * Set right with leftof +2
				 */			
				
				$sql = "UPDATE mlf_tree SET rgt = rgt + 2 WHERE rgt > :atmyleft";
				try {
					$stmt = $this->_db->prepare($sql);
					$stmt->bindValue(":atmyleft", $atmyleft, PDO::PARAM_INT);
				    $stmt->execute();
		    		$stmt->closeCursor();
				} catch(PDOException $e) {
					echo $e->getMessage();
		        }
				
				/*
				 * Set left with leftof +2
				 */
				
				$sql = "UPDATE mlf_tree SET lft = lft + 2 WHERE lft > :atmyleft";
				try {
					$stmt = $this->_db->prepare($sql);
					$stmt->bindValue(":atmyleft", $atmyleft, PDO::PARAM_INT);
				    $stmt->execute();
		    		$stmt->closeCursor();
		    	} catch(PDOException $e) {
					echo $e->getMessage();
				}
				
				$diff['lft'] = $atmyleft;
				
				var_dump($diff);
				
			}
			
			//Add time and username to the array			
			$diff['modified'] = (int)time();
			$diff['modifiedby'] = trim($_SESSION['username']);
			
			//Create set for the SQL query
			$sets = "";
			foreach ($diff as $key => &$value) {
				$sets .= $key."=:".$key.", ";
				$changes[":".$key] = $value;
			}
			$changes[':branchID'] = $branch['branchID'];
			$set = rtrim($sets, ", ");			
			$sql = "UPDATE mlf_tree SET ".$set." WHERE branchID=:branchID LIMIT 1";
			
			var_dump($sql);
			
			//Run the SQL query to write the changes to the DB mlf_tree
			try {
				$stmt = $this->_db->prepare($sql);
				//$stmt->execute($changes);
				$stmt->closeCursor();
			} catch (PDOException $e) {
				echo 'Error inserting into DB: ' . $e->getMessage();
				print_r($db->errorInfo());
				return FALSE;
			}
			
			echo "Same same but different";
			header("Location: ../admin/brancheditor.php?status=1&id=".$branch['branchID']);
		
		}
	}						
}

?>