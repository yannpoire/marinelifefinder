<?php

class MLFForms {
	
	
	/*
	 * 
	 * Type is field type as input text, checkbox, radio or select or textarea or hidden
	 * Name is the name of field as it appears in the DB
	 * Values can be single item string, multiple item string or array 
	 * 
	 * 
	 */
	 
	 /*
	  * createField will echo field for from entry or can prepoplulate a form for edit
	  */
	
	public function createField ($fieldarr) {
		foreach ($fieldarr as $field => $properties) {
			if ($fieldarr['edit'] == 1) {
				// Need to connect to DB
			} else {
				switch ($fieldarr['type']) {
					case "text" :
						echo "<label for=\"".$fieldarr['name']."\">".$label."</label>",
							"<input class=\"\" name=\"".$values."\" type=\"text\">";
						break;
						
					case "radio" :
						echo "radio";
						break;
						
					case "select" :
						echo "<label for=\"".$name."\">".$values."</label>",
							"<select name=\"".$name."\">";
						foreach ($values as $value) {
							echo "<option value=\"".$value."\">".$value."</option>";
						}
						echo "</select>";
						break;
						
					case "multiselect" :
						echo "<select name=\"".$name."\">";
						break;
						
					case "textarea" :
						echo "<label for=\"".$name."\">".$values."</label>",
							"<textarea name=\"".$name."\">".$values."</textarea>";
						break;
						
					default:
						echo "Cannot create this field";
						break;
				}
			}
		}
	}
}





















?>