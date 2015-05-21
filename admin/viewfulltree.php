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
		<div class="col-md-6">
			<h1>A view of all the branches in the tree</h1>
			<h2>See all the branches and leaves of the whole tree</h2>
			<p>As this Marine Life Finder directory grows, caching, performance and speed will have to be tested so be patient...</p><br />
			<?php 
				$tree = new MLFTree($db);
        		$results= $tree->showTree();
					//echo "The row value is now = "; print_r($fromtree);
					//echo "The tree value is now = "; print_r($tree);
				//if (isset($fromtree) && !empty($fromtree) ) {
					//echo "<br />It is set already the fromtree rights values = "; print_r($fromtree);
				//} else {
				//	echo "<br /><h2>Error!</h2><p>Nothing to show :(</p>";
				//}
				$right = array();
				foreach($results as $result) {
				//$bnames = $result['bname'];
				//return $bnames;
					if (count($right)>0) {  
           			 // check if we should remove a node from the stack  
						while ($right[count($right)-1]<$result['rgt']) {  
						 	array_pop($right); 
							print_r($right); 
							echo count($right);
						}  
		        	}
					echo "<br />".str_repeat('  ',count($right)).$result['bname']."<br />";  
					$right[] = $result['rgt'];
				}
				
			 ?>
			
		</div>
		<div class="col-md-2">
			<?php include_once 'adminnav.php'; ?>
		</div>
	</div>
	<div class="row">
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>
</div>