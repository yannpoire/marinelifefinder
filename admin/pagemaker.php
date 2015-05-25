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
		<div>
			<h1>Create a new page</h1>
			<p>Create a new page</p>
			<p>Create new static pages</p><br />
			<form method="post" role="form">
				<fieldset>
				<legend>New page details</legend>
				<div class="form-group">
					<label for="pagename">Name of the new page*</label>
					<input id="pagename" type="text" placeholder="Name of the branch" required="required" autofocus="autofocus" /><br /><br />
			<!-- Alias for unique identifier by name -->
			<!-- <input id="pagealias" type="hidden" readonly="readonly" disabled="disabled" /> -->
					<label for="pagecategory">Choose page category   </label>
					<select id="pagecategory" name="pagecategory">
						<option value="uncategorized">Uncategorized</option>
						<?php echo "Autres choix" ?>xczzx
					</select>
				</fieldset>
				<fieldset>
					
				</fieldset>
					<legend>Page content</legend>
					<p>Enter the page content</p>
					<label for="newpagesummary">New page content</label><br />
					<textarea id="newpagesummary" class="textarea"></textarea><br /><br /><br />
					<input type="submit" name="createnewpage" id="createnewpage" value="Create new page" class="btn btn-default" role="button" />
				</fieldset>
				<fieldset>
					<legend>Page meta and SEO stuff</legend>
					<p>Enter the page meta keywords, description, URL</p>
					<label for="metadescription">Meta description (160 chars)</label><br />
					<textarea id="metadescription"></textarea><br /><br /><br />
					<label for="metakeywords">Meta keywords (coma separated)</label><br />
					<textarea id="metakeywords"></textarea><br /><br /><br />
					<label for="uniqueURL">Perm URL</label><br />
					<input id="uniqueURL" type="text"></textarea><br /><br /><br />
				</fieldset>
				</div>
			</form>
		</div>
	</div>
</div>


<div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
</div>