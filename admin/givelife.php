<?php
	include_once "../common/base.php";
	$pageTitle = "Give life in the the DB to an organism";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.life.inc.php";
	include_once ROOT_PATH."inc/class.tree.inc.php";
	include_once ROOT_PATH."common/header.php";

	include_once ROOT_PATH."common/forms.php";
	$lifeObj = new MLFLife;
	$treeObj = new MLFTree;
?>
</head>
<body>
<?php 
	include_once ROOT_PATH."common/mainnav.php";
	if(isset($_GET['status']) && $_GET['status']==1) {
		$msg = "Success! The branch sprouted from the tree!";
		timedMsg($msg, "success");
	}
?>
<div class="container">
	<div class="row">
		<h1>Enter a new lifeform in the directory</h1>
		<p>Select desired criterias from the form. It can later be modified from within the page of the lifeform.</p>
		<p>Fields marked with an asterisk * are mandatory.</p>
	</div>
	<div class="row">
		<div class="col-md-9">
		<div id="tabs" class="form-style">
			
			<ul class="tablist">
				<li><a href="#generaldetails-tab">General Details</a></li>
				<li><a href="#appearance-tab">Appearance</a></li>
				<li><a href="#anatomy-tab">Anatomy</a></li>
				<li><a href="#behavior-tab">Behavior</a></li>
				<li><a href="#habitat-tab">Habitat</a></li>
				<li><a href="#distribution-tab">Distribution</a></li>
				<li><a href="#medias-tab">Medias</a></li>
				<li><a href="#links-tab">Links</a></li>
				<li><a href="#seo-tab">SEO</a></li>
			</ul>
			
		<form method="post" action="../db-interaction/life.php" role="form">
			<input id="action" name="action" type="hidden" value="createlife" />
			
			<div id="generaldetails-tab">
				<fieldset>
				<legend>Group*</legend>
				
					<select id="lifegroup" name="lifegroup">
						<?php customDdown($lifegroups); ?>
					</select>
					
				</fieldset>
				
				<fieldset>
				<legend>Common names</legend>
				
					<p>Enter the names of the organism</p>
					<label for="cname">Common Name*</label>
					<input id="cname" name="cname" type="text" class="" required="required" autofocus="autofocus" />
					<label for="othercnames">Other common names</label>
					<input id="othercnames" name="othercnames" type="text" class="" />
					<label for="familycname">Family Common Name</label>
					<select id="familycname" name="familycname">
						<option value=""></option>
						<?php customDdown($gnathostomata['familycname']);  ?>
					</select>
				
				</fieldset>
				
				
				<fieldset>
				<legend>Taxonomy & Classification</legend>
					
					<label for="fbinomialfirst">Binomial First & Last Name</label>
					<input id="binomialfirst" name="binomialfirst" type="text" placeholder="First Name" required="required" class="half-width" />
					<input id="binomiallast" name="binomiallast" type="text" placeholder="Last Name" required="required" class="half-width" />
					<p>Enter the genus or the closest taxon, clade, rank known</p>
					<label for="classification">Taxon, Clade, Rank</label>
					<select id="classification" name="classification">
						<option value="undefined">Not defined yet</option>
						<?php $treeObj->branchDdown("animalia"); ?>
					</select>
				
				</fieldset>
				
	<!-- CONTENT -->

				<fieldset>
					<legend>General Informations</legend>
					<label for="summary">Write a summary of the lifeform, used for result display and classification display</label>
					<textarea id="summary" name="summary"></textarea>
					<label for="content">Full content of single page of the organism</label>
					<textarea name="content" id="content" class="content" rows="15"></textarea>
				</fieldset>
				
						
			</div>
			
	<!-- FISHES -->
			
		<div class="fishsection">
			
			<div id="appearance-tab">
				
				<fieldset>
				<legend>Visual appearance and anatomy of fishes</legend>
					<p>Basic visual identification keys</p>
					
					<p>Some fishes completely morph from the juvenile stage to the mature stage eg: platax teira. They can look like two completely distinct and unrelated species. Details about juvenile state can be added for some fields that are variable.</p>
					<p>Other fishes like the barred parrotfish have distinct colors for each sex</p>
					
					<input id="juvdistinct" name="juvdistinct" type="checkbox" class="tiny-width"/>
					<label for="juvdistinct" class="tiny-width">Has distinct juvenile stage</label><br />
					
					<input id="femdistinct" name="femdistinct" type="checkbox"  class="tiny-width"/>
					<label for="femdistinct" class="tiny-width">Has distinct sex appearance</label>
					
				</fieldset>
					
				<fieldset>
				<legend>Colors</legend>
					
					<label for="primarycolors">Primary color(s)</label>
					<select id="primarycolors" name="primarycolors" multiple="multiple" class="multiple half-width">
						<option value=""></option>
						<?php customDdown($colors); ?>
					</select>
					<label for="secondarycolors">Secondary color(s)</label>
					<select id="secondarycolors" name="secondarycolors" multiple="multiple" class="multiple half-width">
						<option value=""></option>
						<?php customDdown($colors); ?>
					</select>
				
				</fieldset>
				
				<fieldset>
				<legend>Patterns & Markings</legend>
					<label for="patternsmarks">Patterns & Marks</label>
					<select id="patternsmarks" name="patternsmarks" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($visuals); ?>
					</select>	
				</fieldset>
				
				<fieldset>
				<legend>General body shape</legend>
				
					<label for="generalshape">General shape</label>
					<select id="generalshape" name="generalshape" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['generalshape']); ?>
					</select>
					
					<p>Size is the average length of a full growth adult.</p>
					<label for="size" class="tiny-width">Length (cm)</label>
					<input id="size" name="size" type="text" class="tiny-width" /><span>cm</span>
					
					<p>Pipefish and Seahorse and such It begins with the first ring/segment behind the anus it
						usually bears the anal fin</p>
					<label for="bodyrings" class="tiny-width">Number of Rings</label>
					<select id="bodyrings" name="bodyrings" class="tiny-width">
						<option value=""></option>
						<?php numDdown(20); ?>
					</select><br />
				
				</fieldset>
				
				<div class="juvenileform">
				
				<fieldset>
				<legend>Colors for juvenile form</legend>
					
					<label for="juvprimarycolors">Primary color(s) of juvenile</label><br />
					<select id="juvprimarycolors" name="juvprimarycolors" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($colors); ?>
					</select>
					
					<label for="juvsecondarycolors">Secondary color(s) of juvenile</label><br />
					<select id="juvsecondarycolors" name="juvsecondarycolors" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($colors); ?>
					</select>
				
				</fieldset>
				
				<fieldset>
				<legend>Patterns & Markings of juvenile form</legend>
					
					<label for="juvpatternsmarks">Patterns & Marks of juvenile</label>
					<select id="juvpatternsmarks" name="juvpatternsmarks" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($visuals); ?>
					</select>
					
				</fieldset>
				
				<fieldset>
				<legend>General body shape of juvenile form</legend>
				
					<label for="juvgeneralshape">General shape of juvenile</label>
					<select id="juvgeneralshape" name="juvgeneralshape" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['generalshape']); ?>
					</select>
				
				</fieldset>
				
				</div>
				
				<div class="female">
				
				<fieldset>
				<legend>Colors for female</legend>
					
					<label for="femprimarycolors">Primary color(s) of female</label><br />
					<select id="femprimarycolors" name="femprimarycolors" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($colors); ?>
					</select>
					
					<label for="femsecondarycolors">Secondary color(s) of female</label><br />
					<select id="femsecondarycolors" name="femsecondarycolors" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($colors); ?>
					</select>
				
				</fieldset>
				
				<fieldset>
				<legend>Patterns & Markings of female</legend>
					
					<label for="fempatternsmarks">Patterns & Marks of female</label>
					<select id="fempatternsmarks" name="fempatternsmarks" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($visuals); ?>
					</select>
					
				</fieldset>
				
				<fieldset>
				<legend>General body shape of female</legend>
				
					<label for="femgeneralshape">General shape of female</label>
					<select id="femgeneralshape" name="femgeneralshape" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['generalshape']); ?>
					</select>
				
				</fieldset>
				
				</div>
				
			</div>			
			
			<div id="anatomy-tab">
				
				<!-- HEAD -->			
				
				<fieldset>
				<legend>Head</legend>
					
					<label for="headshape">Head shape</label>
					<select id="headshape" name="headshape" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['head']['shape']); ?>
					</select>
					
					<label for="headsizetobody">Head size relative to body</label>
					<select id="headsizetobody" name="headsizetobody" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['head']['sizetobody']); ?>
					</select>
				
				</fieldset>
				
	<!-- MOUTH -->
	
				<fieldset>
				<legend>Mouth</legend>		
				
					<label for="mouthshape">Mouth shape</label>
					<select id="mouthshape" name="mouthshape"  multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['mouth']['shape']); ?>
					</select>
					
					<label for="mouthposition">Mouth position</label>
					<select id="mouthposition" name="mouthposition">
						<option value=""></option>
						<?php customDdown($gnathostomata['mouth']['position']); ?>
					</select>
					
					<label for="mouthsizetohead">Mouth size relative to head</label>
					<select id="mouthsizetohead" name="mouthsizetohead" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['mouth']['sizetohead']); ?>
					</select>
				
					<label for="mouthreltoeyes">Mouth ending relative to eye</label>
					<select id="mouthreltoeyes" name="mouthreltoeyes">
						<option value=""></option>
						<?php customDdown($gnathostomata['mouth']['reltoeyes']); ?>
					</select>
					
					<label for="mouthteethvis"  class="tiny-width">Teeth Visible (when mouth closed)</label>
					<select id="mouthteethvis" name="mouthteethvis" class="tiny-width">
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select>
					
				</fieldset>
				
	<!--EYES -->				
	
				<fieldset>
				<legend>Eyes</legend>
				
					<label for="eyessizetohead">Eyes size relative to head</label>
					<select id="eyessizetohead" name="eyessizetohead" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['eyes']['sizetohead']); ?>
					</select>
					
					<label for="eyesposition">Eyes position</label>
					<select id="eyesposition" name="eyesposition">
						<option value=""></option>
						<?php customDdown($gnathostomata['eyes']['position']); ?>
					</select>
				
				</fieldset>
				
	<!-- LATERAL LINE -->		
			
				<fieldset>
				<legend>Lateral Line</legend>
				
					<label for="laterallinesshape">Lateral Line shape</label>
					<select id="laterallinesshape" name="laterallinesshape">
						<option value=""></option>
						<?php customDdown($gnathostomata['laterallines']['shape']); ?>
					</select>
					
					<label for="laterallinespores" class="tiny-width">Number of lateral line pores</label>
					<select id="laterallinespores" name="laterallinespores" class="tiny-width">
						<option value=""></option>
						<?php numDdown(20); ?>
					</select>
					
				</fieldset>
				
	<!-- OPERCULUM -->
					
				<fieldset>
				<legend>Operculums, Gills Opening, Slits</legend>
				
					<label for="operculums">Operculums or Gill Covers</label>
					<select id="operculums" name="operculums" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['operculums']); ?>
					</select>
					
					<label for="holes" class="tiny-width">Holes are present instead</label>
					<select id="holes" name="holes" class="tiny-width">
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select><br />
					
					<label for="slits">Number of Slits if any</label>
					<select id="slits" name="slits">
						<option value=""></option>
						<?php numDdown(8); ?>
					</select>
					
				</fieldset>
				
	<!-- SCALES -->
				
				<fieldset>
				<legend>Scales</legend>
				
					<label for="scalessize">Scale Size</label>
					<select id="scalessize" name="scalessize" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['scales']['size']); ?>
					</select>
					
					<label for="scalestype">Scale Type</label>
					<select id="scalestype" name="scalestype">
						<option value=""></option>
						<?php customDdown($gnathostomata['scales']['type']); ?>
					</select>
					
					<label for="lateralscales" class="tiny-width">Lateral or longitudinal Scale Count</label>
					<select id="lateralscales" name="lateralscales" class="tiny-width">
						<option value=""></option>
						<?php numDdown(50); ?>
					</select>
					
					<label for="traversescalesover" class="tiny-width">Top Traverse Scale Count (over lateral line)</label>
					<select id="traversescalesover" name="traversescalesover" class="tiny-width">
						<option value=""></option>
						<?php numDdown(30); ?>
					</select>
					
					<label for="traversescalesunder" class="tiny-width">Bottom Traverse Scale Count (under lateral line)</label>
					<select id="traversescalesunder" name="traversescalesunder" class="tiny-width">
						<option value=""></option>
						<?php numDdown(30); ?>
					</select>
					
					<label for="predorsalscales" class="tiny-width">Predorsal Scale Count (from top of head to first dorsal spine)</label>
					<select id="predorsalscales" name="predorsalscales" class="tiny-width">
						<option value=""></option>
						<?php numDdown(30); ?>
					</select>
					
				</fieldset>	
				
	<!-- GILLS -->
	
				<fieldset>
				<legend>Gills Rakers</legend>		
				
					<label for="upperarmrakers" class="tiny-width">Number of gill rakers on upper arm</label>
					<select id="upperarmrakers" name="upperarmrakers" class="tiny-width">
						<option value=""></option>
						<?php numDdown(20); ?>
					</select><br />
					
					<label for="lowerarmrakers" class="tiny-width">Number of gill rakers on upper arm</label>
					<select id="lowerarmrakers" name="lowerarmrakers" class="tiny-width">
						<option value=""></option>
						<?php numDdown(20); ?>
					</select>
					
				</fieldset>
				
	<!-- FINS -->			
	
				<h3>Fins</h3>
				
	<!-- FINS DORSAL -->
				
				<fieldset>
				<legend>Dorsal Fin</legend>
				
					<label for="dorsalfinshape">Dorsal fin shape</label>
					<select id="dorsalfinshape" name="dorsalfinshape" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['dorsal']['shape']); ?>
					</select>
					
					<label for="dorsalfinpatterns">Dorsal fin patterns</label>
					<select id="dorsalfinpatterns" name="dorsalfinpatterns" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['dorsal']['patterns']); ?>
					</select>
					
					<label for="dorsalfinsplit">Dorsal is split in</label>
					<select id="dorsalfinsplit" name="dorsalfinsplit">
						<option val="0">0 not splitted</option>
						<option val="0">2</option>
						<option val="0">3</option>
					</select>
					
					<label for="dorsalfinretractable" class="tiny-width">Dorsal fin is retractable</label>
					<select id="dorsalfinretractable" name="dorsalfinretractable" class="tiny-width">
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select><br />
	
					<label for="dorsalfinspines" class="tiny-width">Number of spines</label>
					<select id="dorsalfinspines" name="dorsalfinspines" class="tiny-width">
						<?php numDdown(15); ?>
					</select><br />
					
					<label for="dorsalfinrays" class="tiny-width">Number of rays</label>
					<select id="dorsalfinrays" name="dorsalfinrays" class="tiny-width">
						<?php numDdown(30); ?>
					</select>
					
				</fieldset>
	
	<!-- FINS CAUDAL -->
				
				<fieldset>
				<legend>Caudal Fin</legend>
				
					<label for="caudalfinshape">Caudal fin shape (tail)</label>
					<select id="caudalfinshape" name="caudalfinshape" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['caudal']['shape']); ?>
					</select>
					
					<label for="caudalfintype">Caudal fin type (tail)</label>
					<select id="caudalfintype" name="caudalfintype">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['caudal']['type']); ?>
					</select>
					
					<label for="caudalfinpatterns">Caudal fin patterns</label>
					<select id="caudalfinpatterns" name="caudalfinpatterns" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['caudal']['patterns']); ?>
					</select>
					
					<label for="caudalfinspines" class="tiny-width">Number of spines</label>
					<select id="caudalfinspines" name="caudalfinspines" class="tiny-width">
						<option value=""></option>
						<?php numDdown(15); ?>
					</select><br />
					
					<label for="caudalfinrays" class="tiny-width">Number of rays</label>
					<select id="caudalfinrays" name="caudalfinrays" class="tiny-width">
						<option value=""></option>
						<?php numDdown(30); ?>
					</select>
					
				</fieldset>
	
	<!-- FINS ANAL -->
	
				<fieldset>
				<legend>Anal Fin</legend>

					<label for="analfinshape">Anal fin shape</label>
					<select id="analfinshape" name="analfinshape" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['anal']['shape']); ?>
					</select>
					
					<select id="analfinpatterns" name="analfinpatterns" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['anal']['patterns']); ?>
					</select>
					
					<label for="analfinsspines" class="tiny-width">Number of spines</label>
					<select id="analfinsspines" name="analfinsspines" class="tiny-width">
						<?php numDdown(15); ?>
					</select><br />
					
					<label for="analfinsrays" class="tiny-width">Number of rays</label>
					<select id="analfinsrays" name="analfinsrays" class="tiny-width">
						<?php numDdown(30); ?>
					</select>
					
				</fieldset>
	
	<!-- FINS PELVIC -->
	
				<fieldset>
				<legend>Pelvic Fins</legend>
				
					<label for="pelvicfinsshape">Pelvic fin shape</label>
					<select id="pelvicfinsshape" name="pelvicfinsshape" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['pelvic']['shape']); ?>
					</select>
					
					<label for="pelvicfinspatterns">Pelvic fin patterns</label>
					<select id="pelvicfinspatterns" name="pelvicfinspatterns" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['pelvic']['patterns']); ?>
					</select>
							
					<label for="pelvicfinsspines" class="tiny-width">Number of spines</label>
					<select id="pelvicfinsspines" name="pelvicfinsspines" class="tiny-width">
						<?php numDdown(15); ?><br />
					</select>
					
					<label for="pelvicfinsrays" class="tiny-width">Number of rays</label>
					<select id="pelvicfinsrays" name="pelvicfinsrays" class="tiny-width">
						<?php numDdown(30); ?>
					</select><br />
					
					<label for="pelvicfinsclaspers" class="tiny-width">Pelvic fins have claspers</label>
					<select id="pelvicfinsclaspers" name="pelvicfinsclaspers" class="tiny-width">
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select><br />
					
					<label for="pelvicfinsfuseddisc" class="tiny-width">Disc, Pelvic fins are fused</label>
					<select id="pelvicfinsfuseddisc" name="pelvicfinsfuseddisc" class="tiny-width">
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select>
					
				</fieldset>
				
	<!-- FINS PECTORAL -->
	
				<fieldset>
				<legend>Pectoral Fins</legend>

					<label for="pectoralfinsshape">Pectoral fin shape (on the side near head)</label>
					<select id="pectoralfinsshape" name="pectoralfinsshape" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['pectoral']['shape']); ?>
					</select>
					
					<label for="pectoralfinspatterns">Pectoral fin patterns or marks</label>
					<select id="pectoralfinspatterns" name="pectoralfinspatterns" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['fins']['pectoral']['patterns']); ?>
					</select>

					<label for="pectoralfinsspines" class="tiny-width">Number of spines</label>
					<select id="pectoralfinsspines" name="pectoralfinsspines" class="tiny-width">
						<?php numDdown(15); ?>
					</select><br />
					
					<label for="pectoralfinsrays" class="tiny-width">Number of spines</label>
					<select id="pectoralfinsrays" name="pectoralfinsrays" class="tiny-width">
						<?php numDdown(30); ?>
					</select>
					
				</fieldset>
					
	<!-- FINS ADIPOSE -->
	
				<fieldset>
				<legend>Adipose Fin</legend>

					<label for="adiposefin" class="tiny-width">Is adipose fin present</label>
					<select id="adiposefin" name="adiposefin" class="tiny-width">
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select>
				
				</fieldset>
				
	<!-- VERTEBRAES -->				
	
				<fieldset>
				<legend>Vertebraes</legend>
				
					<label for="abvertebraes" class="tiny-width">Number of Abdominal Vertebraes</label>
					<select id="abvertebraes" name="abvertebraes" class="tiny-width">
						<option value=""></option>
						<?php numDdown(30); ?>
					</select><br />
				
					<label for="cavertebraes" class="tiny-width">Number of Caudal Vertebraes</label>
					<select id="cavertebraes" name="cavertebraes" class="tiny-width">
						<option value=""></option>
						<?php numDdown(30); ?>
					</select>
			
			</div>
			
			<div id="behavior-tab">
				
	<!-- BEHAVIOR -->

				<fieldset>
				<legend>Schooling and banding</legend>
				
					<p>If solitary or grouped</p>
					
					<label for="schoolingsize">Size of schools or groups</label>
					<select id="schoolingsize" name="schoolingsize" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['behavior']['schooling']['size']); ?>
					</select>
					
					<label for="schoolingdensity">Density of schools or groups</label>
					<select id="schoolingdensity" name="schoolingdensity" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['behavior']['schooling']['size']); ?>
					</select>
					
				</fieldset>

				<fieldset>
				<legend>Motion and mouvement</legend>
					
					<p>How is the fish moving and what fins is he using</p>
					<label for="motion">Motion</label>
					<select id="motion" name="motion" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['behavior']['motion']) ?>
					</select>

				</fieldset>
			
				<fieldset>
				<legend>Diet</legend>
					
					<p>Sources of food</p>
					<label for="diet">Diet what it feeds on</label>
					<select id="diet" name="diet" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['behavior']['diet']) ?>
					</select>

					<label for="feeding">Ways of acquiring food</label>
					<select id="feeding" name="feeding" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['behavior']['feeding']) ?>
					</select>

				</fieldset>
				
				<fieldset>
				<legend>Time active</legend>	
				
					<label for="timeactive">Time most active, feeding, hunting</label>
					<select id="timeactive" name="timeactive" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['behavior']['timeactive']) ?>
					</select>
					
				</fieldset>
			
				<fieldset>
				<legend>Courting behaviors</legend>
				
					<p>Some species have very specific mating rituals</p>
					
					<label for="courting">What are the courting or mating behaviors</label>
					<textarea id="courting" name="courting" rows="6" cols="50"></textarea>
					
				</fieldset>
				
				<fieldset>
				<legend>Other special or distinctive behavior description</legend>
				
					<label for="specialbehavior">Behaviors descriptions</label>
					<textarea id="specialbehavior" name="specialbehavior" rows="6" cols="50"></textarea>
					
				</fieldset>
				
			</div>
			
			<div id="habitat-tab">
				
	<!-- HABITAT -->
				
				<fieldset>
				<legend>Habitat</legend>
					
					<p>Where is this fish mostly found</p>
					
					<label for="habitat">Habitat</label>
					<select id="habitat" name="habitat" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($gnathostomata['habitat']) ?>
					</select>
					
					<p>Where the fish lives in the water column</p>
					
					<label for="habitattype">Habitat type</label>
					<select id="habitattype" name="habitattype">
						<option value=""></option>
						<?php customDdown($gnathostomata['habitattype']) ?>
					</select>
					
					<p>Is this fish a migratory species and if so when does they migrate</p>
					<label for="migratory" class="tiny-width">Migratory species</label>
					<select id="migratory" name="migratory" class="tiny-width" />
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select>
					
					<p>Migratory period</p>
					
					<label for="migratorystart">Migration start about</label>
					<select id="migratorystart" name="migratorystart">
						<option value=""></option>
						<?php customDdown($months) ?>
					</select>
					
					<label for="migratoryend">To the month of</label>
					<select id="migratoryend" name="migratoryend">
						<option value=""></option>
						<?php customDdown($months) ?>
					</select>

				</fieldset>
		
				
			</div>
		
		</div>
			
			<div id="distribution-tab">
				
	<!-- DISTRIBUTION -->

				<fieldset>
				<legend>Water Bodies Distribution</legend>
					
					<p>Global localization in water bodies, oceans, seas or land access with continents, regions or countries</p>
					
					<label for="oceans">Oceans</label>
					<select multiple="multiple" id="oceans" name="oceans" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($oceans); ?>
					</select>
					
					<label for="seas">Seas</label>
					<select multiple="multiple" id="seas" name="seas" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($seas); ?>
					</select>
					
				</fieldset>
				
				<fieldset>
				<legend>Geographical</legend>
					
					<label for="continents">Continents</label>
					<select id="continents" name="continents" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($distribution['continents']); ?>
					</select>
					
					<label for="regions">Regions</label>
					<select id="regions" name="regions" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($distribution['regions']); ?>
					</select>
					
					<label for="regions">Countries</label>
					<select id="countries" name="countries" multiple="multiple" class="multiple">
						<option value=""></option>
						<?php customDdown($distribution['countries']); ?>
					</select>
					
				</fieldset>
				
			</div>
			
			<div id="medias-tab">
				
				<!-- MEDIAS -->	
		
				<fieldset>
				<legend>Images</legend>
				
					<p>Add images to the gallery</p>
					
					<input id="addimagefield" name="addimagefield" type="text">
					
					<a href="../filemanager/dialog.php?type=1&field_id=fieldID&fldr=/media/lifelib/animalia"
						class="btn iframe-btn" type="button">Open Filemanager</a>
					
				</fieldset>
				
			</div>
			
			<div id="links-tab">
				
				<div class="fishsection">
					
					<!-- LINKS -->

					<fieldset>
					<legend>Links</legend>
					
						<p>Links to other databases of fishes</p>
		
						<label for="fishbaselink">On Fishbase.org</label>
						<input id="fishbaselink" name="fishbaselink" placeholder="http://www.fishbase.org/" type="text">

						<label for="wikipedialink">On Wikipedia.org</label>
						<input id="wikipedialink" name="wikipedialink" placeholder="http://www.wikipedia.com/" type="text">

						<label for="wormslink">On WoRMS</label>
						<input id="wormslink" name="wormslink" placeholder="http://" type="text">

						<label for="itislink">On ITIS</label>
						<input id="itislink" name="itislink" placeholder="http://" type="text">

					</fieldset>
					
				</div>
				
			</div>
			
			<div id="seo-tab">
				
	<!-- SEO -->		
				
				<fieldset>
				<legend>SEO and Site related</legend>
					
					<p>SEO Stuff</p>
					
					<label for="uniqueurl">Unique URL</label>
					<input id="uniqueurl" name="uniqueurl" type="text" />
					
					<label for="metadesc">Meta description (160 chars)</label>
					<textarea id="metadesc" name="metadesc" /></textarea>
					
					<label for="metakeys">Meta keywords (coma separated)</label>
					<input id="metakeys" name="metakeys" type="text" />
				
				</fieldset>
				
			</div>
		
		
		
		</div>
	
	</div>
		
	

		<div class="col-md-3">
			<input type="submit" id="createlife" name="createlife" value="Give life to this creature" class="button" />
			<?php include_once("adminnav.php"); ?>
		</div>
	</div>
	</form>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
	<script>
		$(function() {
			if ($('div.timedmsg')) {
				$( "div.timedmsg" ).slideDown( 1800, function() {
			  	}).delay( 5000 ).slideUp(1600);
			 }
		});
	</script>
	<script>
		$(function() {
			$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
			$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
			$( "div.juvenileform").hide(); $( "div.female").hide();
			$( "#juvdistinct" ).click(function () {
				if (this.checked == false) {
					$("div.juvenileform").hide();
				} else {
					$("div.juvenileform").show();
				}
				
			});
			$( "#femdistinct" ).click(function () {
				if (this.checked == false) {
					$("div.female").hide();
				} else {
					$("div.female").show();
				}
				
			});
		});
	</script>
	
	<script type="text/javascript" src="<?php echo BASE_URL; ?>plugins/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({
		    selector: "textarea.content",
		    plugins : [ "link, image, hr, anchor, pagebreak, media, wordcount, table, responsivefilemanager"],
		    image_advtab: true,
			external_filemanager_path:"../plugins/filemanager/",
			filemanager_title:"Responsive Filemanager" ,
			external_plugins: { "filemanager" : "plugins/responsivefilemanager/plugin.min.js"}
		 });
	</script>
	
</div>
