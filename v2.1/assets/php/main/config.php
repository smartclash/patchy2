<?php
/*
 * Patchy 2.1 created by Jake Mcneill
 * Licensed under the BSD 2-clause license
 * https://github.com/jake-cryptic/patchy2
 */
 
// Will change \ to / when enabled (important for uploading/unzipping/deleting/viewing)
if (strpos(strtolower(php_uname('s')),'win') !== true) {
	$usingLinux = false;
} else {
	$usingLinux = true;
}

if ($_SERVER["SERVER_PORT"] == 443) {
	$protocol = "https";
} else {
	$protocol = "http";
}

$site = array(
	"info" => array(
		"name" => "SITE_NAME",
		"author" => "Jake Mcneill - 2015",
		"content" => "text/html; charset=UTF-8",
		"language" => "en",
		"keywords" => "Ultrapowa, patches, clash of clans, game patches, private server",
		"description" => "Host patches for your ultrapowa clash server here, why setup your own webserver when you can host patches here?",
		"shortDesc" => "Host your patches, for free"),
	"custom" => array(
		"theme_location" => "assets/themes/patchy1/", // Must contain 3 files (background.jpg, global.css, home.css)
		"favicon_location" => "assets/images/patchy.png",
		"appleicon_location" => "assets/images/patchy-apple-icon.png"),
	"features" => array(
		"allowAccountReload" => true), // Allows account reloading account data without needing to re-login
	"limits" => array(
		"defaultPatchAmount" => 25,
		"premiumPatchAmount" => 50,
		"defaultPatchMaxSize" => 10240000, // 10MB
		"premiumPatchMaxSize" => 15360000, // 15MB
		"defaultPatchMaxSizeStr" => "10MB",
		"premiumPatchMaxSizeStr" => "15MB"),
	"server" => array(
		"host" => "$protocol://WWW.WEBSITE.COM/", // Set this to your domain must end with a / and start with http:// or https://
		"mainPage" => "index.php", // Change only if you renamed the index.php file
		"pathToMainPage" => "") // Only change if it is in a folder not the server root e.g. http://website/FOLDER_HERE/index.php
);

$fullPathToHome = $site["server"]["host"] . $site["server"]["pathToMainPage"] . $site["server"]["mainPage"];
$fullPathToRoot = $site["server"]["host"] . $site["server"]["pathToMainPage"];

?>