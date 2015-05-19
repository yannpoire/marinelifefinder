<?php
	include_once "../common/base.php";
	$pageTitle = "What are you looking for?";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.life.inc.php";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
?>
<div class="container">
	<div class="row">
		<h1>Enter a new lifeform in the directory</h1>
		<p>Select desired criterias from the form. It can later be modified from within the page of the lifeform.</p>
		<p>Fields marked with an asterisk * are mandatory.</p>
	</div>
	<div class="row">
		<form role="form">
			<div class="form-group">
			<fieldset>
				<legend>Group</legend>
				<select>
					<?php 
							/*
					 * For each lifegroups entry in values.php
					 */
					 	if ($lifegroups) {
					 		$gs = $lifegroups;
							foreach ($gs as $l) {
								$g = strtolower($gs);
								echo '<option id="'  .$g.  '" value="'.$g.'" />&nbsp;'.$l.'</option>';
							}
						} else {
							echo "Could not load field values";
						}
					?>
				</select><br /><br />
			</fieldset>
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Basic Info</legend>
				<p>Enter the names of the organism</p>
				<label for="commonname">Name*</label><br />
				<input id="commonname" type="text" class="" required="required" autofocus="autofocus" /><br /><br />
				<label for="binomial">Binomial*</label><br />
				<input id="binomialfirst" type="text" class="" />&nbsp;&nbsp;<input id="binomiallast" type="text" class="inline" /><br /><br />
				<label for="othercommonname">Other common names</label><br />
				<input id="othercommonname" type="text" class="" /><br /><br />
			</fieldset>			
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Classification</legend>
				<select>
					<option value="tree">Tree</option>
				</select><br /><br />
			</fieldset>
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Visual appearance</legend>
				<select>
					<option value="tree">Tree</option>
				</select><br /><br />
			</fieldset>
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Media</legend>
				<p>Add images to the gallery</p>
				<select>
					<option value="tree">Tree</option>
				</select><br /><br />
			</fieldset>
		</div>
		</form>
	</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>
