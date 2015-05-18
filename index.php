<?php
	$pageTitle = "Welcome on Marine Life Finder";
	include_once 'common/header.php';
	include_once 'common/mainnav.php';
	include_once 'common/base.php';
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
			<p><a class="btn btn-default" href="pages/searchsplash.php" role="button">Start searching &raquo;</a></p>
		</div>
		<div class="col-md-4">
			<h2>Advanced Search</h2>
			<p>You have some more advanced knowledge about marine life or want to use more advanced criterias.</p>
			<p><a class="btn btn-default" href="pages/searchsplash.php" role="button">Start searching &raquo;</a></p>
		</div>
		<div class="col-md-4">
			<h2>Custom Search</h2>
			<p>Create a custom tailored searches by selecting the criterias you want and save them in your profile for reuse.</p>
			<p><a class="btn btn-default" href="pages/searchsplash.php" role="button">Start searching &raquo;</a></p>
		</div>
	</div>

	<hr>
	
	<div class="row">
		<div id="control">
			<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['username']) && $_SESSION['LoggedIn']==1):	?>
				<!-- IF LOGGED IN -->
			<!-- Content here -->
			<p>You are logged in!</p>
			<ul id="list">
				<li class="colorRed">
					<span>Walk the dog</span>
			        <div class="draggertab tab"></div>
			        <div class="colortab tab"></div>
			        <div class="deletetab tab"></div>
			        <div class="donetab tab"></div>
			    </li>
				<li class="colorBlue">
			        <span>Pick up dry cleaning</span>
			        <div class="draggertab tab"></div>
			        <div class="colortab tab"></div>
			        <div class="deletetab tab"></div>
			        <div class="donetab tab"></div>
				</li>
				<li class="colorGreen">
			        <span>Milk</span>
			        <div class="draggertab tab"></div>
			        <div class="colortab tab"></div>
			        <div class="deletetab tab"></div>
			        <div class="donetab tab"></div>
				</li>
			</ul>
			<form action="" id="add-new"> 
				<div>
					<input type="text" id="new-list-item-text" name="new-list-item-text" />
					<input type="submit" id="add-new-submit" value="Add" class="button" />
				</div>
			</form>
			<div id="share-area">
				<p>Public list URL: <a href="#">URL GOES HERE</a><small>(Nobody but YOU will be able to edit this list)</small></p>
			</div>
				<p><a href="/logout.php" class="button" role="button">Log out</a> <a href="/account.php" class="button">Your Account</a></p>
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
			<img src="/images/newlist.jpg" alt="Your new list here!" />
				<p><a class="btn btn-default" href="signup.php">Sign up</a> &nbsp; <a class="btn btn-default" href="login.php" role="button">Log in</a></p>
				<!-- END OF IF STATEMENT -->
			<?php endif; ?>			
		</div>
	</div>

<div>
	<?php include_once 'common/footer.php'; ?>
</div>
