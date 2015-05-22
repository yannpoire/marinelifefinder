<?php


class MLFSearch {
	
	/**
     * The database object
     *
     * @var object
     */
    private $_db;
	private $fcounter = 0;

    /**
     * Checks for a database object and creates one if none is found
     *
     * @param object $db
     * @return void
     */
    public function __construct($db=NULL) {
        if(is_object($db)) {
            $this->_db = $db;
        } else {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }
	
	public function getSearchfields ($genfield) {
		
		switch ($genfield) {
			case 'ftext': genText(); break;
			case 'fdropdown': genDropd(); break;
			case 'fmultiselect': genMultisel(); break;
			case 'fradio' : genRadio(); break;
			case 'ftextfield' : genTextfield(); break;
			case 'fcheckbox' : genCheck(); break;
			default:	echo "Unknown case for field creation"; break;
		}
	}
	
	
	public function genFText ($elems) {
		$tindex = $fcounter; 
		$fcounter++;
		echo '<br /><label for=" '.$elid.' "> '.$ellabel.' </label><br /><input id=" '
		.$elid.' " name=" '.$elname.' " value=" '.$elvalue.' " tabindex=" '.$tindex.' " required=" '.$elreq.' " class=" '.$elclass.' " />';
	}
	
	
	public function genDropd ($elems) {
		$tindex = $fcounter;
		$fcounter++;
		echo '<select tabindex=" '.$tindex.' ">';
		foreach ($elems as $elem) {
			echo '<option name=" '.$elname.' " value=" '.$elvalue.' ">'.$elcaption.'</option>';
		}
		echo '</select>';
	}
	
	
	public function genMultisel ($elems) {
		$tindex = $fcounter;
		$fcounter++;
		echo '<select tabindex=" '.$tindex.' ">';
		foreach ($elems as $elem) {
			echo '<option name=" '.$elname.' " value=" '.$elvalue.' ">'.$elcaption.'</option>';
		}
		echo '</select>';
	}
	
	
	
}
?>
