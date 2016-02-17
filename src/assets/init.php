<?php

// Include this file on all pages
require "php/main/version.php";
require "php/main/config.php";
require "php/main/funcs.php";
require "php/main/session.php";

// Put "Debug" in the page title
if ($site["security"]["debug"] == true) {
	$sitePrefix = "Debug | ";
} else {
	$sitePrefix = "";
}

?>