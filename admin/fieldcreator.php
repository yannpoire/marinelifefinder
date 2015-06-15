<?php
	include_once "../common/base.php";
	$pageTitle = "Create a new field";
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
		if(isset($_GET['status'])) {
		$status = $_GET['status'];
		$fieldalias = $_GET['field'];
		switch ($status) {
			case 1:
				echo "<div class=\"alert alert-success alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Success!</strong> You can <a class=\"alert-link\" href=\"../db-interaction/fields.php?edit=true&field="
					.$fieldalias."\">edit the newly created field</a> or view <a class=\"alert-link\" href=\"fieldmanager.php\">all the fields</a> or use the form to enter another one</div>";
				break;
			case 2:
				echo "<div class=\"alert alert-warning alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Warning!</strong> A field with the alias "
					.$fieldalias." already exist in the database</div>";
				break;
			default:
				echo "<div class=\"alert alert-danger alert-dismissible\"><strong>Failed!</strong> something went wrong... Very wrong... Very very wrong...</div>";
				break;
		}
	}
?>

<div class="container">
	<div class="row">
		<h1>Manage columns as fields from DB</h1>
		<p>Select desired criterias to create a form field for search</p>
		<p>Fields marked with an asterisk * are mandatory.</p>
	</div>
	<div class="row">
		<div class="form-style">
        <form method="post" action="../db-interaction/fields.php" role="form">
			<input name="action" type="hidden" value="createfield">
        	
        	<fieldset>
        	<legend>Fields details</legend>
        		
        		<div class="col-md-6">        		
	        		<label for="fieldname">Enter a name for the field</label>
	        		<input name="fieldname" type="text" required="required">
        		</div>
        		
        		<div class="col-md-6">
	        		<label for="fieldalias">Enter an alias for the field</label>
	        		<input name="fieldalias" type="text" required="required">
        		</div>
        		
        		<div class="col-md-12">
        			<label for="fielddescription">Enter a short description for field. It will be used for glossary and or tool tips of fields as well</label>
        			<textarea name="fielddescription"></textarea>
        		</div>
        		
        		<div class="col-md-6">	
	        		<label for"fieldgroup">Which group does it belongs to</label>
	        		<select name="fieldgroup">
	        			<option value="general">General</option>
	        			<option value="Fish">Fishes</option>
	        			<option value="Nudi">Nudies</option>
	        		</select>
	        	</div>
	        	
	        	<div class="col-md-6">	
	        		<label for"fieldset">What fieldset it appears under</label>
	        		<input name="fieldset" type="text" required="required">
	        	</div>
        		
        		<div class="col-md-6">
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
	        	</div>
	        	
        		<div class="col-md-6">
	        		<label for="fieldvaluetype">The type of value in the field for parsing</label>
	        		<select name="fieldvaluetype">
	        			<option value="uniquestring">String with unique value</option>
	        			<option value="multistring">String with multiple values (treated as array with no key => value but only values)</option>
	        			<option value="arraystring">Strings as array with key => value</option>
	        			<option value="imagepaths">Paths to images in a multiple value string</option>
	        			<option value="integer">Integer (Numbers)</option>
	        			<option value="boolean">Boolean as 0 or 1 for false or true</option>
	        		</select>
	        	</div>
        		
        		<div class="col-md-12">
	        		<label for="fielddefaultvalue">Default value if applicable (can be left empty)</label>
	        		<input name="fielddefaultvalue" type="text">
        		</div>
        		
        		<div class="col-md-12">
        			<input class="button" name="createfield" type="submit" value="Create this field">
        		</div>
        		
        	</fieldset>
        	
        </form>
        </div>
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
