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

	"familycname" => array( "Butterflyfish", "Spadefish", "Batfish", "Barracuda", "Angelfish", "Scorpionfish", "Moray",
		"Shark", "Ray", "Cardinalfish", "Soldierfish", "Squirrelfish", "Wrasses", "Parrotfish", "Trevallies", "Fusiliers",
		"Triggerfish", "Clownfish", "Sailfish", "Tuna", "Mackerels", "Bleenies", "Gobies", "Lizardfish", "Pufferfish", "Porcupinefish",
		"Boxfish", "Emperorfish", "Pipefish", "Sea Horses", "Frogfish", "Catfish", "Snappers", "Groupers", "Sweetlips",
		"Pompanos"),

	"generalshape" => array(	"Round", "Elongated", "Spade", "Squared", "Diamond", "Snake-like", "Tapered", "Disc-vertical", "Disc-horizontal", "Squared", "Drop-like", "Irregular" ),
	
	"mouth" => array(
		"shape" => array( "Beak", "Big lips", "Crocodile like",  "Elongated", "Short", "Sideway", "Terminal", "Tubular", "Tubular Snout", "Under", "Upward" ),
		"lipssize" => array( "Not apparent", "Small", "Medium", "Big", "Upper", "Lower"),
		"position" => array("Under", "Terminal", "Over"),
		"sizetohead" => array( "Tiny", "Small", "Normal", "Big", "Oversized" ),
		"reltoeyes" => array("Before", "Equal", "After")
	),
	
	"head" => array(
		"shape" => array( "Flattened", "Wide", "Tapered", "Pointed", "Irregular", "Bumped", "Humped", "Squared"),
		"sizetobody" => array( "Tiny", "Small", "Balanced", "Big", "Huge" )
	),
	
	"features" => array ( "Horns", "Antennas", "Oversized Fins", "Suction disk on head", "Suction disk stomac", "Bill nose", "Appendages", "Thorns", "Spikes", "Bumphead", "Barbs", "Moustache" ),
	
	"patterns" => array(	"Dots", "Spots", "Lines", "Blotches", "Saddled", "Masked", "Rings", "Bands", "Stripes", "Zebra", "Honeycombs", "Fake Eye", "Margins", "Maze-like" ),
	
	"eyes" => array( 
		"sizetohead" => array( "Tiny", "Small", "Normal", "Big", "Oversized"),
		"position" => array( "Sides", "Top", "Front", "Same side")
	),
	
	"laterallines" => array( 
		"shape" => array( "Straight", "Curved")
	),
	
	"operculums" => array( "Spined", "Appendages", "None" ),
	
	"scales" => array(
		"size" =>array( "None", "Tiny", "Small", "Medium", "Large", "Plates" ),
		"type" => array( "Ganoid", "Cycloid", "Ctenoid", "Placoid" )
	),
	
	"fins" => array(
	
		"dorsal" => array ( 
			"shape" => array("Triangular", "Pointed", "Elongated", "Attached to caudal", "Spined" ),
			"spacing" => array("Notched (Spined)", "Continuous", "Separated"),
			"patterns" => array("Dotted", "Spotted", "Lined", "Banded", "Saddled", "Blotched", "Clear rays", "Margins" )
		),
		
		"caudal" => array( 
			"shape" => array("Rounded", "Truncated", "Lunate", "Forked", "Marginated", "Pointed", "Indented", "Curled" ),
			"type" => array( "Heterocercal", "Homocercal" ),
			"patterns" => array("Dotted", "Spotted", "Lined", "Banded", "Blotched", "Clear rays", "Margins" )
		),
		
		"anal" => array(
			"shape" => array("Rounded", "Triangle", "Pointy", "None"),
			"patterns" => array("Dotted", "Spotted", "Lined", "Banded", "Blotched", "Clear rays", "Margins" )
		),
		
		"pelvic" => array(
			"shape" => array("None", "Rounded", "Triangular", "Lobed", "Arched"),
			"position" => array( "Abdominal", "Thoracic, Jugular", "Mental (attached to chin, eyes)"),
			"patterns" => array("Dotted", "Spotted", "Lined", "Banded", "Blotched", "Clear rays", "Margins" )
		),
		
		"pectoral" => array(
			"shape" => array( "Rounded", "Oversized", "Pointy", "Crescent", "Arched", "Leg-like"),
			"patterns" => array("Dotted", "Spotted", "Lined", "Banded", "Blotched", "Clear rays", "Margins" )
		)
	),
	"behavior" => array(
		"schooling" => array(
			"size" => array( "Solitary", "Pairs", "4 - 10",  ),
			"density" => array("Tight", "Medium", "Scarce")
		),
		"motion" => array( "Wave caudal tail", "Flapping pectorals fins", "Ondulates dorsal and anal fins", "Curled Tail", "Ondulates 			whole body", "Walk with leg-like pectoral fins", "Crawls with enlarged pectoral fins", ),
		"diet" => array("Herbivore", "Carnivore", "Omnivore", "Filter Feeder", "Smaller fishes", "Plankton", "Corals", "Jellyfish", 			"Algaes", "Encephalopods", "Crustaceas", "Cannibalism", "Zooplankton", "Phytoplankton"  ),
		"feeding" => array("Ambush", "Chase", "Cooperate", "Dash", "Lure", "Opens Shells", ),
		"timeactive" => array("Diurnal", "Nocturnal", "Crepuscular")
	),
	
	"habitat" => array( "Open Water", "Deep Open Water", "Reef", "Sand", "Algaes", "Corals", "Rocks", "Burrowed", "Anemones", 		"Under Rocks", "Cracks", "Cave" ),
	"habitattype" => array( "Pelagic", "Benthic", "Benthopelagic" )

);



