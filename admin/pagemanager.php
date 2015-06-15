<?php
	include_once "../common/base.php";
	$pageTitle = "Manage the site pages";
	include_once '../inc/class.pages.inc.php';
	include_once ROOT_PATH."common/header.php";
?> 
</head>
<body>
<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
?>
<div class="container">
	<div class="row">
		<div>
			<h1>Manage pages</h1>
			<p>View and manage static pages</p><br />
		</div>
	</div>
	<div class="row">
		<table class="table table-condensed" width="100%">
		<thead>
			<tr>
			<td width="3%">Status</td>
			<td>Title link to page</td>
			<td>Alias</td>
			<td>Category</td>
			<td>Meta Description</td>
			<td>Meta keywords</td>
			<td>Page URL name</td>
			</tr>
		</thead>
		<tbody>
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
				echo "<tr><td>"
				.$status."</td><td><a href=\"#\" target=\"_self\">"
				.$result['pagetitle']."</a></td><td>"
				.$result['pagealias']."</td><td>"
				.$result['pagecat']."</td><td>"
				.$result['metadesc']."</td><td>"
				.$result['metakeys']."</td><td>"
				.$result['pageurl']."</td></tr>";
			}?>
		</tbody>
		</table>
	</div>
		</div>
	</div>
</div>
<?php include_once(ROOT_PATH."common/footer.php"); ?>