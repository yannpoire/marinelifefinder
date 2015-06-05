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
				if(isset($_GET['status']) && $_GET['status']==1)
		        {
		        	$msg = "Success! The branch sprouted from the tree!";
		            timedMsg($msg, "success");
        	} ?>
<div class="container">
			
	<div class="row">

		<div class="col-md-9">
			<h1>Create a new branch in the tree</h1>
			<h2>Sprout a new branch or leaf anywhere in the tree</h2>
			<p>As this marine life directory grows, caching, performance and speed will have to be tested so be patient...</p><br />
		<div class="form-style">
			<form method="post" action="../db-interaction/branch.php" role="form">
				<input type="hidden" name="action" value="addbranch" />
				
				<fieldset>
				<legend>New branch names</legend>
					<label for="bname">New branch name*   </label>
					<input id="bname" name="bname" type="text" placeholder="Name of the branch" required="required" autofocus="autofocus" tabindex="1" />
			<!-- Alias for unique identifier by name -->
					<label for="bcommonname">New branch common name   </label>
					<input id="bcommonname" name="bcommonname" type="text" placeholder="Enter branch common name" tabindex="2" />
					
					<label for="btaxonomy">Choose a taxonomy term</label>
					<select id="btaxonomy" name="btaxonomy" tabindex="7">
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
					<input id="selected" name="brank" type="radio" value="s" tabindex="3" checked=""><label for="bfromselected"> Select mother branch name   </label>
					<select id="bfromselected" name="bfromselected" tabindex="4">
						<?php $treeObj->branchDdown("animalia"); ?>
					</select>
					<input id="bfromtyped" name="brank" type="radio" value="t" tabindex="5"><label for="bfromtyped"> Type mother branch name   </label>					
					<input id="bfromtyped" name="bfromtyped" type="text" placeholder=" Type the name" tabindex="6" /><br /><br />
					
				</fieldset>
				
				<fieldset>
					<legend>Branch details</legend>
					<p>Enter a summary for the branch</p>
					<label for="bsummary">Branch summary</label>
					<textarea id="bsummary" name="bsummary" class="textarea" tabindex="8"></textarea>
					<!-- ADD A RESET FEATURE
						<input type="submit" name="resetfields" id="resetfields" value="Reset Form" class="btn btn-default" role="button" />&nbsp;&nbsp;&nbsp;
					-->
					
				</fieldset>
				
			
		</div>
		</div>
		<div class="col-md-3">
			<br /><br />
			<input type="submit" name="badd" id="badd" value="Sprout this branch in the tree" class="btn btn-default" role="button" tabindex="9" />
			</form>
			<?php include_once("adminnav.php"); ?>
		</div>
		</div>
	<div class="row">
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>
<script>
$(function() {
	if ($('div.timedmsg')) {
		$( "div.timedmsg" ).slideDown( 1800, function() {
	  	}).delay( 5000 ).slideUp(1600);
	 }
});
</script>
</div>