<?php
	include_once "../common/base.php";
	$pageTitle = "Create a new branch in the tree";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
?>

<div class="container">
	<div class="row">
		<div>
			<h1>Create a new branch in the tree</h1>
			<p>Create a new branch or leaf in the tree, anywhere</p>
			<p>As this directory grows, caching, performance and speed will have to be tested so be patient...</p><br />
			<form role="form">
				<fieldset>
				<legend>New branch details</legend>
				<div class="form-group">
					<label for="branchname">Name of the new branch*</label>
					<input id="branchname" type="text" placeholder="Name of the branch" required="required" autofocus="autofocus" /><br /><br />
			<!-- Alias for unique identifier by name -->
					<input id="branchalias" type="hidden" readonly="readonly" disabled="disabled" />
					<label for="branchcommonname">Branch common name (if applicable eg: butterflyfishes)   </label>
					<input id="branchcommonname" type="text" placeholder="Enter branch common name" /><br /><br />
				</fieldset>
				<fieldset>
					<legend>Mother branch in the tree</legend>
					<p>If the name of the mother branch is known it can be typed in directly if not it can be selected</p>
					<label for="branchfrom">Branch from</label>					
					<input id="knownbranchfrom" type="text" placeholder="Type the name if known" /><span>   (If mother branch name known) or</span><br /><br />
					<label for="selectbranchfrom">Select mother branch name   </label>
					<select id="selectbranchform">
						<option>Kingdom</option>
					</select><br /><br />
				</fieldset>
				<fieldset>
					
				</fieldset>
					<legend>Branch details</legend>
					<p>Enter a summary for the branch</p>
					<label for="branchsummary">Branch summary</label><br />
					<textarea id="branchsummary" class="textarea"></textarea><br /><br /><br />
					<input type="submit" name="resetfields" id="resetfields" value="Reset Form" class="btn btn-default" role="button" />&nbsp;&nbsp;&nbsp;
					<input type="submit" name="addnewbranch" id="addnewbranch" value="Add Branch" class="btn btn-default" role="button" />
				</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>


<div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>