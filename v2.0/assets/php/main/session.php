<?php

/*
* Controls user's session
*/

session_name("PatchyID");
 
session_start();

if (!isset($_SESSION["accountType"])) {
	$_SESSION["loginSet"] = false;
}

?>