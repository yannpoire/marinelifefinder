<?php
	include_once "../common/base.php";
	$pageTitle = "View and manage Fields in the database";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.fields.inc.php";
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
		<h1>The listing of all fields</h1>
		<p>All the possible fields of forms</p>
	</div>
	<div class="row">
        <table class="table table-condensed" width="100%">
		<thead>
			<tr>
				<td>Field ID</td>
				<td>Field Name</td>
				<td>Field Alias</td>
				<td>Field Description</td>
				<td>Field Group</td>
				<td>Field Type</td>
				<td>Field Value Type</td>
				<td>Default Value</td>
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
					echo "<td>"
					.$binomial."</td><td><a class=\"binomial\" href=\"editlife.php?fid=".$fish['fid']."\">"
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
