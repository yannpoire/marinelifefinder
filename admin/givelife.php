<?php
	include_once "../common/base.php";
	$pageTitle = "Give life in the the DB to an organism";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.life.inc.php";
	include_once ROOT_PATH."inc/class.tree.inc.php";
	include_once ROOT_PATH."common/header.php";
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."common/forms.php";
	$treeObj = new MLFTree;
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
				<h2>Naming</h2>
				<legend>Common names</legend>
				<p>Enter the names of the organism</p>
				<label for="cname">Common Name*</label>
				<input id="cname" type="text" class="" required="required" autofocus="autofocus" /><br /><br />
				<label for="othercnames">Other common names</label>
				<input id="othercnames" type="text" class="" /><br /><br />
			</fieldset>			
		</div>
		<div class="form-group">
			<fieldset>
				<h2>Taxonomy & Classification</h2>
				<legend>Binomial of the organism</legend>
				<label for="binomial">Binomial*</label>&nbsp;&nbsp;
				<input id="binomialfirst" type="text" class="" />&nbsp;&nbsp;<input id="binomiallast" type="text" class="inline" /><br /><br />
				<p>Enter the genus or the closest taxon know</p>
				<select>
					<?php $treeObj->branchDdown("animalia"); ?>
				</select><br /><br />
			</fieldset>
		</div>
		
<!-- CONTENT -->

		<div class="form-group">
			<fieldset>
				<legend>Some text about the organism</legend>
				<label for="summary">Write a summary of the lifeform, used for result display and classification display</label><br />
				<input id="summary" name="summary" type="textarea" /><br /><br />
				<label for="content">Full content of single page of the organism</label><br />
				<textarea name="content" id="content" class="content"></textarea>
			</fieldset>
		</div>
		
<!-- FISHES -->	

		<div class="form-group fishgroup">
			<h2>Fishes</h2>
			<fieldset>
				<legend>Visual appearance and anatomy of fishes</legend>
				<p>Select visual clues of fishes</p>
				
<!-- VISUAL APPEARANCE -->	
				
				<h3>Visual Appearance</h3>
				
	<!--COLOR -->	
				
				<h4>Colors</h4>
				
				<label for="primarycolors">Primary color(s)</label>
				<select multiple="multiple" id="primarycolors" name="primarycolors">
					<option value=""></option>
					<?php customDdown($colors); ?>
				</select>&nbsp;&nbsp;
				
				<label for="secondarycolors">Secondary color(s)</label>
				<select multiple="multiple" id="secondarycolors" name="secondarycolors">
					<option value=""></option>
					<?php customDdown($colors); ?>
				</select>
				
				<h4>Patterns & Marks</h4>
				
				<label for="patternsmarks">Patterns & Marks</label>
				<select multiple="multiple" id="patternsmarks" name="patternsmarks">
					<option value=""></option>
					<?php customDdown($visuals); ?>
				</select><br /><br />
				
