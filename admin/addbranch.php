<?php
	include_once "../common/base.php";
	$pageTitle = "What are you looking for?";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
?>

<div class="container">
	<div class="row">
		<div class="col-md-4">&nbsp;</div>
		<div class="col-md-4">
			<h1>Create a new branch in the tree</h1>
			<p>Create a new branch or leaf in the tree, anywhere</p>
			<p>As this directory grows, caching, performance and speed will have to be tested so be patient...</p>
			<form role="form">
				<div class="form-group">
					<label for="branchname">Name of the new branch*</label>
					<input id="branchname" type="text" class="form-control" required="required" autofocus="autofocus" />
					<label for="branchfrom">Branch from</label>
					<input id="branchfrom" type="checkbox" />
					<label for="branchcommonname">Branch common name (can be empty)</label>
					<input id="branchcommonname" type="text" class="form-control" />
					<input type="submit" name="resetfields" id="resetfields" value="Reset Form" class="btn btn-default" role="button" />
					<input type="submit" name="addnewbranch" id="addnewbranch" value="Add Branch" class="btn btn-default" role="button" />
				</div>
			</form>
		</div>
		<div class="col-md-4">&nbsp;</div>
	</div>
</div>


<div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>