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
	$edit = FALSE;
	if (isset($_GET['id'])) {
		$fieldIDs = trim($_GET['id']);
		$field = $fieldObj->getFields($fieldIDs);
		$field = $field[0];
		$edit = TRUE;
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
				<?php 
					if($edit){
						echo "<h1>Edit the field ".$field['fieldname']."</h1><p>Edit the properties of the field :".$field['fieldname']." and update the values in the database.</p>";
					} else {
						echo "<h1>Create a new field</h1><p>Insert the properties of the new field to be saved in the DB</p>";
					}
				?>
		</div>
	</div>
	<div class="row">
        <div class="col-md-12">

        	<form method="post" action="../db-interaction/fields.php" role="form">
			<input name="action" type="hidden" value="<?php if($edit) {echo "updatefield"; }else{echo "createfield"; } ?>">
			<?php if(isset($fieldIDs)) {echo "<input name=\"fieldID\" type=\"hidden\" value=\"".$fieldIDs."\">";} ?>
        	
        	<fieldset>
        	<legend>Fields details</legend>
        		
        		<div class="form-group">        		
	        		<label for="fieldname">Enter a name for the field</label>
	        		<?php if($edit) {echo "<span>Current value:".$field['fieldname']."</span>";} ?>
	        		<input class="form-control" name="fieldname" type="text" required="required" value="<?php if($edit) {echo $field['fieldname'];} ?>">
        		</div>
        		
        		<div class="form-group">
	        		<label for="fieldalias">Enter an alias for the field</label>
	        		<?php if($edit) {echo "<span>Current value: ".$field['fieldalias']."</span>";} ?>
	        		<input class="form-control" name="fieldalias" type="text" required="required" value="<?php if($edit) {echo $field['fieldalias'];} ?>">
        		</div>
        		
        		<div class="form-group">
        			<label for="fielddescription">Enter a short description for field. Used for glossary, tooltips</label>
        			<?php if($edit) {echo "<span>Current value: ".$field['fielddescription']."</span>";} ?>
        			<textarea class="form-control" name="fielddescription"><?php if($edit) {echo $field['fielddescription'];} ?></textarea>
        		</div>
        		
        		<div class="form-group">	
	        		<label for"fieldgroup">Which group does it belongs to</label>
	        		<?php  if($edit) {echo "<span>Current value: ".$field['fieldgroup']."</span>";} ?>
	        		<select class="form-control" name="fieldgroup">
	        			<option value="general" <?php  if($edit) {if($field['fieldgroup'] == "general"){ echo "selected";}} ?>>General - general</option>
	        			<option value="fish" <?php  if($edit) {if($field['fieldgroup'] == "fish"){ echo "selected";}} ?>>Fishes - fish</option>
	        			<option value="nudi" <?php  if($edit) {if($field['fieldgroup'] == "nudi"){ echo "selected";}} ?>>Nudies - nudi</option>
	        		</select>
	        	</div>
	        	
	        	<div class="form-group">	
	        		<label for"fieldset">What fieldset it appears under</label>
	        		<?php  if($edit) {echo "<span>Current value: ".$field['fieldset']."</span>";} ?>
	        		<input class="form-control" name="fieldset" type="text" required="required" value="<?php  if($edit) {echo $field['fieldset'];} ?>">
	        	</div>
        		
        		<div class="form-group">
	        		<label for="fieldtype">Type of field Input text, select, multiselect, etc</label>
	        		<?php  if($edit) {echo "<span>Current value: ".$field['fieldtype']."</span>";} ?></span>
	        		<select class="form-control" name="fieldtype" required="required">
	        			<option value="text" <?php  if($edit) {if($field['fieldtype'] == "text"){ echo "selected";}} ?>>Text - text</option>
	        			<option value="textarea" <?php  if($edit) {if($field['fieldtype'] == "textarea"){ echo "selected";}} ?>>Textarea - textarea</option>
	        			<option value="textarea-tinymce"<?php  if($edit) {if($field['fieldtype'] == "textarea-tinymce"){ echo "selected";}} ?>>Text area with TinyMCE - textareatinymce</option>
	        			<option value="select" <?php  if($edit) {if($field['fieldtype'] == "select"){ echo "selected";}} ?>>Select - select</option>
	        			<option value="multi-select" <?php  if($edit) {if($field['fieldtype'] == "multi-select"){ echo "selected";}} ?>>Multiselect - multiselect</option>
	        			<option value="checkbox" <?php  if($edit) {if($field['fieldtype'] == "checkbox"){ echo "selected";}} ?>>Checkbox - checkbox</option>
	        			<option value="radio" <?php  if($edit) {if($field['fieldtype'] == "radio"){ echo "selected";}} ?>>Radio - radio</option>
	        		</select>
	        	</div>
	        	
        		<div class="form-group">
	        		<label for="fieldvaluetype">The type of value in the field for parsing</label>
	        		<?php  if($edit) {echo "<span>Current value: ".$field['fieldvaluetype']."</span>";} ?>
	        		<select class="form-control" name="fieldvaluetype">
	        			<option value="unique-string" <?php  if($edit) {if($field['fieldvaluetype'] == "unique-string"){ echo "selected";}} ?>>String with unique value - unique-string</option>
	        			<option value="multi-string" <?php  if($edit) {if($field['fieldvaluetype'] == "multi-string"){ echo "selected";}} ?>>String with multiple values (array, no key => value, only values) - multi-string</option>
	        			<option value="array-string" <?php  if($edit) {if($field['fieldvaluetype'] == "array-string"){ echo "selected";}} ?>>Strings as (array with key => value) - array-string</option>
	        			<option value="image-paths" <?php  if($edit) {if($field['fieldvaluetype'] == "image-paths"){ echo "selected";}} ?>>Paths to images in a multiple value string - image-paths</option>
	        			<option value="integer" <?php  if($edit) {if($field['fieldvaluetype'] == "integer"){ echo "selected";}} ?>>Integer (Numbers) - integer</option>
	        			<option value="boolean" <?php  if($edit) {if($field['fieldvaluetype'] == "boolean"){ echo "selected";}} ?>>Boolean as 0 or 1 for false or true - boolean</option>
	        		</select>
	        	</div>
        		
        		<div class="form-group">
	        		<label for="fielddefaultvalue">Default value if applicable (can be left empty)</label>
	        		<?php  if($edit) {echo "<span>Current value: ".$field['fielddefaultvalue']."</span>";} ?>
	        		<input class="form-control" name="fielddefaultvalue" type="text" value="<?php  if($edit) {echo $field['fielddefaultvalue'];} ?>">
        		</div>
        		
        		<div class="form-group">
	        		<label for="fieldsetclass">Class for the field group div (default form-group from bootstrap)</label>
	        		<?php  if($edit) {echo "<span>Current value: ".$field['fieldsetclass']."</span>";} ?>
	        		<input class="form-control" name="fieldsetclass" type="text" value="<?php  if($edit) {echo $field['fieldsetclass'];} ?>">
        		</div>
        		
        		<div class="form-group">
	        		<label for="fieldclass">Class for the field (default form-control from bootstrap)</label>
	        		<?php  if($edit) {echo "<span>Current value: ".$field['fieldclass']."</span>";} ?>
	        		<input class="form-control" name="fieldclass" type="text" value="<?php  if($edit) {echo $field['fieldclass'];} ?>">
        		</div>
        		
        		<div class="form-group">
        			<input class="button" name="<?php if($edit) {echo "updatefield"; }else{echo "createfield"; } ?>" type="submit" value="<?php if($edit) {echo "Update this field!"; }else{echo "Create this new field!"; } ?>">
        		</div>
        		
        	</fieldset>
        	
        </form>
        </div>
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
