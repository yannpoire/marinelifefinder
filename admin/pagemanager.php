<?php
	include_once "../common/base.php";
	$pageTitle = "Create a new page for the site";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
	include_once '../inc/class.pages.inc.php';
?> 
<!-- Place inside the <head> of your HTML -->

</head>
<body>
<div class="container">
	<div class="row">
		<div>
			<h1>Manage pages</h1>
			<p>View and manage static pages</p><br />
		</div>
	</div>
	<div class="row">
		<ul class="top-options">
			<li><a href="pagecreator.php">Create a page</a></li>
			<li><a href="pageeditor">Edit a page</a></li>
			<li><a href="pagedelete">Delete a page</a></li>			
		</ul>
	</div>
	<div class="row">
		<table class="pagelist" border="1" cellpadding="4" width="100%">
		<thead><td>Status</td><td>Title link to page</td><td>Alias</td><td>Category</td><td>Meta Description</td><td>Meta keywords</td><td>Page URL name</td></tr></thead>
	 	<?php 
			$pages = new MLFPages($db);
			$scope = "";
			$results = $pages->fetchPages($scope);
			foreach ($results as $result) {
				switch ($result['pagestatus']) {
					case 0 :
						$status = "Draft";
						break;
					case 1 :
						$status = "Published";
						break;
					default :
						$status = "Undefined";
						break;
				}
				echo "<tr><td>".$status."</td><td><a href='#' target='_self'>" .$result['pagetitle']. "</a></td><td>" .$result['pagealias']. "</td><td><a href='../displaypage.php?url=".$result['pageurl']."'>".$result['pagecat']."</a></td><td>".$result['metadesc']."</td><td>".$result['metakeys']."</td><td>".$result['pageurl']."</td></tr>";
			}
		?>
		</table>
	</div>
		</div>
	</div>
</div>


<div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>