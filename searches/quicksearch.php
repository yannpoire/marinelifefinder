<?php
	include_once 'common/header.php';
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Project name</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<form class="navbar-form navbar-right" role="form">
				<div class="form-group">
					<input type="text" placeholder="Email" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control">
				</div>
				<button type="submit" class="btn btn-success">Sign in</button>
			</form>
		</div><!--/.navbar-collapse -->
	</div>
</nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="container">
		<h1>Quick Search</h1>
		<p>Easy search by characteristics and features</p>
		<div class="quicksearchform">
			<form>
				<div class="quicksearchform_taxo">
					<input id="name" type="text" />
					<input id="binomal" type="text"  />
					<input id="othercommonnames" type="text" />
					<div class="classtree">
						<input id="kingdom" />
					</div>
				</div>
				<div class="features">
					<input id="shape" type="checkbox"/>
					<input id="primarycolors" type="checkbox" />
					<input id="secondarycolors" type="checkbox" />
					<input id="patternsmarkings" type="checkbox" />
					<input id="uniquefeatures" type="checkbox" />
				</div>
				<div class="formcontrols">
					<button id="resetfields"></button>
					<button id="submitsearch"></button>
				</div>
			</form>
		</div>
	</div>

<div>
	<?php include_once 'common/footer.php'; ?>
</div>
