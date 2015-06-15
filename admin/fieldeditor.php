<?php
	include_once "../common/base.php";
	$pageTitle = "View and manage Fields in the database";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.fields.inc.php";
	include_once ROOT_PATH."common/header.php";
	$fieldObj = new MLFFields($db);
?>
</head>
<body>
<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
	if(isset($_GET['status'])) {
		$status = $_GET['status'];
		switch ($status) {
			case 1:
				echo "<div class=\"alert alert-success alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Success!</strong> You can view <a class=\"alert-link\" href=\"fieldmanager.php\">all the fields</a> or use the form to make more changes</div>";
				break;
			case 2:
				echo "<div class=\"alert alert-warning alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Warning!</strong>No changes has been made because no fields were modified. If you do not want to make changes you can go back to the list of <a class=\"alert-link\" href=\"fieldmanager.php\">all the fields</a></div>";
				break;
			default:
				echo "<div class=\"alert alert-danger alert-dismissible\"><strong>Failed!</strong> something went wrong... Very wrong... Very very wrong...</div>";
				break;
		}
	}
	if (isset($_GET['id'])) {
		$fieldID = (int)trim($_GET['id']);
		$field = $fieldObj->getField($fieldID);
	} else {
		header("Location: fieldmanager.php");
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Edit a field</h1>
			<p>Edit the properties of an existing field</p>
		</div>
	</div>
	<div class="row">
        <div class="col-md-12 form-style">
        	
        	<?php 
    			
			?>
			
        	<form method="post" action="../db-interaction/fields.php" role="form">
			<input name="action" type="hidden" value="updatefield">
			<input name="fieldID" type="hidden" value="<?php echo $fieldID; ?>">
        	
        	<fieldset>
        	<legend>Fields details</legend>
        		
        		<div class="col-md-6">        		
	        		<label for="fieldname">Enter a name for the field</label>
	        		<span>Current value: <?php echo $field['fieldname']; ?></span>
	        		<input name="fieldname" type="text" required="required" value="<?php echo $field['fieldname']; ?>">
        		</div>
        		
        		<div class="col-md-6">
	        		<label for="fieldalias">Enter an alias for the field</label>
	        		<span>Current value: <?php echo $field['fieldalias']; ?></span>
	        		<input name="fieldalias" type="text" required="required" value="<?php echo $field['fieldalias']; ?>">
        		</div>
        		
        		<div class="col-md-12">
        			<label for="fielddescription">Enter a short description for field. Used for glossary, tooltips</label>
        			<span>Current value: <?php echo $field['fielddescription']; ?></span>
        			<textarea name="fielddescription"><?php echo $field['fielddescription']; ?></textarea>
        		</div>
        		
        		<div class="col-md-6">	
	        		<label for"fieldgroup">Which group does it belongs to</label>
	        		<span>Current value: <?php echo $field['fieldgroup']; ?></span>
	        		<select name="fieldgroup">
	        			<option value="general" <?php if($field['fieldgroup'] == "general"){ echo "selected";} ?>>General - general</option>
	        			<option value="fish" <?php if($field['fieldgroup'] == "fish"){ echo "selected";} ?>>Fishes - fish</option>
	        			<option value="nudi" <?php if($field['fieldgroup'] == "nudi"){ echo "selected";} ?>>Nudies - nudi</option>
	        		</select>
	        	</div>
	        	
	        	<div class="col-md-6">	
	        		<label for"fieldset">What fieldset it appears under</label>
	        		<span>Current value: <?php echo $field['fieldset']; ?></span>
	        		<input name="fieldset" type="text" required="required" value="<?php echo $field['fieldset']; ?>">
	        	</div>
        		
        		<div class="col-md-6">
	        		<label for="fieldtype">Type of field Input text, select, multiselect, etc</label>
	        		<span>Current value: <?php echo $field['fieldtype']; ?></span>
	        		<select name="fieldtype" required="required">
	        			<option value="text" <?php if($field['fieldtype'] == "text"){ echo "selected";} ?>>Text - text</option>
	        			<option value="textarea" <?php if($field['fieldtype'] == "textarea"){ echo "selected";} ?>>Textarea - textarea</option>
	        			<option value="textareatinymce"<?php if($field['fieldtype'] == "textareatinymce"){ echo "selected";} ?>>Text area with TinyMCE - textareatinymce</option>
	        			<option value="select" <?php if($field['fieldtype'] == "select"){ echo "selected";} ?>>Select - select</option>
	        			<option value="multiselect" <?php if($field['fieldtype'] == "multiselect"){ echo "selected";} ?>>Multiselect - multiselect</option>
	        			<option value="checkbox" <?php if($field['fieldtype'] == "checkbox"){ echo "selected";} ?>>Checkbox - checkbox</option>
	        			<option value="radio" <?php if($field['fieldtype'] == "radio"){ echo "selected";} ?>>Radio - radio</option>
	        		</select>
	        	</div>
	        	
        		<div class="col-md-6">
	        		<label for="fieldvaluetype">The type of value in the field for parsing</label>
	        		<span>Current value: <?php echo $field['fieldvaluetype']; ?></span>
	        		<select name="fieldvaluetype">
	        			<option value="uniquestring" <?php if($field['fieldvaluetype'] == "uniquestring"){ echo "selected";} ?>>String with unique value - uniquestring</option>
	        			<option value="multistring" <?php if($field['fieldvaluetype'] == "multistring"){ echo "selected";} ?>>String with multiple values (array, no key => value, only values) - multistring</option>
	        			<option value="arraystring" <?php if($field['fieldvaluetype'] == "arraystring"){ echo "selected";} ?>>Strings as (array with key => value) - arraystring</option>
	        			<option value="imagepaths" <?php if($field['fieldvaluetype'] == "imagepaths"){ echo "selected";} ?>>Paths to images in a multiple value string - imagepaths</option>
	        			<option value="integer" <?php if($field['fieldvaluetype'] == "integer"){ echo "selected";} ?>>Integer (Numbers) - integer</option>
	        			<option value="boolean" <?php if($field['fieldvaluetype'] == "boolean"){ echo "selected";} ?>>Boolean as 0 or 1 for false or true - boolean</option>
	        		</select>
	        	</div>
        		
        		<div class="col-md-12">
	        		<label for="fielddefaultvalue">Default value if applicable (can be left empty)</label>
	        		<span>Current value: <?php echo $field['fielddefaultvalue']; ?></span>
	        		<input name="fielddefaultvalue" type="text" value="<?php echo $field['fielddefaultvalue']; ?>">
        		</div>
        		
        		<div class="col-md-12">
        			<input class="button" name="updatefield" type="submit" value="Update this field">
        		</div>
        		
        	</fieldset>
        	
        </form>
        </div>
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
