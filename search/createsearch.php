<?php
	include_once "../common/base.php";
	$pageTitle = "Create a custom search";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.search.inc.php";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
?>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Create a search</h1>
			<h2>Choose the criterias you would like for your search</h2>
			<p>Start by selecting values from the left side, they will appear as you build it</p>
			<p>As this Marine Life Finder directory grows, caching, performance and speed will have to be tested so be patient...</p><br />
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h3>Available fields</h3>
			<h4>Naming</h4>
			<ul>
				<li>Common name</li>
				<li>Binomial First</li>
				<li>Binomial Last</li>
				<li>Classification</li>
			</ul>
		</div>
		<div class="col-md-5">

			<div><ul>




			</u></div>
		</div>
		<div class="col-md-6">
			<?php include_once '../admin/adminnav.php'; ?>
		</div>
	</div>
	<div class="row">
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>
</div>