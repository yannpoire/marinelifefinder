<?php
	include_once "../common/base.php";
	$pageTitle = "Create a new page for the site";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
?>
<!-- Place inside the <head> of your HTML -->

</head>
<body>
<div class="container">
	<div class="row">
		<div>
			<h1>Edit a page</h1>
			<p>Edit a page</p>
			<p>Edit static pages</p><br />
		</div>
	</div>
	<div class="row">
		<ul class="top-options">
			<li><a href="pageeditor">Create a page</a></li>
			<li><a href="pageeditor">Edit a page</a></li>
			<li><a href="pagedelete">Delete a page</a></li>			
		</ul>
	</div>
	<div class="row">
		<table class="pagelist">
		<thead><td>Status</td><td>Name (link to page)</td><td>Alias</td><td>Category</td><td>Meta Desccription</td><td>Meta keywords</td></tr></thead>
		<?php
			$pages = new MLFPages($db);
			$results = $pages->fetchPages();
			foreach ($results as $result) {
				echo "<tr><td><a href='/admin/pageeditor?" .$pagepager. "' target='_self'>" .$results['pagename']. "</a></td><td>" .$results['pagealias']. "</td><td><a href='#'>".$pagecat."</a></td><td>".$metadescription."</td><td>".$metakeywords."</td></tr>";
			?>
		</table>
	</div>
		
			<form method="post" role="form">
					<input type="hidden" name="managepage" id="managepage" value="managepage" />
			</form>
		</div>
	</div>
</div>


<div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>