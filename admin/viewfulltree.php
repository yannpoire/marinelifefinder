<?php
	include_once "../common/base.php";
	$pageTitle = "View all the branches in the tree";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.tree.inc.php";
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
		<div class="col-md-9">
			<h1>A view of all the branches in the tree</h1>
			<h2>See all the branches and leaves of the whole tree</h2>
			<p>As this Marine Life Finder directory grows, caching, performance and speed will have to be tested so be patient...</p><br />
			<div class="wholetree">
			<?php
				$tree = new MLFTree($db);
        		$tree->showBranchesList('animalia');
			 ?>
			 
			</div>
		</div>
		<div class="col-md-3">
			<?php include_once 'adminnav.php'; ?>
		</div>
	</div>
</div>
<?php include_once(ROOT_PATH."common/footer.php"); ?>
	<script>
		$(function(){
			$('.adminnav > li').bind('mouseover', openSubMenu);
			$('.adminnav > li').bind('mouseout', closeSubMenu);
			function openSubMenu() {
				$(this).find('ul').css('visibility', 'visible');	
			};
			function closeSubMenu() {
				$(this).find('ul').css('visibility', 'hidden');	
			};	   
		});
	</script>
	<script>
		$(function() {
			if ($('div.timedmsg')) {
				$( "div.timedmsg" ).slideDown( 1800, function() {
			  	}).delay( 5000 ).slideUp(1600);
			 }
		});
	</script>