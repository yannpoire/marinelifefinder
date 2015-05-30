<?php

/*
	*
	*Create an array with the predefined values for big branches of tree eg: fish, corals, jellyfish
	*for quick referencing in forms
	*
	*/
	
/*
 * Common to all lifeforms
 */	
	
$lifegroups = array("Fish", "Nudibranch", "Encephalopods", "Corals", "Sponges and fans", "Mollusc", "Crustaceas", "Mammals" );

$branchranks =array("Unranked", "Cladistic", "Empire", "Kingdom", "Subkingdom", "Superphylum", "Phylum", "Subphylum", "Infraphylum", "Superclass", "Class", "Subclass", "Infraclass", "Superorder", "Order", "Suborder", "Superfamily", "Family", "Genus" );

// Colors  
$tints = array("White", "Grey", "Black", "Silvery", "Golden");
$colorbase = array("Blue", "Pink", "Olive", "Yellow", "Magenta", "Purple", "Green", "Brown", "Orange", "Teal", "Red");
$colors = array_merge($tints, $colorbase);



/*
 * Fishes gnathostomata includes sharks to bony fishes but not hagfish in craniata
 */

$gnathostomata = array(
	"generalshape" => array(	"Round", "Elongated", "Spade", "Squared", "Diamond", "Snake-like", "Tapered", "Disc-vertical", "Disc-horizontal", "Squared", "Drop-like", "Irregular" ),
	
	"mouth" => array(
		"shape" => array( "Beak", "Big lips", "Crocodile like",  "Elongated", "Short", "Sideway", "Terminal", "Tubular", "Tubular Snout", "Under", "Upward" ),
		"lipssize" => array( "Not apparent", "Small", "Medium", "Big", "Upper", "Lower"),
		"position" => array("Under", "Terminal", "Over"),
		"sizetohead" => array( "Tiny", "Small", "Normal", "Big", "Oversized" )
	),
	
	"head" => array(
		"shape" => array( "Flattened", "Wide", "Tapered", "Pointed", "Irregular", "Bumped", "Humped"),
		"sizetobody" => array( "Tiny", "Small", "Balanced", "Big", "Huge" )
	),
	
	"features" => array ( "Horns", "Antennas", "Oversized Fins", "Suction disk on head", "Suction disk stomac", "Bill nose", "Appendages" ),
	
	"patterns" => array(	"Dots", "Spots", "Lines", "Blotches", "Saddled", "Masked", "Rings", "Bands", "Stripes", "Zebra", "Honeycombs", "Fake Eye" ),
	
	"eyes" => array( 
		"sizetohead" => array( "Tiny", "Small", "Normal", "Big", "Oversized"),
		"position" => array( "Sides", "Top", "Front", "Same side")
	),
	
	"laterallines" => array( 
		"shape" => array( "Straight", "Curved")
	),
	
	"opercules" => array( "Spined", "Appendages" ),
	
	"scales" => array(
		"size" =>array( "None", "Tiny", "Small", "Medium", "Large", "Plates" ),
		"type" => array( "Ganoid", "Cycloid", "Ctenoid", "Placoid" )
	),
	
	"fins" => array(
	
		"dorsal" => array ( 
			"shape" => array("Triangular", "Pointed", "Elongated", "Attached to caudal", "Spined" ),
			"spacing" => array("Notched (Spined)", "Continuous", "Separated"),
			"patterns" => array("Dotted", "Spotted", "Lined", "Banded", "Saddled", "Blotched", "Clear rays" )
		),
		
		"caudal" => array( 
			"shape" => array("Rounded", "Truncated", "Lunate", "Forked", "Marginated", "Pointed", "Indented", "Heterocercal", "Curled" ),
			"patterns" => array("Dotted", "Spotted", "Lined", "Banded", "Blotched", "Clear rays" )
		),
		
		"anal" => array(
			"shape" => array("Rounded", "Triangle", "None"),
			"patterns" => array("Dotted", "Spotted", "Lined", "Banded", "Blotched", "Clear rays" )
		),
		
		"pelvic" => array(
			"shape" => array("None", "Rounded"),
			"position" => array( "Abdominal", "Thoracic, Jugular", "Mental (attached to chin, eyes)"),
			"patterns" => array("Dotted", "Spotted", "Lined", "Banded", "Blotched", "Clear rays" )
		),
		
		"pectoral" => array(
			"shape" => array( "Rounded", "Oversized", "Pointy", "Crescent", "Arched", "Leg-like"),
			"patterns" => array("Dotted", "Spotted", "Lined", "Banded", "Blotched", "Clear rays" )
		)
	)
);

// Nudibranchs, sea slugs, sea hare
$opisthobranchia = array();


$direction = array("Horizontal", "Vertical", "Diagonal", "Wavy", "Random");
$visuals = array_merge($direction, $gnathostomata['patterns']);
$book = array("Silvery");

/*
 * Page categories for now (Might change according to size of site)
 */

$pagecat =array( "Uncategorized", "About", "Glossary" );

?>
