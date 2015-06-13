<?php
	include_once "../common/base.php";
	$pageTitle = "View and manage Fishes in the database";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.life.inc.php";
	include_once ROOT_PATH."common/header.php";
	$lifeObj = new MLFLife;
?>
</head>
<body>
<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
?>

<div class="container">
	<div class="row">
		<h1>Manage columns as fields from DB</h1>
		<p>Select desired criterias to create a form field for search</p>
		<p>Fields marked with an asterisk * are mandatory.</p>
	</div>
	<div class="row">
		<div class="form-style">
        <form method="post" action="../db-interaction/forms.php" role="form">
			<input name="action" type="hidden" value="createfield">
        	
        	<fieldset>
        	<legend>Fields details</legend>
        		
        		<label for="fieldname">Enter a name for the field</label>
        		<input name="fieldname" type="text" required="required">
        		
        		<label for="fieldalias">Enter an alias for the field (will be used to id field, no space, lowercase, dash - can be used)</label>
        		<input name="fieldalias" type="text" required="required">
        		
        		<label for="fielddescription">Enter a short description for field. It will be used for flossary of fields as well</label>
        		<textarea name="fielddescription"></textarea>
        			
        		<label for"fieldgroup">Which group does it belongs to</label>
        		<select name="fieldgroup">
        			<option value="general">General</option>
        			<option value="fish">Fishes</option>
        			<option value="nudi">Nudies</option>
        		</select>
        		
        		<label for="fieldtype">Type of field Input text, select, multiselect, etc</label>
        		<select name="fieldtype" required="required">
        			<option value="text">Text</option>
        			<option value="textarea">Textarea</option>
        			<option value="textareatinymce">Text area with TinyMCE</option>
        			<option value="select">Select</option>
        			<option value="multiselect">Multiselect</option>
        			<option value="checkbox">Checkbox</option>
        			<option value="radio">Radio</option>
        		</select>
        		
        		<label for="fieldvaluetype">The type of value in the field for parsing</label>
        		<select name="fieldvaluetype">
        			<option value="uniquestring">String with unique value</option>
        			<option value="multistring">String with multiple values (treated as array with no key => value but only values)</option>
        			<option value="arraystring">Strings as array with key => value</option>
        			<option value="imagepaths">Paths to images in a multiple value string</option>
        			<option value="integer">Integer (Numbers)</option>
        			<option value="boolean">Boolean as 0 or 1 for false or true</option>
        		</select>
        		
        		<label for="fielddefaultvalue">Default value if applicable (can be left empty)</label>
        		<input name="fielddefaultvalue" type="text">
        		
        		<input type="submit" name="createfield" value="Create this field" class="button" />
        		
        	</fieldset>
        	
        </form>
        </div>
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
