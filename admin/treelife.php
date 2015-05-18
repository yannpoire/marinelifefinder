<?php
	include_once "../common/base.php";
	$pageTitle = "What are you looking for?";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
?>

<div class="container">
	<div class="row">
		<h1>Create a new branch in the tree</h1>
		<p>Create a new branch or leaf in the tree, anywhere</p>
		<p>As this directory grows, caching, performance and speed will have to be tested so be patient...</p>
		<form>
			<div class="form-group">
				<label for="branchname">Name of the new branch</label>
				<input id="branchname" type="text" style="form-control" />
				<label for="branchparent"></label>
				<input id="branchparent" type="checkbox" />
				<input type="submit" id="add-new-branch" value="Add branch" class="button" />
			</div>
		</form>
	</div>
</div>


<div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>