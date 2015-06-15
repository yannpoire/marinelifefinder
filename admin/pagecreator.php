<?php
	include_once "../common/base.php";
	$pageTitle = "Create a new page for the site";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/values.php";
?>
<!-- <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script> -->
<script type="text/javascript" src="<?php echo BASE_URL; ?>plugins/ckeditor/ckeditor.js"></script> 
</head>
<body>
<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Create a new page</h1>
			<p>Create a static page for site general information.</p>
		</div>
	</div>
	<div class="row form-style">
		<div class="col-md-10">
		<form method="post" role="form" action="../db-interaction/pages.php">		
			<fieldset>	
				<legend>New page details</legend>
				<label for="pagetitle">Name of the new page*</label>
					<input name="pagetitle" type="text" placeholder="Name of the page" required="required" autofocus="autofocus">
				
				<input name="pagealias" type="hidden" value="pagealiasval">		
				<label for="pagecat">Choose page category</label>
				<select name="pagecat">
					<?php if(isset($pagecat) && !empty($pagecat)) {
								foreach ($pagecat as $cat) { echo "<option value=\"".$cat."\">".$cat."</option>";}
						 } else { echo "pagecat is not set"; }?>
				</select>
			</fieldset>
		</div>
		<div class="col-md-2">
			<input type="hidden" id="action" name="action" value="createpage">
			<input class="btn btn-primary btn-lg btn-block" name="createnewpage" type="submit" value="Create page" role="button">	
			
			<label class="radio-inline" for="draft">
				<input name="pagestatus" type="radio" value="draft" checked="checked">Draft</label>			
			<label class="radio-inline" for="published">
				<input name="pagestatus" type="radio" value="published">Published</label>
			
		</div>
		<div class="col-md-12">		
			<fieldset>
			<legend>Page content</legend>
				<label for="content">New page content</label>
				<textarea class="content" name="content" rows="20" required="required"></textarea>
			</fieldset>
			<fieldset>
				<legend>Page meta and SEO stuff</legend>
				<label for="metadesc">Meta description (160 chars)</label>
				<textarea name="metadesc"></textarea>
				<label for="metakeys">Meta keywords (coma separated)</label>
				<textarea name="metakeys"></textarea>
				<label for="pageurl">Perm URL</label>
				<input name="pageurl" type="text"></textarea>
			</fieldset>
		</form>
		</div>
	</div>
</div>
<?php include_once(ROOT_PATH."common/footer.php"); ?>
<script type="text/javascript" src="<?php echo BASE_URL; ?>plugins/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: "textarea.content",
    plugins : [ "link, image, hr, anchor, pagebreak, media, wordcount, table, responsivefilemanager"],
    image_advtab: true,
	external_filemanager_path:"../plugins/filemanager/",
	filemanager_title:"Responsive Filemanager" ,
	external_plugins: { "filemanager" : "plugins/responsivefilemanager/plugin.min.js"}
 });
</script>