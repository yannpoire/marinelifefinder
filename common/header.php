<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php if (isset($pagetitle)) {echo $pagetitle;} else { echo "A Database of marine life"; } ?></title>
	<meta name="Description" content="<?php if (isset($metadesc)) {echo $metadesc;} else { echo 'A Database for marine life identification with customizable searches';} ?>">
	<meta name="keywords" content="<?php if (isset($metakeys)) {echo $metakeys;} else { echo 'marine, life, identification, search, marine life, fish, nudibranchs, shells';} ?>">
	<meta name="author" content="Yann Poiré">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/bootstrap.min.css">
	 <style>body { padding-top: 50px; padding-bottom: 20px; }</style>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/main.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/mystyle.css">
	<script src="<?php echo BASE_URL; ?>js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>
	<!--[if lt IE 8]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->