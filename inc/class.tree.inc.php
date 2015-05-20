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
	
	public function growBranch($bn,	$ba,	$bc,	$bf, $bt, $bs) {
		
		/*
		 * Check if the branch exist in the tree
		 */
		$sql = "SELECT COUNT(balias) AS theCount FROM mlf_tree WHERE balias=:balias";
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":balias", $ba, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
			if ($row['theCount'] != 0) {
				echo '<h2>Error</h2><p>Oups! Sorry, that branch is already growing in the tree!</p>';
				$stmt->closeCursor();
			} else {
		/*
		 * Add branch to the tree
		 */
				$sql = "SELECT @myRight := rgt FROM mlf_tree WHERE branchfrom = :branchfrom; UPDATE mlf_tree SET rgt = rgt + 2 WHERE rgt > @myRight; UPDATE mlf_tree SET lft = lft + 2 WHERE lft > @myRight; INSERT INTO mlf_tree(branchname, branchalias, lft, rgt, branchcommonname, branchfrom, branchtaxonomy, branchsummary) VALUES(:branchname, :branchalias, @myRight + 1, @myRight + 2, :branchcommonname, :branchfrom, :branchtaxonomy, :branchsummary)";
				if ($stmt = $this->_db->prepare($sql) ) {
		            $stmt->bindParam(":branchname", $bn, PDO::PARAM_STR);
		            $stmt->bindParam(":branchalias", $ba, PDO::PARAM_STR);
		            $stmt->bindParam(":branchcommonname", $bc, PDO::PARAM_STR);
					$stmt->bindParam(":branchfrom", $bf, PDO::PARAM_STR);
					$stmt->bindParam(":branchtaxonomy", $bt, PDO::PARAM_STR);
					$stmt->bindParam(":branchsummary", $bt, PDO::PARAM_STR);
					$stmt->execute();
					$stmt->closeCursor();
					echo '<h2>Success!</h2><p>The data has been entered in DB</p>';
					return;
				} 
			}
		}
	}
		
	public function showTree () {
			
			$sql = "SELECT CONCAT( REPEAT( ' ', (COUNT(parent.name) - 1) ), node.name) AS name FROM nested_category AS node, nested_category AS parent WHERE node.lft BETWEEN parent.lft AND parent.rgt GROUP BY node.name ORDER BY node.lft;";
			if($stmt = $this->_db->prepare($sql) ) {
				$stmt->bindParam(":branchalias", $ba, PDO::PARAM_STR);
				$stmt->closeCursor();
			}
		}
							
}					
					
				
			
		
			
			
		
		/*
		 * Enter fields values in the DB if not empty or already exist
		 */
		
		/*
		 * First check if branch will have siblings or not (they are different ways to enter values according to this)
		 */
		/* $sql ="SELECT parent.:branchalias, COUNT(product.branchalias) FROM mlf_tree AS nodeCount , mlf_tree AS parent, product WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.branchuid = product.branchuid GROUP BY parent.name ORDER BY node.lft";
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":branchalias", $bs, PDO::PARAM_STR);
            $stmt->execute();
			$row = $stmt->fetch();
			print_r($row);
		// No children 
			if ($row['nodeCount'] == 1) {
				echo '<h2>Parent node has no children</h2>';
				$sql = "LOCK TABLE mlf_tree WRITE; SELECT @myRight := rgt FROM mlf_tree WHERE branchalias = :branchalias; UPDATE mlf_tree SET rgt = rgt + 2 WHERE rgt > @myRight; UPDATE mlf_tree SET lft = lft + 2 WHERE lft > @myRight; INSERT INTO mlf_tree(branchalias, lft, rgt) VALUES('GAME CONSOLES', @myRight + 1, @myRight + 2); UNLOCK TABLES;";
		// Has children
			} elseif ($row['nodeCount'] > 1) {
				echo '<h2>Parent node has '.$row['nodeCount'].' -1 childrens</h2>';
			} 
            $stmt->closeCursor();
		}

        $sql = "INSERT INTO marine_tree(branchname, branchalias, branchcommonname, branchsummary ) VALUES(:branchname, :branchalias, :branchcommonname, :branchsummary)";
        if ( $stmt = $this->_db->prepare($sql) ) {
            $stmt->bindParam(":branchname", $bn, PDO::PARAM_STR);
            $stmt->bindParam(":branchalias", $ba, PDO::PARAM_STR);
			$stmt->bindParam(":branchcommonname", $bc, PDO::PARAM_STR);
			$stmt->bindParam(":branchfrom", $bf, PDO::PARAM_STR);
			$stmt->bindParam(":branchsummary", $bs, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
			
			

        } else {
            return "<h2> Error </h2><p> Couldn't insert the " . "user information into the database. </p>";
        }
    } */
    
    /*
	 * Function to cut a branch from the tree
	 */

?>