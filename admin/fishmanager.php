<?php
	include_once "../common/base.php";
	$pageTitle = "View and manage Fishes in the database";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.life.inc.php";
	include_once ROOT_PATH."common/header.php";
	$lifeObj = new MLFLife;
?>
</head>
<body>
<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>The directory of all fishes</h1>
			<p>Select desired criterias from the form. It can later be modified from within the page of the lifeform.</p>
			<p>Fields marked with an asterisk * are mandatory.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
	        <table class="table table-condensed" width="100%">
			<thead>
				<tr>
					<td>Binomial</td>
					<td>Common Name</td>
					<td>Family</td>
					<td>Classified as</td>
					<td>Meta Description</td>
					<td>Meta keywords</td>
					<td>Last modified</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$fishes = $lifeObj->fetchLife("Fish", "All");
					foreach ($fishes as $fish) {
						if ($fish['status'] == 0) {
							echo "<tr class=\"warning\">";
						} else {
							echo "<tr>";
						}
						$binomial = $fish['binomialfirst']." ".strtolower($fish['binomiallast']);
						echo "<td><span class=\"binomial\">"
							.$binomial."</span></td><td>
							<a href=\"editlife.php?fid=".$fish['fishID']."\">"
							.$fish['cname']. "</a></td><td>"
							.$fish['familycname']."</td><td>"
							.$fish['classification']. "</td><td>"
							.$fish['metadesc']."</td><td>"
							.$fish['metakeys']."</td><td>"
							.$fish['modified']."</td></tr>";
					}
					
				?>
			</tbody>
			</table>
		</div>
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
