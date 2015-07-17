<?php

	include_once "common/base.php";
	$pageTitle = "Results of the search";
	include_once ROOT_PATH."inc/class.life.inc.php";
	include_once ROOT_PATH."common/header.php";
	$lifeObj = new MLFLife($db);
?>
</head>
<body>
<?php
	include_once ROOT_PATH."common/mainnav.php";
	
	if (isset($_GET) && !empty($_GET)) {
		$group = $_GET['group'];
		$id = $_GET['id'];
		
		$result = $lifeObj->fetchLife($group, $id);
	} 
	if (isset($result) && !empty($result)) {
		$result = $result[0];
	} else {
		echo "Nothing to display";
	}
	
?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="container">
		<?php if (!empty($result)) { echo "<h1>".$result['cname']."<h1><h2>".$result['othercnames']."</h2><img src=\"something\">"; } ?>
	</div>
	<div class="container">
		<div class="row">
			<?php if (!empty($result)) { echo	"<div class=\"col-md-2\">",
				"<span>Sections</span>
				<ul>
					<li>General</li>
					<li>Appearance</li>
					<li>Anatomy</li>
					<li>Behavior</li>
					<li>Distribution</li>
					<li>Medias</li>
				</ul>
			</div>
			<div class=\"col-md-10\">"; } ?>
				<?php if (!empty($result)) {
					echo "<div>",
						"<p class=\"binomial\">".$result['binomialfirst']." ".strtolower($result['binomiallast'])."</p>",
						"<div class=\"content\">",
						$result['fcontent'],
						"</div>",
						"</div>";
				}	?>
			</div>
		</div>	
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>