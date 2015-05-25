<?php

/*
	*
	*Create an array with the predefined values for big branches of tree eg: fish, corals, jellyfish
	*for quick referencing in forms
	*
	*/
	
$lifegroups = array("Fish", "Nudibranch", "Encephalopods", "Corals", "Sponges and fans", "Mollusc", "Crustaceas", "Mammals" );

$branchranks =array("Unranked", "Cladistic", "Empire", "Kingdom", "Subkingdom", "Superphylum", "Phylum", "Subphylum", "Infraphylum", "Superclass", "Class", "Subclass", "Infraclass", "Superorder", "Order", "Suborder", "Superfamily", "Family", "Genus" );

$fishshape = array("Round", "Elongated", "Spade", "Squared", "Diamond", "Snake-like", "Tapered", "Disc-vertical", "Disc-horizontal");

$tints = array("White", "Grey", "Black", "Silvery", "Golden");
$colorbase = array("Blue", "Pink", "Olive", "Yellow", "Magenta", "Purple", "Green", "Brown", "Orange", "Teal", "Red");
$colors = array_merge($tints, $colorbase);

$direction = array("Horizontal", "Vertical", "Diagonal", "Wavy");
$patterns = array("Dots", "Spots", "Lines", "Blotches", "Saddled", "Masked", "Rings", "Bands", "Stripes", "Zebra", "Honeycombs");
$visuals = array_merge($direction, $patterns);
$book = array("Silvery");

$pagecat =array( "Uncategorized", "About", "Glossary" );

?>
