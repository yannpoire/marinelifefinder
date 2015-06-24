<?php
	include_once "../common/base.php";
	$pageTitle = "View and manage Fields in the database";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.fields.inc.php";
	include_once ROOT_PATH."common/header.php";
	$fieldObj = new MLFFields($db);
?>
</head>
<body>
<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="container">
		<h1>Quick Search</h1>
		<p>Easy search by characteristics and features</p>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<form method="post" action="../db-interaction/life.php" role="form">
				<input name="action" type="hidden" value="lifeedit">
					<?php echo $fieldObj->assembleForm("1,2,3,4,5,6", FALSE); ?>
				<input class="button" name="lifeedit" type="submit" value="Add my creature!">
			</form>
			</div>
		</div>
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>