// NUDIBRANCHS, SLUGS, SEA HARE, FLATWORMS

$opisthobranchia = array();

// HABITAT & DISTRIBUTION



 $distribution = array(
/*	"oceans" => array( 
		"Artic" => array(
			"seas" => array( "Amundsen Gulf", "Baffin Bay", "Barents Sea", "Beaufort Sea", "Chukchi Sea", "East Siberian Sea", "Greenland Sea", "Hudson Bay", "James Bay", "Kara Sea", "Kara Strait",
				"Laptev Sea", "Lincoln Sea", "Prince Gustav Adolf Sea", "Pechora Sea", "Wandel Sea", "White Sea" )
		),
		"Pacific" => array(
			"seas" => array( "Arafura Sea", "Bali Sea", "Banda Sea", "Bering Sea", "Bismarck Sea", "Bohai Sea", "Bohol Sea(aka Mindanao Sea)", "Camotes Sea", "Celebes Sea", "Ceram Sea",
				"Chilean Sea", "Sea of Chiloé", "Coral Sea", "East China Sea", "Flores Sea", "Gulf of Alaska", "Gulf of California(aka Sea of Cortés)", "Gulf of Carpentaria", "Gulf of Thailand",
				"Halmahera Sea", "Java Sea", "Koro Sea", "Mar de Grau", "Molucca Sea", "Philippine Sea", "Salish Sea", "Savu Sea", "Sea of Japan", "Sea of Okhotsk", "Seto Inland Sea", "Sibuyan Sea",
				"Solomon Sea", "South China Sea", "Sulu Sea", "Tasman Sea", "Visayan Sea", "Yellow Sea" )
		),
		"Atlantic" => array(
			"seas" => array(  
				"Baltic Sea" => array( "Archipelago Sea", "Bothnian Sea", "Central Baltic Sea", "Gulf of Bothnia", "Gulf of Finland", "Gulf of Riga", "Oresund Strait", "Sea of Åland" ),
				"Mediterranean Sea" => array( "Aegean Sea", "Mirtoon Sea", "Sea of Crete", "Thracian Sea", "Adriatic Sea", "Alboran Sea", "Balearic Sea", "Catalan Sea", "Cilician Sea",
					"Gulf of Sidra", "Ionian Sea", "Levantine Sea", "Libyan Sea", "Ligurian Sea", "Sea of Sardinia", "Sea of Sicily", "Tyrrhenian Sea" ),
				"Others" => array( "Argentine Sea", "Bay of Biscay", "Bay of Campeche", "Bay of Fundy", "Black Sea", "Caribbean Sea", "Celtic Sea", "Chesapeake Bay", "Davis Strait",
					"Denmark Strait", "English Channel", "Gulf of Guinea", "Gulf of Maine", "Gulf of Mexico", "Gulf of St. Lawrence", "Gulf of Venezuela", "Irish Sea", "Labrador Sea", "Marmara Sea",
					"North Sea", "Norwegian Sea", "Sargasso Sea", "Sea of Azov", "Sea of the Hebrides", "Wadden Sea" )
			)
		),
		"Indian" => array(
			"seas" => array( "Andaman Sea", "Arabian Sea", "Bay of Bengal", "Gulf of Aden", "Gulf of Oman", "Laccadive Sea", "Mozambique Channel", "Persian Gulf", "Red Sea", "Timor Sea" )
		),
		"Southern" => array(
			"seas" => array( "Amundsen Sea", "Bass Strait", "Bellingshausen Sea", "Cooperation Sea", "Cosmonauts Sea", "Davis Sea", "D'Urville Sea", "Drake Passage", "Great Australian Bight",
				"Gulf St Vincent", "King Haakon VII Sea", "Lazarev Sea", "Mawson Sea", "Riiser-Larsen Sea", "Ross Sea", "Scotia Sea", "Somov Sea", "Spencer Gulf", "Weddell Sea" )
		)
	), */
	"continents" => array( "Americas", "Africa", "Asia", "Australia", "Europe"  ),
	
	"regions" => array( "South-East Asia", "North America", "Central America", "South America", "Caribbean",
		"Western Europe", "Southern Europe", "Eastern Europe", "Northern Europe", "Northern Africa", "Western Africa",
		"Central Africa", "Southern Africa", "Eastern Africa", "Western Asia", "Southern Asia", "Western Asia",
		"South-East Asia",	"Australia/New-Zealand", "Micronesia", "Polynesia", "Hawaii", "Caledonia"
	),
	
	"countries" => array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", 
		"Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", 
		"Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahrain", 
		"Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", 
		"Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", 
		"Bouvet Island", "Brazil", "British Indian Ocean Territory", "British 
		Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", 
		"Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", 
		"Central African Republic", "Chad", "Chile", "China", "Christmas 
		Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", 
		"Cook Islands", "Costa Rica", "Cote d\'Ivoire", "Croatia", "Cuba", 
		"Cyprus", "Czech Republic", "Democratic Republic of the Congo", 
		"Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", 
		"Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", 
		"Estonia", "Ethiopia", "Faeroe Islands", "Falkland Islands", "Fiji", 
		"Finland", "Former Yugoslav Republic of Macedonia", "France", "French 
		Guiana", "French Polynesia", "French Southern Territories", "Gabon", 
		"Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", 
		"Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", 
		"Guyana", "Haiti", "Heard Island and McDonald Islands", "Honduras", 
		"Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", 
		"Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", 
		"Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", 
		"Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", 
		"Lithuania", "Luxembourg", "Macau", "Madagascar", "Malawi", "Malaysia", 
		"Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", 
		"Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia", "Moldova", 
		"Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", 
		"Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", 
		"Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", 
		"Niger", "Nigeria", "Niue", "Norfolk Island", "North Korea", "Northern 
		Marianas", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New 
		Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn Islands", 
		"Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", 
		"Russia", "Rwanda", "Sqo Tome and Principe", "Saint Helena", "Saint 
		Kitts and Nevis", "Saint Lucia", "Saint Pierre and Miquelon", "Saint 
		Vincent and the Grenadines", "Samoa", "San Marino", "Saudi Arabia", 
		"Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", 
		"Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", 
		"South Georgia and the South Sandwich Islands", "South Korea", "South 
		Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan 
		Mayen", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", 
		"Tajikistan", "Tanzania", "Thailand", "The Bahamas", "The Gambia", 
		"Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", 
		"Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Virgin Islands", 
		"Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United 
		States", "United States Minor Outlying Islands", "Uruguay", 
		"Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Wallis 
		and Futuna", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", 
		"Zimbabwe"
 	)
);

