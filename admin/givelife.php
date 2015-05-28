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
				<label for="commonname">Common Name*</label><br />
				<input id="commonname" type="text" class="" required="required" autofocus="autofocus" /><br /><br />
				<label for="binomial">Binomial*</label><br />
				<input id="binomialfirst" type="text" class="" />&nbsp;&nbsp;<input id="binomiallast" type="text" class="inline" /><br /><br />
				<label for="othercommonname">Other common names</label><br />
				<input id="othercommonname" type="text" class="" /><br /><br />
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
				
				<label for="generalshape">General shape</label>
				<select id="generalshape" name="generalshape">
					<option value=""></option>
					<?php customDdown($fish['generalshape']); ?>
				</select><br /><br />
				
				<label for="headshape">Head shape</label>
				<select id="headshape" name="headshape">
					<option value=""></option>
					<?php customDdown($fish['headshape']); ?>
				</select><br /><br />
				
				<label for="mouthshape">Mouth shape</label>
				<select id="mouthshape" name="mouthshape">
					<option value=""></option>
					<?php customDdown($fish['mouthshape']); ?>
				</select><br /><br />
				
				<h3>Colors</h3>
				
				<label for="primarycolors">Primary color(s)</label>
				<select id="primarycolors" name="primarycolors">
					<?php customDdown($colors); ?>
				</select>
				
				<label for="secondarycolors">Secondary color(s)</label>
				<select id="secondarycolors" name="secondarycolors">
					<?php customDdown($colors); ?>
				</select>
				
				<h3>Patterns & Marks</h3>
				
				<label for="patternsmarks">Patterns & Marks</label>
				<select id="patternsmarks" name="patternsmarks">
					<?php customDdown($visuals); ?>
				</select>
				
				<h3>Fins</h3>
				
				<label for="dorsalfinshape">Dorsal fin shape (on the back)</label>
				<select id="dorsalfinshape" name="dorsalfinshape">
					<option value=""></option>
					<?php customDdown($fish['fins']['dorsal']['shape']); ?>
				</select><br /><br />
				
				<label for="adiposefinshape">Adipose fin shape (on the back between dorsal and tail)</label>
				<select id="adiposefinshape" name="adiposefinshape">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select><br /><br />
				
				<label for="caudalfinshape">Caudal fin shape (tail)</label>
				<select id="caudalfinshape" name="caudalfinshape">
					<option value=""></option>
					<?php customDdown($fish['fins']['caudal']['shape']); ?>
				</select><br /><br />
				
				<label for="analfinshape">Anal fin shape (on stomach before tail)</label>
				<select id="analfinshape" name="analfinshape">
					<option value=""></option>
					<?php customDdown($fish['fins']['anal']['shape']); ?>
				</select><br /><br />
				
				<label for="pelvicfinshape">Pelvic fin shape (on the stomach closer to the head)</label>
				<select id="pelvicfinshape" name="pelvicfinshape">
					<option value=""></option>
					<?php customDdown($fish['fins']['pelvic']['shape']); ?>
				</select><br /><br />
				
				<label for="pectoralfinshape">Pectoral fin shape (on the side near head)</label>
				<select id="pectoralfinshape" name="pectoralfinshape">
					<option value=""></option>
					<?php customDdown($fish['fins']['pectoral']['shape']); ?>
				</select><br /><br />
				
				<h4>Adipose Fin (not present most species and has no spine)</h4>
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
				<label for="summary">Write a summary of the lifeform</label><br />
				<input id="summary" name="summary" type="text" />
			</fieldset>
		</div>
				<div class="form-group">
			<fieldset>
				<legend>Advanced Details</legend>
				
				<h3>Fins</h3>
				
				<h4>Dorsal Fin</h4>
				<label for="dorsalfinspines">Number of dorsal fin spines</label>
				<select id="dorsalfinspines" name="dorsalfinspines">
					<?php numDdown(15); ?>
				</select>
				<label for="dorsalfinrays">Number of dorsal fin rays</label>
				<select id="dorsalfinrays" name="dorsalfinrays">
					<?php numDdown(30); ?>
				</select><br /><br />
								
				<h4>Caudal Fin</h4>
				<label for="caudalfinspines">Number of caudal fin spines</label>
				<select id="caudalfinspines" name="caudalfinspines">
					<?php numDdown(15); ?>
				</select>
				<label for="caudalfinrays">Number of caudal fin rays</label>
				<select id="caudalfinrays" name="caudalfinrays">
					<?php numDdown(30); ?>
				</select><br /><br />
				
				<h4>Anal Fin</h4>
				<label for="analfinspines">Number of anal fin spines</label>
				<select id="analfinspines" name="analfinspines">
					<?php numDdown(15); ?>
				</select>
				<label for="analfinrays">Number of anal fin rays</label>
				<select id="analfinrays" name="analfinrays">
					<?php numDdown(30); ?>
				</select><br /><br />
				
				<h4>Pelvic Fins</h4>				
				<label for="pelvicfinspines">Number of pelvic fin spines</label>
				<select id="pelvicfinspines" name="pelvicfinspines">
					<?php numDdown(15); ?>
				</select>
				<label for="pelvicfinrays">Number of pelvic fin rays</label>
				<select id="pelvicfinrays" name="pelvicfinrays">
					<?php numDdown(30); ?>
				</select>
				<label for="pelvicfinclaspers">Pelvic fins have claspers</label>
				<select id="pelvicfinclaspers" name="pelvicfinclaspers">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
				
				<br /><br />
				
				<h4>Pectoral Fins</h4>
				<label for="pectoralfinspines">Number of pectoral fin spines</label>
				<select id="pectoralfinspines" name="pectoralfinspines">
					<?php numDdown(15); ?>
				</select>
				<label for="pectoralfinrays">Number of pectoral fin spines</label>
				<select id="pectoralfinrays" name="pectoralfinrays">
					<?php numDdown(30); ?>
				</select><br /><br />
				
			</fieldset>
		</div>
		<div class="form-group">
			<fieldset>
				<legend>Media</legend>
				<p>Add images to the gallery</p>
				<input id="addimagefield" name="addimage" type="text"><br /><br />
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
</div>
