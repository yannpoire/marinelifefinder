<?php
	include_once "../common/base.php";
	$pageTitle = "Give life in the the DB to an organism";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.life.inc.php";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."common/forms.php";
?>

</head>
<body>
<div class="container">
	<div class="row">
		<h1>Enter a new lifeform in the directory</h1>
		<p>Select desired criterias from the form. It can later be modified from within the page of the lifeform.</p>
		<p>Fields marked with an asterisk * are mandatory.</p>
	</div>
	<div class="row">
		<div class="col-md-9">
		<form role="form">
			<div class="form-group">
			<fieldset>
				<legend>Group*</legend>
				<select>
					<?php customDdown($lifegroups); ?>
				</select><br /><br />
			</fieldset>
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Basic Info</legend>
				<p>Enter the names of the organism</p>
				<label for="commonname">Common Name*</label>
				<input id="commonname" type="text" class="" required="required" autofocus="autofocus" /><br /><br />
				<label for="othercommonname">Other common names</label>
				<input id="othercommonname" type="text" class="" /><br /><br />
				<label for="binomial">Binomial*</label>&nbsp;&nbsp;
				<input id="binomialfirst" type="text" class="" />&nbsp;&nbsp;<input id="binomiallast" type="text" class="inline" /><br /><br />

			</fieldset>			
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Taxonomy & Classification</legend>
				<p>Enter the genus or the closest taxon know</p>
				<select>
					<option value="tree">Tree</option>
				</select><br /><br />
			</fieldset>
		</div>
		<div class="form-group fishgroup">
			<fieldset>
				<legend>Visual appearance of fishes</legend>
				<p>Select visual clues of fishes</p>
				
				<h3>Body</h3>
				
				<label for="generalshape">General shape</label>
				<select id="generalshape" name="generalshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['generalshape']); ?>
				</select><br />
				
				<label for="size">Length (cm)</label>
				<input id="size" name="size" type="text" /><br /><br />
				
				<h4>Head</h4>
				
				<label for="headshape">Head shape</label>
				<select id="headshape" name="headshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['head']['shape']); ?>
				</select><br />
				
				<label for="headsizetobody">Head size relative to body</label>
				<select id="headsizetobody" name="headsizetobody">
					<option value=""></option>
					<?php customDdown($gnathostomata['head']['sizetobody']); ?>
				</select><br /><br />
				
				<h4>Mouth</h4>
				
				<label for="mouthshape">Mouth shape</label>
				<select id="mouthshape" name="mouthshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['mouth']['shape']); ?>
				</select><br />
				
				<label for="mouthposition">Mouth position</label>
				<select id="mouthposition" name="mouthposition">
					<option value=""></option>
					<?php customDdown($gnathostomata['mouth']['position']); ?>
				</select><br />
				
				<label for="mouthsizetohead">Mouth size relative to head</label>
				<select id="mouthsizetohead" name="mouthsizetohead">
					<option value=""></option>
					<?php customDdown($gnathostomata['mouth']['sizetohead']); ?>
				</select><br /><br />
				

				
				<h3>Colors</h3>
				
				<label for="primarycolors">Primary color(s)</label>
				<select id="primarycolors" name="primarycolors">
					<option value=""></option>
					<?php customDdown($colors); ?>
				</select>&nbsp;&nbsp;
				
				<label for="secondarycolors">Secondary color(s)</label>
				<select id="secondarycolors" name="secondarycolors">
					<option value=""></option>
					<?php customDdown($colors); ?>
				</select>
				
				<h3>Patterns & Marks</h3>
				
				<label for="patternsmarks">Patterns & Marks</label>
				<select id="patternsmarks" name="patternsmarks">
					<option value=""></option>
					<?php customDdown($visuals); ?>
				</select><br /><br />
				
				<h3>Eyes</h3>
				
				<label for="eyessizetohead">Eyes size relative to head</label>
				<select id="eyessizetohead" name="eyessizetohead">
					<option value=""></option>
					<?php customDdown($gnathostomata['eyes']['sizetohead']); ?>
				</select><br /><br />
				
				<label for="eyesposition">Eyes position</label>
				<select id="eyesposition" name="eyesposition">
					<option value=""></option>
					<?php customDdown($gnathostomata['eyes']['position']); ?>
				</select><br /><br />
				
				<h3>Lateral Lines</h3>
				
				<label for="laterallinesshape">Lateral Line</label>
				<select id="laterallinesshape" name="laterallinesshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['laterallines']['shape']); ?>
				</select><br /><br />	
				
				<h3>Operculum</h3>
				
				<label for="opercules">Opercules or Gill cover</label>
				<select id="opercules" name="opercules">
					<option value=""></option>
					<?php customDdown($gnathostomata['opercules']); ?>
				</select><br /><br />	
				
				<h3>Scales</h3>
				
				<label for="scalessize">Scale Size</label>
				<select id="scalessize" name="scalessize">
					<option value=""></option>
					<?php customDdown($gnathostomata['scales']['size']); ?>
				</select><br /><br />	
				
				<label for="scalestype">Scale Type</label>
				<select id="scalestype" name="scalestype">
					<option value=""></option>
					<?php customDdown($gnathostomata['scales']['type']); ?>
				</select><br /><br />	
				
				
				<h3>Fins</h3>
				
				<label for="dorsalfinshape">Dorsal fin shape (on the back)</label>
				<select id="dorsalfinshape" name="dorsalfinshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['fins']['dorsal']['shape']); ?>
				</select><br /><br />
				
				<label for="caudalfinshape">Caudal fin shape (tail)</label>
				<select id="caudalfinshape" name="caudalfinshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['fins']['caudal']['shape']); ?>
				</select><br /><br />
				
				<label for="analfinshape">Anal fin shape (on stomach before tail)</label>
				<select id="analfinshape" name="analfinshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['fins']['anal']['shape']); ?>
				</select><br /><br />
				
				<label for="pelvicfinshape">Pelvic fin shape (on the stomach closer to the head)</label>
				<select id="pelvicfinshape" name="pelvicfinshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['fins']['pelvic']['shape']); ?>
				</select><br /><br />
				
				<label for="pectoralfinshape">Pectoral fin shape (on the side near head)</label>
				<select id="pectoralfinshape" name="pectoralfinshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['fins']['pectoral']['shape']); ?>
				</select><br /><br />
				
				<label for="adiposefin">Is adipose fin present</label>
				<select id="adiposefin" name="adiposefin">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select><br /><br />
				
			</fieldset>
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Summary</legend>
				<label for="lifesummary">Write a summary of the lifeform, used for result display and classification display</label><br />
				<input id="lifesummary" name="lifesummary" type="textarea" /><br /><br />
				<label for="lifecontent">Full content of single page of the organism</label><br />
				<textarea name="lifecontent" id="lifecontent" class="lifecontent"></textarea>
			</fieldset>
		</div>
				<div class="form-group">
			<fieldset>
				<legend>Advanced Details</legend>
				
				<h3>Fins</h3>
				
				<h4>Dorsal Fin</h4>
				<label for="dorsalfinspines">Number of spines</label>
				<select id="dorsalfinspines" name="dorsalfinspines">
					<?php numDdown(15); ?>
				</select>
				<label for="dorsalfinrays">Number of rays</label>
				<select id="dorsalfinrays" name="dorsalfinrays">
					<?php numDdown(30); ?>
				</select><br />
								
				<h4>Caudal Fin</h4>
				<label for="caudalfinspines">Number of spines</label>
				<select id="caudalfinspines" name="caudalfinspines">
					<?php numDdown(15); ?>
				</select>
				<label for="caudalfinrays">Number of rays</label>
				<select id="caudalfinrays" name="caudalfinrays">
					<?php numDdown(30); ?>
				</select><br />
				
				<h4>Anal Fin</h4>
				<label for="analfinspines">Number of spines</label>
				<select id="analfinspines" name="analfinspines">
					<?php numDdown(15); ?>
				</select>
				<label for="analfinrays">Number of rays</label>
				<select id="analfinrays" name="analfinrays">
					<?php numDdown(30); ?>
				</select><br />
				
				<h4>Pelvic Fins</h4>
						
				<label for="pelvicfinsspines">Number of spines</label>
				<select id="pelvicfinsspines" name="pelvicfinsspines">
					<?php numDdown(15); ?>
				</select>
				<label for="pelvicfinsrays">Number of rays</label>
				<select id="pelvicfinsrays" name="pelvicfinsrays">
					<?php numDdown(30); ?>
				</select>
				<label for="pelvicfinsclaspers">Pelvic fins have claspers</label>
				<select id="pelvicfinsclaspers" name="pelvicfinsclaspers">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
				<label for="pelvicfinsfuseddisc">Disc, Pelvic fins are fused</label>
				<select id="pelvicfinsfuseddisc" name="pelvicfinsfuseddisc">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
				
				<br />
				
				<h4>Pectoral Fins</h4>
				<label for="pectoralfinspines">Number of spines</label>
				<select id="pectoralfinspines" name="pectoralfinspines">
					<?php numDdown(15); ?>
				</select>
				<label for="pectoralfinrays">Number of spines</label>
				<select id="pectoralfinrays" name="pectoralfinrays">
					<?php numDdown(30); ?>
				</select><br /><br />
				
			</fieldset>
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Media</legend>
				<p>Add images to the gallery</p>
				<input id="addimagefield" name="addimagefield" type="text"><br /><br />
				../filemanager/dialog.php?type=1&field_id=fieldID
				<a href="../filemanager/dialog.php?type=1&field_id=fieldID&fldr=/media/lifelib/animalia" class="btn iframe-btn" type="button">Open Filemanager</a>
				<!-- <a href="<?php echo ""; ?>" target="">See more images for <?php echo ""; ?> on Google Images</a> -->
			</fieldset>
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Links</legend>
				<p>Links to other databases of fishes</p>
				<label for="wikipedialink">On Wikipedia.org</label>
				<input id="wikipedialink" name="wikipedialink" type="text"><br /><br />
				<label for="fishbaselink">On Fishbase.org</label>
				<input id="fishbaselink" name="fishbaselink" type="text"><br /><br />
				<label for="wormslink">On WoRMS</label>
				<input id="wormslink" name="wormslink" type="text"><br /><br />
				<label for="itislink">On ITIS</label>
				<input id="itislink" name="itislink" type="text"><br /><br />
			</fieldset>
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Site related</legend>
				<p>SEO Stuff</p>
				<label for="metadesc">Meta description (160 chars)</label>
				<input id="metadesc" name="metadesc" type="textarea" />
				<label for="metakeys">Meta keywors (coma separated)</label>
				<input id="metakeys" name="metakeys" type="text" />
			</fieldset>
		</div>
		</form>
		</div>
		<div class="col-md-3">
			<?php include_once("adminnav.php"); ?>
		</div>
	</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea.lifecontent",
    plugins : [ "link, image, hr, anchor, pagebreak, media, wordcount, table, responsivefilemanager"],
    image_advtab: true,
	external_filemanager_path:"<?php echo BASE_URL; ?>plugins/filemanager/",
	filemanager_title:"Responsive Filemanager" ,
	external_plugins: { "filemanager" : "plugins/responsivefilemanager/plugin.min.js"}
 });
</script>
</div>
