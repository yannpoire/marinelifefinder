<?php
	include_once "../common/base.php";
	$pageTitle = "Create a new page for the site";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/values.php";
	include_once '../inc/class.pages.inc.php';
	include_once '../inc/class.fields.inc.php';
	$pageObj = new MLFPages;
?>
</head>
<body>
<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
	
	if(isset($_GET['status'])) {
		$status = $_GET['status'];
		switch ($status) {
			case 1:
				echo "<div class=\"alert alert-success alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Success!</strong> You can view <a class=\"alert-link\" href=\"pagemanager.php\">all the pages</a> or use the form to make more changes</div>";
				break;
			case 2:
				echo "<div class=\"alert alert-warning alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
					</button><strong>Warning!</strong>No changes has been made because no fields were modified. If you do not want to make changes you can go back to the list of <a class=\"alert-link\" href=\"pagemanager.php\">all the pages</a></div>";
				break;
			default:
				echo "<div class=\"alert alert-danger alert-dismissible\"><strong>Failed!</strong> something went wrong... Very wrong... Very very wrong...</div>";
				break;
		}
	}

	if (isset($_GET['id'])) {
		$pageIDs = trim($_GET['id']);
		$page = $pageObj->getPages($pageIDs);
		$page = $page[0];
	}
?>
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
				<input name="pagetitle" type="text" placeholder="Name of the page" required="required" autofocus="autofocus" value="">
				
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
			<input type="hidden" name="action" value="createpage">
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
				<textarea class="form-control" name="metadesc"></textarea>
				<label for="metakeys">Meta keywords (coma separated)</label>
				<textarea class="form-control" name="metakeys"></textarea>
				<label for="pageurl">Perm URL</label>
				<input class="form-control" name="pageurl" type="text"></textarea>
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