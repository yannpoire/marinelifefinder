<?php

function numDdown ($limit) {
	for ($i = 0; $i <= $limit; $i++) { echo "<option value='".$i."'>".$i."</option>"; }
}

function customDdown ($values) {
	foreach ($values as $l) {
		echo '<option id="'  .$l.  '" value="'.$l.'" />&nbsp;'.$l.'</option>';
	}
}

?>