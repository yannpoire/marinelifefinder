<?php
	include_once "common/base.php";
	$url = $_GET["url"];
	if (isset($url) && !empty($url) ) {
		include_once 'inc/class.pages.inc.php';
		$page= new MLFPages($db);
		$result = $page->showPage($url);	
	} else {
		echo "No page to display because of an empty query";
	}
	if (isset($result) && $result['pagestatus'] == 1) {
		$pagetitle = $result['pagetitle'];
		$metadesc = $result['metadesc'];
		$metakeys = $result['metakeys'];
		include_once ROOT_PATH."common/header.php";
		include_once ROOT_PATH."common/mainnav.php";
	} else {
		echo "Problem getting page";	
	}
?>
</head>
<body>
<div class="container">
	<div class="row">
		<h1><?php echo $result['pagetitle']; ?></h1>
		<noscript>This site just doesn't work, period, without JavaScript</noscript>
		<?php echo $result['pagecontent']; ?>
	</div>
	<div class="row">
		<?php include_once(ROOT_PATH."common/footer.php"); ?>
	</div>
</div>
