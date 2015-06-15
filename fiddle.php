<?php

$arrayone = array("bacon" => "tasty", "lettuce", "carrot");
    $arraytwo = array("ham" => "tasty", "carrot");
    $differences = array_diff($arrayone, $arraytwo);
    
    var_dump($differences);
	
	$differences = array_diff($arraytwo, $arrayone);
	
	var_dump($differences);
	
	?>