<?php

/*
 * 
 * Feel free to edit as you please
 * 
 * Account Types are as followed:
 * 
 * Not set - Not logged in
 * 1 - Standard user
 * 2 - Special User
 * 3 - Important User
 * 4 - Administrator
 * 
 */

$site = array(
	"info" => array(
		"name" => "Patchy",
		"author" => "",
		"content" => "text/html; charset=UTF-8",
		"language" => "en",
		"keywords" => "Ultrapowa, patches, clash of clans, game patches, private server",
		"description" => "Host patches for your ultrapowa clash server here, why setup your own webserver when you can host patches here?",
		"shortDesc" => "Edit in assets/php/main/config.php"),
	"custom" => array(
		"theme" => "default.css"), // Must be in css directory, for now
	"limits" => array(
		"defaultPatchAmount" => 25,
		"premiumPatchAmount" => 50,
		"defaultPatchMaxSize" => 10240000, // 10MB
		"premiumPatchMaxSize" => 15360000, // 15MB
		"defaultPatchMaxSizeStr" => "10MB",
		"premiumPatchMaxSizeStr" => "15MB"),
	"server" => array(
		"host" => "http://localhost/", // Set this to your domain must end with a / and start with http:// or https://
		"mainPage" => "index.php", // Change only if you renamed the index.php file
		"pathToMainPage" => "patchy/") // Only change if it is in a folder not the server root e.g. http://website/FOLDER_HERE/index.php
);

$fullPathToHome = $site["server"]["host"] . $site["server"]["pathToMainPage"] . $site["server"]["mainPage"];


// Will change \ to / when enabled
// Will use PHP later to make this easier for you guys and gals
$usingLinux = false;

?>