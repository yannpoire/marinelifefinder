<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar">Icon 1</span>
				<span class="icon-bar">Icon 2</span>
				<span class="icon-bar">Icon 3</span>
			</button>
			<a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php">Marine Life Finder</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<div>
			<?php if(isset($_SESSION['LoggedIn']) && isset($_SESSION['username']) && $_SESSION['LoggedIn']==1):	?>
				<!-- IF LOGGED IN -->
			<!-- Content here -->
				<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['username']; ?> <span class="caret"></span></a>
			        	<ul class="dropdown-menu" role="menu">
			        		<li><a href="<?php echo BASE_URL; ?>account.php">Your Account</a></li>
			        		<li><a href="<?php echo BASE_URL; ?>logout.php">Log out</a></li>
			        	</ul>
			        </li>
			        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
			        	<ul class="dropdown-menu" role="menu">
				            <li><a href="<?php echo BASE_URL; ?>admin/givelife.php">Create a new creature</a></li>
				            <li><a href="<?php echo BASE_URL; ?>admin/fishmanager.php">Manage fishes</a></li>
				            <li class="divider"></li>
				            <li><a href="<?php echo BASE_URL; ?>admin/viewfulltree.php">View branches in the tree</a></li>
				            <li><a href="<?php echo BASE_URL; ?>admin/addbranch.php">Add a branch in the tree</a></li>
				            <li class="divider"></li>
				            <li><a href="<?php echo BASE_URL; ?>admin/pagemanager.php">View all pages</a></li>
				            <li><a href="<?php echo BASE_URL; ?>admin/pagecreator.php">Add a page</a></li>
				            <li class="divider"></li>
				            <li><a href="<?php echo BASE_URL; ?>admin/fieldmanager.php">View all fields</a></li>
				            <li><a href="<?php echo BASE_URL; ?>admin/fieldcreator.php">Add a field</a></li>
			          </ul>
			        </li>
			      </ul>
			<?php else: ?>
				
				<!-- IF LOGGED OUT -->
				<!-- Alternate content here -->
				
				<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown"><span>You are NOT logged in!</span></li>
			        	<ul class="dropdown-menu" role="menu">
			        		<li><a href="login.php" >Log in</a></li>
			        		<li><a href="<?php echo BASE_URL; ?>signup.php">Sign up</a></li>
			        	</ul>
			        </li>
			    </ul>
				<!-- END OF IF STATEMENT -->
			<?php endif; ?>			
		</div>
			<!-- <form class="navbar-form navbar-right" role="form">
				<div class="form-group">
					<input type="text" placeholder="Email" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control">
				</div>
				<button type="submit" class="btn btn-success">Sign in</button>
			</form> -->
		</div><!--/.navbar-collapse -->
	</div>
</nav>