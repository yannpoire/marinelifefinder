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
	
	public function addBranch() {
        $bn = trim($_POST['branchname']);
		$ba = preg_replace($pattern, ' ', trim($_POST['branchalias']) );
		$bc = trim($_POST['branchcommonname']);
		$kb = trim($_POST['knownbranch']);
		$sb = trim($_POST['selectbranch']);
		$bf;
		$bs = trim($_POST['branchsummary']);
		
		/*
		 * Check required fields for empty values 
		 */
		if (empty($ba)) {
			return '<h2>Error</h2><p>Houston! We have a big problem, there were no alias set for the branch</p>';
		} elseif (empty($bn)) {
			return '<h2>Error</h2><p>Oups! Sorry, a branch must have a name';
		} elseif (empty($kb) && empty($sb) || $kb !== $sb) {
	/// Will require client side disabling of one or another field
			return '<h2>Error</h2><p>Oups! Sorry, no mother branch to grow on or two different mother branch has been selected</p>';
		} else {
			if (!empty($kb)) {
				$bf = $kb;
			} else {
				$bf = $sb;
			}
		}
		
		/*
		 * Check if the branch exist in the tree
		 */
		$sql = "SELECT COUNT(branchalias) AS theCount FROM marine_tree WHERE branchalias=:branchalias";
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":branchalias", $ba, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
			if ($row['theCount'] != 0) {
				return '<h2>Error</h2><p>Oups! Sorry, that branch is already growing in the tree!</p>';
			}
			$stmt->closeCursor();
		}
		
		/*
		 * Enter fields values in the DB if not empty or already exist
		 */
		
		/*
		 * First check if branch will have siblings or not (they are different ways to enter values according to this)
		 */
		$sql ="SELECT parent.:branchalias, COUNT(product.branchalias) FROM mlf_tree AS nodeCount , mlf_tree AS parent, product WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.branchuid = product.branchuid GROUP BY parent.name ORDER BY node.lft";
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":branchalias", $bs, PDO::PARAM_STR);
            $stmt->execute();
			$row = $stmt->fetch();
			print_r($row);
		// No children
			if ($row['nodeCount'] == 1) {
				echo '<h2>Parent node has no children</h2>';
				$sql = "LOCK TABLE nested_category WRITE; SELECT @myRight := rgt FROM nested_category WHERE name = :branchalias; UPDATE nested_category SET rgt = rgt + 2 WHERE rgt > @myRight; UPDATE nested_category SET lft = lft + 2 WHERE lft > @myRight; INSERT INTO nested_category(name, lft, rgt) VALUES('GAME CONSOLES', @myRight + 1, @myRight + 2); UNLOCK TABLES;";
		// Has children
			} elseif ($row['nodeCount'] > 1) {
				echo '<h2>Parent node has '.$row['nodeCount'].' -1 childrens</h2>';
			}
            $stmt->closeCursor();
		}

        $sql = "INSERT INTO marine_tree(branchname, branchalias, branchcommonname, branchfrom, branchsummary ) VALUES(:branchname, :branchalias, :branchcommonname, :branchfrom, :branchsummary)";
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
    }
	
}



?>