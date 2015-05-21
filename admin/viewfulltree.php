<?php
	include_once "../common/base.php";
	$pageTitle = "View all the branches in the tree";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.tree.inc.php";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
?>

<div class="container">
	<div class="row">
		<div>
			<h1>A view of all the branches in the tree</h1>
			<h2>See all the branches and leaves of the whole tree</h2>
			<p>As this Marine Life Finder directory grows, caching, performance and speed will have to be tested so be patient...</p><br />
			<?php 
				$tree = new MLFTree($db);
        		$row = $tree->showTree();
					echo "The row value is now = "; print_r($row);
				if (isset($tree) && !empty($tree) ) {
					echo "It is set already";
				} else {
					echo "<h2>Error!</h2><p>Nothing to show :(</p>";
				}
			 ?>
			
		</div>
		<div class="col-md-4">
			<?php include_once 'adminnav.php'; ?>
		</div>
	</div>
	<div class="row">
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>
</div>