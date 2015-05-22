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
		<div class="col-md-9">
			<h1>A view of all the branches in the tree</h1>
			<h2>See all the branches and leaves of the whole tree</h2>
			<p>As this Marine Life Finder directory grows, caching, performance and speed will have to be tested so be patient...</p><br />
			<div class="wholetree"><ul>
			<?php
				$aliases = array(); 
				$tree = new MLFTree($db);
        		$results = $tree->showBranchesList();
				//print_r($results);
				foreach ($results as $result) {
					//$count[] = $result['balias']);
					echo '<li><a href="#">'.$result['bname']."</a></li>";
				}
							
			 ?>
			</u></div>
		</div>
		<div class="col-md-3">
			<?php include_once 'adminnav.php'; ?>
		</div>
	</div>
	<div class="row">
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>
</div>