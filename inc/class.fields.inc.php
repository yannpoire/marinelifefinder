
/*
 List of function of CLASS MLFFields
 
 fetchFields() fetch field according to the scope of the args in mlf_fields
 accepts 1 arg as $scope possible values all, fish,
 returns an array of arrays of fields with all colums values from DB
 
 createField() create field with POST in mlf_field DB for the field creator form
 no args
 
 getField()
 accepts 1 arg as $fieldID which is the unique ID of a field
 return array of fields $fields by ID
 
 updateField()
 use getField to get values from mlf_fields and update them if needed in DB on POST
 
 assembleField() create the HTML output of field to insert in the form
 accepts 2 args as $field which is an array of key values for one field and $edit which is to fetch values from DB or create an empty field with 	defaults values
 return a string which contain the html for the whole form field
 
 
 
 
 
 
 
 */
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
		
		if ($scope === "all") {
			$sql = "SELECT * FROM mlf_fields ORDER BY fieldalias";
		} else {
			$sql = "SELECT ".$scope." FROM mlf_fields WHERE fieldalias = :fieldalias LIMIT 1";
		}

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
			
			//Exclude values not saved in or to the DB that comes from submit and hidden fields
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
			
			//Add time and username to the array			
			$diff['modified'] = (int)time();
			$diff['modifiedby'] = trim($_SESSION['username']);
			
			//Create set for the SQL query
			$sets = "";
			foreach ($diff as $key => &$value) {
				$sets .= $key."=:".$key.", ";
				$changes[":".$key] = $value;
			}
			$changes[':fieldID'] = $field['fieldID'];
			$set = rtrim($sets, ", ");			
			$sql = "UPDATE mlf_fields SET ".$set." WHERE fieldID=:fieldID LIMIT 1";
			
			//Run the SQL query to write the changes to the DB mlf_fields
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

	/*
	 * Receives $fielddata as an array of a row from the DB and create a HTML field with the data recovered
	 * 
	 * ADD $VALUES FOR EDITING AN EXISTING FIELD
	 */
	public function assembleForm ($fields, $edit) {
		if (isset($fields) && !empty($fields)) {
			$formfields = "";
			
			//Divide fields into fieldsets for display according to fieldset column
			$fieldsets = array();
			foreach ($fields as $field => $fieldvalues) {
				if(!in_array($field['fieldset'], $fieldsets)) {
					$fieldsets[$field['fieldset']] = $fieldvalues;
				}
			}
			
			//Create HTML for fieldsets with legend including all their fields
			
			foreach ($fieldsets as $fieldset) {
				
				$formfield .= "<fieldset><Legend"
			}
		}
		
		
		if ($edit === TRUE) {
			foreach ($fields as $field) {
				$completefield = $this->assembleField($field, TRUE);
			}
		} else {
			foreach ($fields as $field) {
				$completefield = $this->assembleField($$field, FALSE);
			}
		}
		
	}

	public function assembleField ($fielddata, $edit) {
		if (is_array($fielddata) && !empty($fielddata)) {
			$field = "<div class=\"field-group ".$fielddata['fieldgroupclass']."\">\n<label for=\"".$fielddata['fieldalias']."\">".$fielddata['fieldname']."</label>\n";
			switch ($fielddata['fieldtype']) {
				case "text" :
					$field .= "<input class=\"".$fielddata['fieldclass']."\" name=\"".$fielddata['alias']." type=\"text\" ";
					if($edit == TRUE) {
						$field .= "value=\"".$fielddata['fieldvalue']."\">";
					} else {
						$field .="value=\"".$fielddata['fielddefaultvalue']."\">";
					}
					break;
				case "checkbox" :
					$field .= "<input class=\"".$fielddata['fieldclass']."\" name=\"".$fielddata['alias']." type=\"text\" ";
					if($edit == TRUE) {
						$field .= "value=\"".$fielddata['fieldvalue']."\">\n";
					} else {
						$field .="value=\"".$fielddata['fielddefaultvalue']."\">\n";
					}
				case "radio" :
					$field .= $field .= "<input class=\"".$fielddata['fieldclass']."\" name=\"".$fielddata['alias']." type=\"radio\" ";
					if($edit == TRUE) {
						$field .= "value=\"".$fielddata['fieldvalue']."\">\n";
					} else {
						$field .="value=\"".$fielddata['fielddefaultvalue']."\">\n";
					}
				case "textarea" :
					$field .= "<textarea class=\"".$fielddata['fieldclass']."\" name=\"".$fielddata['fieldalias'].">";
					if($edit == TRUE) {
						$field .= $fielddata['fieldvalue']."</textarea>\n";
					} else {
						$field .= $fielddata['fielddefaultvalue']."</textarea>\n";
					}
					break;
				case "textareatinymce" :
					$field .= "<textarea class=\"tinymcearea ".$fielddata['fieldclass']."\" name=\"".$fielddata['fieldalias'].">";
					if($edit == TRUE) {
						$field .= $fielddata['fieldvalue']."</textarea>\n";
					} else {
						$field .= $fielddata['fielddefaultvalue']."</textarea>\n";
					}
					break;
				case "select" :
					$field .="<select class=\"form-control\" name=\"".$fielddata['fieldalias'].">";
					$options = explode(",", trim($fielddata['fielddefaultvalue']));
					$fieldvalues = explode(",", trim($values));
					foreach ($options as $option) {
						if (in_array($option, $fieldvalues)) {
							$field .= "<option value=\"".strtolower($option)."\" selected=\"selected\">".$option."</option>";
						} else {
							$field .= "<option value=\"".strtolower($option)."\">".$option."</option>";
						}
					}
					break;
				case "multiselect" :
					$field .="<select class=\"form-control\" name=\"".$fielddata['fieldalias']." multiple=\"multiple\">";
					$options = explode(",", trim($fielddata['fielddefaultvalue']));
					$fieldvalues = explode(",", trim($values));
					foreach ($options as $option) {
						if (in_array($option, $fieldvalues)) {
							$field .= "<option value=\"".strtolower($option)."\" selected=\"selected\">".$option."</option>";
						} else {
							$field .= "<option value=\"".strtolower($option)."\">".$option."</option>";
						}
					}
					break;
			}
			$field .= "</div>";
			return $field;
		}
	}
}

?>