<?php
    // Database credentials
    define("DB_HOST", "localhost");
    define("DB_USER", "marinelifefinder");
    define("DB_PASS", "marinelifefinder");
    define("DB_NAME", "marinelifefinder");
	
	//Path of server
	define("BASE_URL", "/marinelifefinder/");
	if (!defined("ROOT_PATH")) {
		define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "marinelifefinder/");
	}
	//define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/marinelifefinder/");
?>