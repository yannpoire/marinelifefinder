<?php
	if (!isset($_SESSION['LoggedIn']) && !isset($_SESSION['username']) && $_SESSION['LoggedIn']!==1) {
		header("Location : ../index.php");
	}
?>
<div class="adminnav-wrapper">
	<ul class="adminnav">
		<li>
			Creatures
			<ul>
				<li><a href="#">Display all the organisms (Disabled)</a></li>
				<li><a href="<?php echo BASE_URL; ?>admin/givelife.php">Create a new creature</a></li>
				<li><a href="<?php echo BASE_URL; ?>admin/fishmanager.php">Manage fish table</a></li>
			</ul>
		</li>
		<li>
			Branches
			<ul>
				<li><a href="<?php echo BASE_URL; ?>admin/treeviewer.php">View tree and manage branches</a></li>
				<li><a href="<?php echo BASE_URL; ?>admin/branchmanager.php">View and manage branches</a></li>
				<li><a href="<?php echo BASE_URL; ?>admin/brancheditor.php">Add a branch in the tree</a></li>
			</ul>
		</li>
		<li>
			Pages
			<ul>
				<li><a href="<?php echo BASE_URL; ?>admin/pagemanager.php">View all pages</a></li>
				<li><a href="<?php echo BASE_URL; ?>admin/pageeditor.php">Add a page</a></li>
			</ul>
		</li>
		<li>
			Fields
			<ul>
				<li><a href="<?php echo BASE_URL; ?>admin/fieldmanager.php">View all fields</a></li>
				<li><a href="<?php echo BASE_URL; ?>admin/fieldeditor.php">Add a field</a></li>
			</ul>
		</li>
	</ul>
</div>
