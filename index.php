<?php
	include_once "common/base.php";
	$pageTitle = "Welcome on Marine Life Finder";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
	
?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
	<div class="container">
		<h1>Marine Life Finder</h1>
		<noscript>This site just doesn't work, period, without JavaScript</noscript>
		<p>This website has been designed to help people identify the marine life they can see around the world. Fishes, corals, crabs, shrimps, sponges, anemones and many more.</p>
		<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn how you can start searching &raquo;</a></p>
	</div>
</div>

<div class="container">
	<!-- Example row of columns -->
	<div class="row">
		<div class="col-md-4">
			<h2>Quick Search</h2>
			<p>As most fishes have distinct traits, it is quite easy to narrow down what family and species he belongs to and what it his name. Try this interactive search using the most common but efficient criterias when identifying marine life.</p>
			<p><a class="btn btn-default" href="<?php echo BASE_URL; ?>pages/searchsplash.php" role="button">Start searching &raquo;</a></p>
		</div>
		<div class="col-md-4">
			<h2>Advanced Search</h2>
			<p>You have some more advanced knowledge about marine life or want to use more advanced criterias.</p>
			<p><a class="btn btn-default" href="<?php echo BASE_URL; ?>pages/searchsplash.php" role="button">Start searching &raquo;</a></p>
		</div>
		<div class="col-md-4">
			<h2>Custom Search</h2>
			<p>Create a custom tailored searches by selecting the criterias you want and save them in your profile for reuse.</p>
			<p><a class="btn btn-default" href="<?php echo BASE_URL; ?>pages/searchsplash.php" role="button">Start searching &raquo;</a></p>
		</div>
	</div>

	<hr>
	
	<div class="row">
		<div>
			<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['username']) && $_SESSION['LoggedIn']==1):	?>
				<!-- IF LOGGED IN -->
			<!-- Content here -->
			<p>Welcome</p>
			<ul>
				<li>
					<a href="admin/addbranch.php">Add a branch</a>
			    </li>
			</ul>
				<p><a href="<?php echo BASE_URL; ?>logout.php" class="button" role="button">Log out</a> <a href="<?php echo BASE_URL; ?>account.php" class="button">Your Account</a></p>
			<?php else: ?>
				<!-- IF LOGGED OUT -->
				<!-- Alternate content here -->
			<p>You are NOT logged in!</p>
			<ul id="list">
				<li class="colorRed">
					<span>Walk the dog</span>
				</li>
				<li class="colorBlue">
					<span>Pick up dry cleaning</span>
				</li>
				<li class="colorGreen">
					<span>Milk</span>
				</li>
			</ul>
			<img src="<?php echo BASE_URL; ?>/images/newlist.jpg" alt="Your new list here!" />
				<p><a class="btn btn-default" href="<?php echo BASE_URL; ?>signup.php">Sign up</a> &nbsp; <a class="btn btn-default" href="login.php" role="button">Log in</a></p>
				<!-- END OF IF STATEMENT -->
			<?php endif; ?>			
		</div>
	</div>
	<div class="row">
		<?php include_once(ROOT_PATH."common/footer.php"); ?>
	</div>
</div>
