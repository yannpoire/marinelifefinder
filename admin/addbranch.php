<?php
	include_once "../common/base.php";
	$pageTitle = "Grow a new branch in the tree";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.tree.inc.php";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
?>

<div class="container">
	<div class="row">
		<div>
			<h1>Create a new branch in the tree</h1>
			<h2>Sprout a new branch or leaf anywhere in the tree</h2>
			<p>As this marine life directory grows, caching, performance and speed will have to be tested so be patient...</p><br />
			<form method="post" action="../db-interaction/branch.php" role="form">
				<input type="hidden" name="action" value="addbranch" />
				<fieldset>
				<legend>New branch names</legend>
				<div class="form-group">
					<label for="bname">New branch name*   </label>
					<input id="bname" name="bname" type="text" placeholder="Name of the branch" required="required" autofocus="autofocus" tabindex="1" /><br /><br />
			<!-- Alias for unique identifier by name -->
					<label for="bcommonname">New branch common name   </label>
					<input id="bcommonname" name="bcommonname" type="text" placeholder="Enter branch common name" tabindex="2" /><span>eg: butterflyfishes, slugs</span><br /><br />
					</div>
				</fieldset>
				<fieldset>
					<legend>The branch in the tree</legend>
					<p>If the name of the mother branch is known it can be typed in directly if not it can be selected</p>
					<div class="form-group">
					<input id="selected" name="brank" type="radio" value="s" tabindex="3" checked=""><label for="bfromselected"> Select mother branch name   </label>
					<select id="bfromselected" name="bfromselected" tabindex="4">
						<option value="Animalia">Animalia</option>
						<option value="Chordata">Chordata</option>
						<option value="Eukaryota">Eukaryota</option>
					</select><br /><br />
					<input id="bfromtyped" name="brank" type="radio" value="t" tabindex="5"><label for="bfromtyped"> Type mother branch name   </label>					
					<input id="bfromtyped" name="bfromtyped" type="text" placeholder=" Type the name" tabindex="6" /><br /><br />
					<label for="btaxonomy">Choose a taxonomy term</label>
					<select id="btaxonomy" name="btaxonomy" tabindex="7">
						<?php 
							/*
							 * For each taxonomy entry in values.php
							 */
							 	if ($branchranks) {
							 		echo '<option value=""></option>';
							 		$bs = $branchranks;
									foreach ($bs as $u) {
										echo '<option value="'.$u.'" />'.$u.'</option>';
									}
								} else {
									echo "Could not load field values";
								}
							?>
					</select>
					</div>			
				</fieldset>
				<fieldset>
					<div class="form-group">
					<legend>Branch details</legend>
					<p>Enter a summary for the branch</p>
					<label for="bsummary">Branch summary</label><br />
					<textarea id="bsummary" name="bsummary" class="textarea" tabindex="8"></textarea><br /><br /><br />
					<!-- ADD A RESET FEATURE
						<input type="submit" name="resetfields" id="resetfields" value="Reset Form" class="btn btn-default" role="button" />&nbsp;&nbsp;&nbsp;
					-->
					<input type="submit" name="badd" id="badd" value="Add Branch" class="btn btn-default" role="button" tabindex="9" /><br /><br />
				</div>
				</fieldset>
			</form>
		</div>
		</div>
	<div class="row">
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>
</div>