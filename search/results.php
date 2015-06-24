<?php

	include_once "../common/base.php";
	$pageTitle = "Results of the search";
	include_once ROOT_PATH."inc/class.search.inc.php";
	include_once ROOT_PATH."common/header.php";
	$searchObj = new MLFSearch($db);
?>
</head>
<body>
<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
	if (isset($_SESSION) && !empty($_SESSION['results'])) {
		$results = $_SESSION['results'];
	}
?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="container">
		<h1>Quick Search</h1>
		<p>Easy search by characteristics and features</p>
	</div>
	<div class="container">
		<?php $searchObj->displayResults($results); ?>		
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>