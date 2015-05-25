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
	
	public function growBranch($bn, $ba, $bc, $bf, $bt, $bs) {

		/*
		 * Check if the branch exist in the tree
		 */
		$sql = "SELECT COUNT(balias) AS theCount FROM mlf_tree WHERE balias=:balias";
		if ( $stmt = $this->_db->prepare($sql) ) {
			$stmt->bindParam(":balias", $ba, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
			$stmt->closeCursor();
			if ($row['theCount'] != 0) {
				echo '<h2>Error</h2><p>Oups! Sorry, that branch is already growing in the tree!</p><br />';
			} else {
		/*
		 * Select left of
		 */ 
		 		
				$sql = "SELECT rgt FROM mlf_tree WHERE bname = :bfrom";
				if ( $stmt = $this->_db->prepare($sql) ) {					
					$stmt->bindParam(":bfrom", $bf, PDO::PARAM_STR);
					$stmt->execute();
				    $row = $stmt->fetch();
					$atmyright = $row[0];
            		$stmt->closeCursor();
        		} 	
				
			/*
			 * Set right with leftof +2
			 */			
				
				$sql = "UPDATE mlf_tree SET rgt = rgt + 2 WHERE rgt > :atmyright";
				if ( $stmt = $this->_db->prepare($sql) ) {
					$stmt->bindParam(":atmyright", $atmyright, PDO::PARAM_STR);
				    $stmt->execute();
            		$stmt->closeCursor();
        		}
				
			/*
			 * Set left with leftof +2
			 */
				
				$sql = "UPDATE mlf_tree SET lft = lft + 2 WHERE lft > :atmyright";
				if ( $stmt = $this->_db->prepare($sql) ) {
					$stmt->bindParam(":atmyright", $atmyright, PDO::PARAM_STR);
				    $stmt->execute();
            		$stmt->closeCursor();
            		}
				
			/*
			 * Trying to insert in DB
			 */
								
				$sql = "INSERT INTO mlf_tree(bname, balias, lft, rgt, bcommonname, bfrom, btaxonomy, bsummary) VALUES(:bname, :balias, :atmyright + 1, :atmyright + 2, :bcommonname, :bfrom, :btaxonomy, :bsummary)";
				try {
					$stmt = $this->_db->prepare($sql);
		            $stmt->bindParam(":bname", $bn, PDO::PARAM_STR);
		            $stmt->bindParam(":balias", $ba, PDO::PARAM_STR);
					$stmt->bindParam(":atmyright", $atmyright, PDO::PARAM_STR);
		            $stmt->bindParam(":bcommonname", $bc, PDO::PARAM_STR);
					$stmt->bindParam(":bfrom", $bf, PDO::PARAM_STR);
					$stmt->bindParam(":btaxonomy", $bt, PDO::PARAM_STR);
					$stmt->bindParam(":bsummary", $bs, PDO::PARAM_STR);
				    $stmt->execute();
            		$stmt->closeCursor();
        		} catch(PDOException $e) {
        			echo '<br />There should be an error here';
					echo $e->getMessage();
        		}
			}
		}
	}

			/*
			 * 
			 * Function to show the whole tree
			 * 
			 */
		
	public function showBranchesList () {
			$parentbranch = 'animalia';
			$sql = "SELECT node.bname, node.balias, node.lft, node.bfrom FROM mlf_tree AS node, mlf_tree AS parent WHERE node.lft BETWEEN parent.lft AND parent.rgt AND parent.balias = :parent ORDER BY node.lft";
			if ( $stmt = $this->_db->prepare($sql) ) {
				$stmt->bindParam(":parent", $parentbranch, PDO::PARAM_STR);
				//$stmt->bindParam(":rgt", $row['rgt'], PDO::PARAM_STR);
				$stmt->execute();
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $results;
				$stmt->closeCursor();
			}
	}
	
	public function pruneBranch() {
		
	}		
	
	public function deleteBranch () {
		echo"";
	}
							
}					
    
    /*
	 * Function to cut a branch from the tree
	 */

?>