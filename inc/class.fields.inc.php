<?php

class MLFFields {
	
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
	 * Function fetchFields accepts the following params $fieldalias as a scope to the SQL query for this field will return a row
	 * "all" will return all the existing fields in the DB
	 * 
	 */
	
	public function fetchFields ($scope) {
		
		//Checking if an entry exist in the DB for a selected fieldalias and creating a string for SQL PDO accordingly
		$select =  "";
		$queryend = "";
		
		if ($scope === "all") {
			$select = "*";
			$queryend = "ORDER BY fieldalias";
		} else {
			$select = $scope;
			$queryend = "WHERE fieldalias = :fieldalias LIMIT 1";
		}
		$sql = "SELECT ".$select." FROM mlf_fields ".$queryend;

		try {
			$stmt = $this->_db->prepare($sql);
			if ($scope !== "all") {
				$stmt->bindParam(':fieldalias', $scope, PDO::PARAM_STR);
			}
			$stmt->execute();
			$fields = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();		
		} catch (PDOException $e) {
			echo 'Error inserting into DB: ' . $e->getMessage();
			print_r($db->errorInfo());
			return FALSE;
		}
		
		return $fields;
	}
	
	public function createField () {
		
		// Check if not empty and that the field does not exist in DB	
			
		if (!empty($_POST['fieldalias'])){
			
			$this->fetchFields($_POST['fieldalias']);
			if ($fieldsresults) {
				header("Location: ../admin/fieldcreator.php?status=2&field=".$_POST['fieldalias']);
				exit;
			}
			
			// Field does not exist so we can create a new entry in the DB
			
			// Converting the $_POST s into a SQL query string for PDO				
			$field = array();
			$excluded = array("action", "createfield");
			$field['created'] =	$field['modified'] = (int)time();
			$field['createdby'] = 	$field['modifiedby'] = trim($_SESSION['username']);

			foreach ($_POST as $key => &$value) {
				if (!in_array($key, $excluded) && !empty($value)) {
					$field[$key] =  $value;
				}
			}
			
			$cols = implode(",", array_keys($field));
			$vals = implode(",:", array_keys($field));
			$sql = "INSERT INTO mlf_fields (".$cols.") VALUES (:".$vals.")";
			
			//Running the array made from post throught PDO to create the entry in the DB
			
			try {
				$stmt = $this->_db->prepare($sql);
				$stmt->execute(array_combine(explode(',',$cols), array_values($field)));
				$stmt->closeCursor();	
			} catch (PDOException $e) {
				echo 'Error inserting into DB: ' . $e->getMessage();
				print_r($db->errorInfo());
				return FALSE;
			}
			
			header("Location: ../admin/fieldcreator.php?status=1&field=".$_POST['fieldalias']);
		}
	}

	/*
	 * getFIeld takes a field unique id fieldID and get the properties from the DB
	 * It returns an array of all the values of the row as key => value
	 */

	public function getField ($fieldID) {
		if(!empty($fieldID)) {
			
			$sql = "SELECT * FROM mlf_fields WHERE fieldID = :fieldID LIMIT 1";
			
			try {
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(':fieldID', $fieldID, PDO::PARAM_INT);
				$stmt->execute();
				$field = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
			} catch (PDOException $e) {
				echo 'Error inserting into DB: ' . $e->getMessage();
				print_r($db->errorInfo());
				return FALSE;
			}
			
			return $field;
			
		} else {
			echo "This field does not exist";
		}
	}
	
	public function updateField () {
		if (isset($_POST) && !empty($_POST)) {
				
			$field = array();
			$excluded = array("action", "updatefield");
			foreach ($_POST as $key => &$value) {
				if (!in_array($key, $excluded) && !empty($value)) {
					$field[$key] =  $value;
				}
			}
			
			// Get the difference between the posted values and the current DB values with getField function
			
			$currentfield = $this->getField($field['fieldID']);
			$diff = array_diff($field, $currentfield);
			if(empty($diff)) {
				echo "Same same and no different";
				header("Location: ../admin/fieldeditor.php?status=2&id=".$field['fieldID']);
				return;
			}
			
			$diff['modified'] = (int)time();
			$diff['modifiedby'] = trim($_SESSION['username']);
			
			$sets = "";
			foreach ($diff as $key => &$value) {
				$sets .= $key."=:".$key.", ";
				$changes[":".$key] = $value;
			}
			$changes[':fieldID'] = $field['fieldID'];
			$set = rtrim($sets, ", ");			
			$sql = "UPDATE mlf_fields SET ".$set." WHERE fieldID=:fieldID LIMIT 1";
			
			
			try {
				$stmt = $this->_db->prepare($sql);
				$stmt->execute($changes);
				$stmt->closeCursor();
			} catch (PDOException $e) {
				echo 'Error inserting into DB: ' . $e->getMessage();
				print_r($db->errorInfo());
				return FALSE;
			}
			
			echo "Same same but different";
			header("Location: ../admin/fieldeditor.php?status=1&id=".$field['fieldID']);
		}
	}
}

?>