<!-- ANATOMY -->			

				<h3>Anatomy</h3>
				
	<!-- BODY -->				
	
				<h4>Body</h4>
				<label for="generalshape">General shape</label>
				<select multiple="multiple" id="generalshape" name="generalshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['generalshape']); ?>
				</select><br />
				
				<label for="size">Length (cm)</label>
				<input id="size" name="size" type="text" /><br /><br />
				
				<label for="bodyrings">Number of Rings in Pipefish and Seahorse(begin with the first ring/segment behind the anus it usually bears the anal fin)</label>
				<select id="bodyrings" name="bodyrings">
					<option value=""></option>
					<?php numDdown(20); ?>
				</select><br />
				
	<!-- VERTEBRAES -->				
	
				<h4>Vertebraes</h4>
				
				<label for="abvertebraes">Number of Abdominal Vertebraes</label>
				<select id="abvertebraes" name="abvertebraes">
					<option value=""></option>
					<?php numDdown(30); ?>
				</select><br />
				
				<label for="cavertebraes">Number of Caudal Vertebraes</label>
				<select id="cavertebraes" name="cavertebraes">
					<option value=""></option>
					<?php numDdown(30); ?>
				</select><br /><br />
				
	<!-- HEAD -->			
		
				<h4>Head</h4>
				
				<label for="headshape">Head shape</label>
				<select multiple="multiple" id="headshape" name="headshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['head']['shape']); ?>
				</select><br />
				
				<label for="headsizetobody">Head size relative to body</label>
				<select multiple="multiple" id="headsizetobody" name="headsizetobody">
					<option value=""></option>
					<?php customDdown($gnathostomata['head']['sizetobody']); ?>
				</select><br /><br />
				
	<!-- MOUTH -->			
		
				<h4>Mouth</h4>
				
				<label for="mouthshape">Mouth shape</label>
				<select multiple="multiple" id="mouthshape" name="mouthshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['mouth']['shape']); ?>
				</select><br />
				
				<label for="mouthposition">Mouth position</label>
				<select id="mouthposition" name="mouthposition">
					<option value=""></option>
					<?php customDdown($gnathostomata['mouth']['position']); ?>
				</select><br />
				
				<label for="mouthsizetohead">Mouth size relative to head</label>
				<select multiple="multiple" id="mouthsizetohead" name="mouthsizetohead">
					<option value=""></option>
					<?php customDdown($gnathostomata['mouth']['sizetohead']); ?>
				</select><br />
				
				<label for="mouthreltoeyes">Mouth ending relative to eye</label>
				<select id="mouthreltoeyes" name="mouthreltoeyes">
					<option value=""></option>
					<?php customDdown($gnathostomata['mouth']['reltoeyes']); ?>
				</select><br /><br />
				
				<label for="mouthteethvis">Teeth Visible (when mouth closed)</label>
				<select id="mouthteethvis" name="mouthteethvis">
					<option value=""></option>
					<option value="">No</option>
					<option value="">Yes</option>
				</select><br /><br />
				
	<!--EYES -->				
	
				<h3>Eyes</h3>
				
				<label for="eyessizetohead">Eyes size relative to head</label>
				<select multiple="multiple" id="eyessizetohead" name="eyessizetohead">
					<option value=""></option>
					<?php customDdown($gnathostomata['eyes']['sizetohead']); ?>
				</select><br />
				
				<label for="eyesposition">Eyes position</label>
				<select id="eyesposition" name="eyesposition">
					<option value=""></option>
					<?php customDdown($gnathostomata['eyes']['position']); ?>
				</select><br /><br />
				
	<!-- LATERAL LINE -->		
			
				<h3>Lateral Lines</h3>
				
				<label for="laterallinesshape">Lateral Line</label>
				<select id="laterallinesshape" name="laterallinesshape">
					<option value=""></option>
					<?php customDdown($gnathostomata['laterallines']['shape']); ?>
				</select><br />	
				
				<label for="laterallinespores">Number of lateral line pores</label>
				<select id="laterallinespores" name="laterallinespores">
					<option value=""></option>
					<?php numDdown(20); ?>
				</select><br /><br />	
				
	<!-- OPERCULUM -->
					
				<h3>Operculum, Holes, Slits</h3>
				
				<label for="operculums">Operculums or Gill Covers</label>
				<select id="operculums" name="operculums">
					<option value=""></option>
					<?php customDdown($gnathostomata['operculums']); ?>
				</select><br />
				
				<label for="holes">Holes is present</label>
				<select id="holes" name="holes">
					<option value=""></option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select><br /><br />	
				
				<label for="slits">Number of Slits if any</label>
				<select id="slits" name="slits">
					<option value=""></option>
					<?php numDdown(8); ?>
				</select><br />
				
	<!-- SCALES -->
				
				<h3>Scales</h3>
				
				<label for="scalessize">Scale Size</label>
				<select id="scalessize" name="scalessize">
					<option value=""></option>
					<?php customDdown($gnathostomata['scales']['size']); ?>
				</select><br />
				
				<label for="scalestype">Scale Type</label>
				<select id="scalestype" name="scalestype">
					<option value=""></option>
					<?php customDdown($gnathostomata['scales']['type']); ?>
				</select><br />
				
				<label for="lateralscales">Lateral or longitudinal Scale Count</label>
				<select id="lateralscales" name="lateralscales">
					<option value=""></option>
					<?php numDdown(50); ?>
				</select><br />
				
				<label for="traversescalesover">Top Traverse Scale Count (over lateral line)</label>
				<select id="traversescalesover" name="traversescalesover">
					<option value=""></option>
					<?php numDdown(30); ?>
				</select><br />
				
				<label for="traversescalesunder">Bottom Traverse Scale Count (under lateral line)</label>
				<select id="traversescalesunder" name="traversescalesunder">
					<option value=""></option>
					<?php numDdown(30); ?>
				</select><br />
				
				<label for="predorsalscales">Predorsal Scale Count (from top of head to first dorsal spine)</label>
				<select id="predorsalscales" name="predorsalscales">
					<option value=""></option>
					<?php numDdown(30); ?>
				</select><br /><br />		
				
	<!-- GILLS -->			
	
				<h3>Gill rakers</h3>
				
				<label for="upperarmrakers">Number of gill rakers on upper arm</label>
				<select id="upperarmrakers" name="upperarmrakers">
					<option value=""></option>
					<?php numDdown(20); ?>
				</select><br />
				
				<label for="lowerarmrakers">Number of gill rakers on upper arm</label>
				<select id="lowerarmrakers" name="lowerarmrakers">
					<option value=""></option>
					<?php numDdown(20); ?>
				</select><br /><br />
				
	<!-- FINS -->			
	
				<h3>Fins</h3>
				
	<!-- FINS DORSAL -->
				
				<h4>Dorsal Fin</h4>
				
					<label for="dorsalfinshape">Dorsal fin shape (on the back)</label>
					<select id="dorsalfinshape" name="dorsalfinshape">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['dorsal']['shape']); ?>
					</select><br />
					
					<label for="dorsalfinretractable">Dorsal fin shape (on the back)</label>
					<select id="dorsalfinretractable" name="dorsalfinretractable">
						<option value=""></option>
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select><br />
	
					<label for="dorsalfinspines">Number of spines</label>
					<select id="dorsalfinspines" name="dorsalfinspines">
						<?php numDdown(15); ?>
					</select>
					
					<label for="dorsalfinrays">Number of rays</label>
					<select id="dorsalfinrays" name="dorsalfinrays">
						<?php numDdown(30); ?>
					</select><br />
	
	<!-- FINS CAUDAL -->
				
				<h4>Caudal Fin</h4>
				
					<label for="caudalfinshape">Caudal fin shape (tail)</label>
					<select id="caudalfinshape" name="caudalfinshape">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['caudal']['shape']); ?>
					</select><br />
					
					<label for="caudalfintype">Caudal fin type (tail)</label>
					<select id="caudalfintype" name="caudalfintype">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['caudal']['type']); ?>
					</select><br />
					
					<label for="caudalfinspines">Number of spines</label>
					<select id="caudalfinspines" name="caudalfinspines">
						<option value=""></option>
						<?php numDdown(15); ?>
					</select>
					
					<label for="caudalfinrays">Number of rays</label>
					<select id="caudalfinrays" name="caudalfinrays">
						<option value=""></option>
						<?php numDdown(30); ?>
					</select><br />
	
	<!-- FINS ANAL -->
					
				<h4>Anal Fin</h4>
					<label for="analfinsshape">Anal fin shape (on stomach before tail)</label>
					<select id="analfinsshape" name="analfinsshape">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['anal']['shape']); ?>
					</select><br />
					<label for="analfinsspines">Number of spines</label>
					<select id="analfinsspines" name="analfinsspines">
						<?php numDdown(15); ?>
					</select>
					<label for="analfinsrays">Number of rays</label>
					<select id="analfinsrays" name="analfinsrays">
						<?php numDdown(30); ?>
					</select><br />
	
	<!-- FINS PELVIC -->
				
				<h4>Pelvic Fins</h4>
				
					<label for="pelvicfinshape">Pelvic fin shape (on the stomach closer to the head)</label>
					<select id="pelvicfinshape" name="pelvicfinshape">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['pelvic']['shape']); ?>
					</select><br />
							
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
					</select><br />
				
	<!-- FINS PECTORAL -->
				
				<h4>Pectoral Fins</h4>
					<label for="pectoralfinshape">Pectoral fin shape (on the side near head)</label>
					<select id="pectoralfinshape" name="pectoralfinshape">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['pectoral']['shape']); ?>
					</select><br />
					<label for="pectoralfinspines">Number of spines</label>
					<select id="pectoralfinspines" name="pectoralfinspines">
						<?php numDdown(15); ?>
					</select>
					<label for="pectoralfinrays">Number of spines</label>
					<select id="pectoralfinrays" name="pectoralfinrays">
						<?php numDdown(30); ?>
					</select><br />
					
	<!-- FINS ADIPOSE -->

				<h4>Adipose Fin</h4>
				<label for="adiposefin">Is adipose fin present</label>
				<select id="adiposefin" name="adiposefin">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select><br /><br />
				
			</fieldset>
		</div>
		

		
