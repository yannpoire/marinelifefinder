<?php
	include_once "../common/base.php";
	$pageTitle = "Grow a new branch in the tree";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.tree.inc.php";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."common/forms.php";
	$treeObj = new MLFTree;
?>
</head>
<body>
	
<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Create a new branch in the tree</h1>
			<h2>Sprout a new branch or leaf anywhere in the tree</h2>
			<p>As this marine life directory grows, caching, performance and speed will have to be tested so be patient...</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 form-style">
			<form method="post" action="../db-interaction/branch.php" role="form">
				<input type="hidden" name="action" value="addbranch">
				
				<fieldset>
				<legend>New branch names</legend>
					<label for="bname">New branch name*</label>
					<input name="bname" type="text" placeholder="Name of the branch" required="required" autofocus="autofocus">
					<label for="bcommonname">New branch common name</label>
					<input name="bcommonname" type="text" placeholder="Enter branch common name">
					
					<label for="btaxonomy">Choose a taxonomy term</label>
					<select id="btaxonomy" name="btaxonomy">
						<?php 
							/*
							 * For each taxonomy entry in values.php
							 */
							 	if ($branchranks) {
							 		echo '<option value=""></option>';
									foreach ($branchranks as $u) {
										echo '<option value="'.$u.'" />'.$u.'</option>';
									}
								} else {
									echo "Could not load field values";
								}
							?>
					</select>
				</fieldset>
				
				<fieldset>
					<legend>The branch in the tree</legend>
					<p>If the name of the mother branch is known it can be typed in directly if not it can be selected</p>
					<input name="brank" type="radio" value="s" checked="">
					<label for="bfromselected"> Select mother branch name   </label>
					<select name="bfromselected">
						<?php $treeObj->branchDdown("animalia"); ?>
					</select>
					<input name="brank" type="radio" value="t">
					<label for="bfromtyped"> Type mother branch name   </label>					
					<input name="bfromtyped" type="text" placeholder=" Type the name">
				</fieldset>
				
				<fieldset>
					<legend>Branch details</legend>
					<label for="bsummary">Branch summary</label>
					<textarea name="bsummary" class="textarea"></textarea>					
				</fieldset>
		</div>
		<div class="col-md-3">
			<input class="btn-primary btn-lg btn-block" name="badd" type="submit" value="Sprout this branch in the tree" role="button">
			</form>
		</div>
	</div>
</div>

<?php include_once(ROOT_PATH."common/footer.php"); ?>