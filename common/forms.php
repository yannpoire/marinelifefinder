<?php

function numDdown ($limit) {
	for ($i = 0; $i <= $limit; $i++) { echo "<option value='".$i."'>".$i."</option>"; }
}

function customDdown ($values) {
	foreach ($values as $el) {
		echo '<option class="selcolor-'  .strtolower($el).  '" value="'.$el.'" />'.$el.'</option>';
	}
}

function checkBox ($values) {
	foreach ($values as $el) {
		echo '<option class="selcolor-'  .strtolower($el).  '" value="'.$el.'" />'.$el.'</option>';
	}
}

function timedMsg($msg, $state) {
	echo "<div class='".$state." timedmsg'><div class='container'><span>".$msg."</span></div></div>";
}




?>