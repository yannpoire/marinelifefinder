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

<div class="container">
	<div class="row">
		<h1>The directory of all fishes</h1>
		<p>Select desired criterias from the form. It can later be modified from within the page of the lifeform.</p>
		<p>Fields marked with an asterisk * are mandatory.</p>
	</div>
	<div class="row">
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
				$fishes = $lifeObj->fetchLife("Fish");
				foreach ($fishes as $fish) {
					if ($fish['fstatus'] == 0) {
						echo "<tr class=\"warning\">";
					} else {
						echo "<tr>";
					}
					$binomial = $fish['fbinomialfirst']." ".strtolower($fish['fbinomiallast']);
					echo "<td><span class=\"binomial\">"
						.$binomial."</span></td><td>
						<a href=\"editlife.php?fid=".$fish['fid']."\">"
						.$fish['fcname']. "</a></td><td>"
						.$fish['ffamilycname']."</td><td>"
						.$fish['fclassification']. "</td><td>"
						.$fish['fmetadesc']."</td><td>"
						.$fish['fmetakeys']."</td><td>"
						.$fish['fmodified']."</td></tr>";
				}
				
			?>
		</tbody>
		</table>
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
