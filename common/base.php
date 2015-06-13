<?php
 // Set the error reporting level
error_reporting(E_ALL);
ini_set("display_errors", 1);

 // Start a PHP session
session_start();

// Include site constants
if (!defined('ROOT_PATH')) {
	define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/marinelifefinder/");
}
include_once ROOT_PATH."inc/config.inc.php";

// Create a database object
try {
	$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
	$db = new PDO($dsn, DB_USER, DB_PASS);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
	print_r($db->errorInfo());
	exit;
}
