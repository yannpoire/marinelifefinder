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
		<h1>Create or Edit fields</h1>
		<p>Create or edit fields used to create pages, forms, searches, species. They can be used across the site to generate various input and can be called with a unique ID or an alias which ae unique as well</p>
	</div>
	<div class="row">
		<div>
        <form method="post" action="../db-interaction/fields.php" role="form">
			<input name="action" type="hidden" value="createfield">
        	
        	<fieldset>
        	<legend>Fields details</legend>
        		
        		<div class="form-group">        		
	        		<label for="fieldname">Enter a name for the field*</label>
	        		<input class="form-control" name="fieldname" type="text" required="required">
        		</div>
        		
        		<div class="form-group">
	        		<label for="fieldalias">Enter an alias for the field*</label>
	        		<input class="form-control" name="fieldalias" type="text" required="required">
        		</div>
        		
        		<div class="form-group">
        			<label for="fielddescription">Enter a short description for field. It will be used for glossary and or tool tips of fields as well</label>
        			<textarea class="form-control" name="fielddescription" row="3"></textarea>
        		</div>
        		
        		<div class="form-group">	
	        		<label for"fieldgroup">Which group does it belongs to*</label>
	        		<select class="form-control" name="fieldgroup">
	        			<option value="general">General</option>
	        			<option value="Fish">Fishes</option>
	        			<option value="Nudi">Nudies</option>
	        		</select>
	        	</div>
	        	
	        </fieldset>
	        <fieldset>
	        	<legend>Fieldset</legend>
	        	
	        	<div class="form-group">	
	        		<label for"fieldset">What fieldset it appears under*</label>
	        		<input class="form-control" name="fieldset" type="text" required="required">
	        	</div>
        		
        		<div class="form-group">
	        		<label for="fieldtype">Type of field Input text, select, multiselect, etc*</label>
	        		<select class="form-control" name="fieldtype" required="required">
	        			<option value="text">Text</option>
	        			<option value="textarea">Textarea</option>
	        			<option value="textareatinymce">Text area with TinyMCE</option>
	        			<option value="select">Select</option>
	        			<option value="multiselect">Multiselect</option>
	        			<option value="checkbox">Checkbox</option>
	        			<option value="radio">Radio</option>
	        		</select>
	        	</div>
	        	
	        </fieldset>
	        <fieldset>
	        <legend>Fields values</legend>
	        	
        		<div class="form-group">
	        		<label for="fieldvaluetype">The type of value in the field for parsing*</label>
	        		<select class="form-control" name="fieldvaluetype">
	        			<option value="unique-string">String with unique value</option>
	        			<option value="multi-string">String with multiple values (treated as array with no key => value but only values)</option>
	        			<option value="array-string">Strings as array with key => value</option>
	        			<option value="image-paths">Paths to images in a multiple value string</option>
	        			<option value="integer">Integer (Numbers)</option>
	        			<option value="boolean">Boolean as 0 or 1 for false or true</option>
	        		</select>
	        	</div>
        		
        		<div class="form-group">
	        		<label for="fielddefaultvalue">Default value if applicable (can be left empty)</label>
	        		<input class="form-control" name="fielddefaultvalue" type="text">
        		</div>
        		
        	</fieldset>
        	<fieldset>	
	        	<div class="form-group">
	        		<label for="fieldsetclass">Fieldset CSS Class</label>
	        		<input class="form-control" name="fieldsetclass" type="text">
	        	</div>
        		
	        	<div class="form-group">
	        		<label for="fieldclass">Field CSS Class</label>
	        		<input class="form-control" name="fieldclass" type="text">
	        	</div>
	        </fieldset>
        		
    		<div class="form-group">
    			<input class="button" name="createfield" type="submit" value="Create this field">
    		</div>
        	

        </form>
        </div>
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
