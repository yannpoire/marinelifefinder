<?php
	include_once "../common/base.php";
	
	// check if the user is logged in if not redirect to homepage
	if (!isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']!=1) {
		header("Location: ../index.php");
	}
	
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.tree.inc.php";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
	$treeObj = new MLFTree;
	
	if(isset($_GET['status'])) {
		// $status = $_GET['status'];
		switch ($_GET['status']) {
			case 1:
				echo "<div class=\"alert alert-success alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Success!</strong> You can view <a class=\"alert-link\" href=\"viewfulltree.php\">all the fields</a> or use the form to make more changes</div>";
				break;
			case 2:
				echo "<div class=\"alert alert-warning alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Warning!</strong>No changes has been made because no fields were modified. If you do not want to make changes you can go back to the list of <a class=\"alert-link\" href=\"viewfulltree.php\">all the fields</a></div>";
				break;
			default:
				echo "<div class=\"alert alert-danger alert-dismissible\"><strong>Failed!</strong> something went wrong... Very wrong... Very very wrong...</div>";
				break;
		}
	}
	
	// Check if the page is called in edit mode and update $editmode and the title accordingly
	if (isset($_GET['edit']) && $_GET['edit'] == TRUE && isset($_GET['id']) ) {
		
		// get the branch with branchID as row $branch from the mlf_tree DB
		$branch = $treeObj->getBranch($_GET['id']);
		$editmode = 1;		
		// set the title to edit
		$pageTitle = "Edit and manage the branch ".$branch['cname'];
	} else {
		// set the title to new
		echo "edit mode off";
		$editmode = 0;	
		$pageTitle = "Grow a new branch in the tree";
	}
	
?>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Create a new branch in the tree</h1>
			<h2>Sprout a new branch or leaf anywhere in the tree</h2>
			<p>As this marine life directory grows, caching, performance and speed will have to be tested so be patient...</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form method="post" action="../db-interaction/branch.php" role="form">
				<input type="hidden" name="action" value="<?php if ($editmode == 1) {echo "updatebranch";}else{echo "createbranch";} ?>">
				<?php if(isset($_GET['id'])) {echo "<input name=\"branchID\" type=\"hidden\" value=\"".$_GET['id']."\">";} ?>
				
				<fieldset>
				<legend>New branch names</legend>
					<div class="form-group">
						<label for="bname">New branch name*</label>
						<input class="form-control" name="name" type="text" placeholder="Name of the branch" required="required" autofocus="autofocus" <?php if($editmode==1) {echo "value=\"".$branch['name']."\"";} ?>>
					</div>
					<div class="form-group">
						<label for="cname">New branch common name</label>
						<input class="form-control" name="cname" type="text" placeholder="Enter branch common name" <?php if($editmode==1) {echo "value=\"".$branch['cname']."\"";} ?>>
					</div>
					<div class="form-group">	
						<label for="taxonomy">Choose a taxonomy term</label>
						<select class="form-control" name="taxonomy">
							<?php 
								/*
								 * Get each taxonomy entry of taxonomy array in values.php
								 */
								 	if ($branchranks) {
										foreach ($branchranks as $u) {
											if ($u == $branch['taxonomy']) {
												echo "<option value=\"".$u."\" selected=\"selected\">".$u."</option>";
											} else {
												echo "<option value=\"".$u."\">".$u."</option>";
											}
										}
									}
								?>
						</select>
					</div>
				</fieldset>
				
				<fieldset>
					<legend>The branch in the tree</legend>
					
				<div class="form-group">
					<label for="subof"> Select mother branch name</label>
					<select class="form-control" name="subof">
						<option value="noselect"></option>
						<?php $treeObj->formselectBranch("animalia", $branch['subof']); ?>
					</select>
				</fieldset>
				
				<fieldset>
					<legend>Branch details</legend>
					<div class="form-group">
						<label for="summary">Branch summary</label>
						<textarea class="form-control" name="summary" class="textarea"><?php if($editmode==1) {echo $branch['summary'];} ?></textarea>
					</div>					
				</fieldset>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<input class="btn-primary btn-lg btn-block" type="submit"  name="<?php if ($editmode == 1) {echo "updatebranch";}else{echo "createbranch";} ?>" value="<?php if ($editmode == 1) {echo "Update this branch";} else {echo "Create this branch";} ?>" role="button">
				</form>
			</div>
		</div>
	</div>
</div>

<?php include_once(ROOT_PATH."common/footer.php"); ?>