$oceans = array( "Artic", "Atlantic", "Indian", "Pacific" );
$seas = array( "Amundsen Gulf", "Baffin Bay", "Barents Sea", "Beaufort Sea", "Chukchi Sea", "East Siberian Sea",
	"Greenland Sea", "Hudson Bay", "James Bay", "Kara Sea", "Kara Strait", 	"Laptev Sea", "Lincoln Sea",
	"Prince Gustav Adolf Sea", "Pechora Sea", "Wandel Sea", "White Sea", "Arafura Sea", "Bali Sea", "Banda Sea",
	"Bering Sea", "Bismarck Sea", "Bohai Sea", "Bohol Sea(aka Mindanao Sea)", "Camotes Sea", "Celebes Sea",
	"Ceram Sea", "Chilean Sea", "Sea of Chiloé", "Coral Sea", "East China Sea", "Flores Sea", "Gulf of Alaska",
	"Gulf of California(aka Sea of Cortés)", "Gulf of Carpentaria", "Gulf of Thailand",	"Halmahera Sea", "Java Sea",
	"Koro Sea", "Mar de Grau", "Molucca Sea", "Philippine Sea", "Salish Sea", "Savu Sea", "Sea of Japan",
	"Sea of Okhotsk", "Seto Inland Sea", "Sibuyan Sea",	"Solomon Sea", "South China Sea", "Sulu Sea", "Tasman Sea",
	"Visayan Sea", "Yellow Sea", "Archipelago Sea", "Bothnian Sea", "Central Baltic Sea", "Gulf of Bothnia",
	"Gulf of Finland", "Gulf of Riga", "Oresund Strait", "Sea of Åland", "Aegean Sea", "Mirtoon Sea", "Sea of Crete",
	"Thracian Sea", "Adriatic Sea", "Alboran Sea", "Balearic Sea", "Catalan Sea", "Cilician Sea",	"Gulf of Sidra",
	"Ionian Sea", "Levantine Sea", "Libyan Sea", "Ligurian Sea", "Sea of Sardinia", "Sea of Sicily", "Tyrrhenian Sea",
	"Argentine Sea", "Bay of Biscay", "Bay of Campeche", "Bay of Fundy", "Black Sea", "Caribbean Sea", "Celtic Sea",
	"Chesapeake Bay", "Davis Strait", "Denmark Strait", "English Channel", "Gulf of Guinea", "Gulf of Maine",
	"Gulf of Mexico", "Gulf of St. Lawrence", "Gulf of Venezuela", "Irish Sea", "Labrador Sea", "Marmara Sea",
	"North Sea", "Norwegian Sea", "Sargasso Sea", "Sea of Azov", "Sea of the Hebrides", "Wadden Sea",
	"Andaman Sea", "Arabian Sea", "Bay of Bengal", "Gulf of Aden", "Gulf of Oman", "Laccadive Sea",
	"Mozambique Channel", "Persian Gulf", "Red Sea", "Timor Sea", "Amundsen Sea", "Bass Strait", "Bellingshausen Sea",
	"Cooperation Sea", "Cosmonauts Sea", "Davis Sea", "D'Urville Sea", "Drake Passage", "Great Australian Bight",
	"Gulf St Vincent", "King Haakon VII Sea", "Lazarev Sea", "Mawson Sea", "Riiser-Larsen Sea", "Ross Sea",
	"Scotia Sea", "Somov Sea", "Spencer Gulf", "Weddell Sea"
);

$months = array( "January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$direction = array("Horizontal", "Vertical", "Diagonal", "Wavy", "Random");
$visuals = array_merge($direction, $gnathostomata['patterns']);
$book = array("Silvery");

/*
 * Page categories for now (Might change according to size of site)
 */

$pagecat =array( "Uncategorized", "About", "Glossary" );

?>