<!-- DISTRIBUTION & HABITAT -->

		<div class="form-group">
			<fieldset>
				<legend>Distribution</legend>
				<p>Global localization</p>
				<select multiple="multiple" id="oceans" name="oceans" type="text"><br /><br />
			</fieldset>
		</div>
		
		<div class="form-group">
			<fieldset>
				<legend>Distribution</legend>
				<p>Global localization</p>
				<select multiple="multiple" id="continent" name="continent" type="text"><br /><br />
			</fieldset>
		</div>
		
		<div class="form-group">
			<fieldset>
				<legend>Habitat</legend>
				<p>Where is it generally found</p>
				<select multiple="multiple" id="continent" name="continent" type="text"><br /><br />
			</fieldset>
		</div>
		
<!-- BEHAVIOR -->
		
		<div class="form-group">
			<fieldset>
				<legend>Schooling and banding</legend>
				<p>If solitary or grouped</p>
				<select multiple="multiple" id="continent" name="continent" type="text"><br /><br />
			</fieldset>
		</div>
		
		<div class="form-group">
			<fieldset>
				<legend>Motion and mouvement</legend>
				<p>How is the fish moving and what part is he using</p>
				<select multiple="multiple" id="continent" name="continent" type="text"><br /><br />
			</fieldset>
		</div>
		
		<div class="form-group">
			<fieldset>
				<legend>Diet</legend>
				<p>Sources of food</p>
				<select multiple="multiple" id="continent" name="continent" type="text"><br /><br />
			</fieldset>
		</div>
		
		<div class="form-group">
			<fieldset>
				<legend>Courting behaviors</legend>
				<p>What are the courting or mating behaviors</p>
				<select multiple="multiple" id="continent" name="continent" type="text"><br /><br />
			</fieldset>
		</div>
	
<!-- MEDIAS -->	
		
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
		
<!-- LINKS -->

		<div class="form-group">
			<fieldset>
				<legend>Links</legend>
				<p>Links to other databases of fishes</p>

				<label for="fishbaselink">On Fishbase.org</label>
				<input id="fishbaselink" name="fishbaselink" type="text"><br />
				<label for="wikipedialink">On Wikipedia.org</label>
				<input id="wikipedialink" name="wikipedialink" type="text"><br />
				<label for="wormslink">On WoRMS</label>
				<input id="wormslink" name="wormslink" type="text"><br />
				<label for="itislink">On ITIS</label>
				<input id="itislink" name="itislink" type="text"><br /><br />
			</fieldset>
		</div>
		
<!-- SEO -->		
		
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
	external_filemanager_path:"../plugins/filemanager/",
	filemanager_title:"Responsive Filemanager" ,
	external_plugins: { "filemanager" : "plugins/responsivefilemanager/plugin.min.js"}
 });
</script>
</div>
