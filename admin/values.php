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
 * Fishes
 */

$fish = array(
	"shape" => array(	"Round", "Elongated", "Spade", "Squared", "Diamond", "Snake-like", "Tapered", "Disc-vertical", "Disc-horizontal", "Squared" ),
	"mouthshape" => array( "Beak", "Big lips", "Crocodile like",  "Elongated", "Short", "Sideway", "Terminal", "Tubular", "Tubular Snout", "Under", "Upward" ),
	"features" => array ( "Horns", "Antennas", "Oversized Fins", "Suction disk on head", "Suction disk stomac", "Bill nose", "Appendages" ),
	"patterns" => array(	"Dots", "Spots", "Lines", "Blotches", "Saddled", "Masked", "Rings", "Bands", "Stripes", "Zebra", "Honeycombs" ),
	"eyes" => array( 
		"size" => array( "Tiny", "Small", "Normal", "Big", "Oversized"),
		"position" => array("Sides", "Top", "Front", "Same side")
	),
	"fins" => array(
		"dorsal" => array ( 
			"shape" => array("Triangle", "Pointy" )
		),
		"adipose" => array ( 
			"shape" => array( "Rounded" )
		),
		"caudal" => array( 
			"shape" => array("Rounded", "Triangle" )
		),
		"anal" => array(
			"shape" => array("Rounded", "Triangle", "None")
		),
		"pelvic" => array(
			"shape" => array("None", "Rounded")
		),
		"pectoral" => array(
			"shape" => array( "Rounded", "Oversized", "Pointy", "Crescent", "Arched")
		)
	)
);





$direction = array("Horizontal", "Vertical", "Diagonal", "Wavy", "Random");
$visuals = array_merge($direction, $fish['patterns']);
$book = array("Silvery");

/*
 * Page categories for now (Might change according to size of site)
 */

$pagecat =array( "Uncategorized", "About", "Glossary" );

?>
