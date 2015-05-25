<?php
	include_once "../common/base.php";
	$pageTitle = "Create a new page for the site";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
?>
<!-- Place inside the <head> of your HTML -->
<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>

</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<h1>Create a new page</h1>
			<p>Create a new page</p>
			<p>Create new static pages</p><br />
			<form method="post" role="form" action="../db-interaction/pages.php">
			
			<div class="pagestatus">
				<label for="draft">Draft</label>
				<input id="draft" name="pagestatus" type="radio" value="draft" checked="checked" />
				<label for="published">Published</label>
				<input id="published" name="pagestatus" type="radio" value="published" />
				<input type="hidden" id="action" name="action" value="createpage" />
				<input type="submit" name="createnewpage" id="createnewpage" value="Create new page" class="btn btn-default" role="button" /><br /><br />
			</div>
			<fieldset>	
				<legend>New page details</legend>
				<label for="pagetitle">Name of the new page*</label>
				<input id="pagetitle" type="text" placeholder="Name of the page" required="required" autofocus="autofocus" tabindex="1" /><br /><br />			
				<label for="pagecategory">Choose page category   </label>
				<select id="pagecategory" name="pagecategory" tabindex="2">
					<option value="uncategorized">Uncategorized</option>
						<?php
							foreach ($pagecat as $cat) {
								print_r($pagecat);
								echo "<option value='".$cat."'>".$cat."</option>";
							}
						 ?>
					</select>
			</fieldset>
				<fieldset>
					
					<legend>Page content</legend>
					<p>Enter the page content</p>
					<label for="pagecontent">New page content</label><br />
					<textarea id="pagecontent" class="textarea" tabindex="3"></textarea><br /><br />
					
				</fieldset>
				<fieldset>
					<legend>Page meta and SEO stuff</legend>
					<p>Enter the page meta keywords, description, URL</p>
					<label for="metadescription">Meta description (160 chars)</label><br />
					<textarea id="metadescription" tabindex="4"></textarea><br /><br />
					<label for="metakeywords">Meta keywords (coma separated)</label><br />
					<textarea id="metakeywords" tabindex="5"></textarea><br /><br />
					<label for="uniqueURL">Perm URL</label><br />
					<input id="uniqueURL" type="text" tabindex="6"></textarea><br />
				</fieldset>
				<fieldset>
					<input type="submit" name="createnewpage" id="createnewpage" value="Create new page" class="btn btn-default" role="button" tabindex="7" />
				</fieldset>
			</form>
		</div>
		<div class="col-md-3">
			<?php include_once("adminnav.php"); ?>
		</div>
	</div>


	<div class="row">
		<?php include_once(ROOT_PATH."common/footer.php"); ?>
	</div>
</div>