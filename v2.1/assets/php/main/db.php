<?php

// May make this a class in the future

DEFINE("db_host","127.0.0.1");
DEFINE("db_user","");
DEFINE("db_pass","");
DEFINE("db_dbse","patchy");

$conn = @new mysqli(db_host,db_user,db_pass,db_dbse);
//GLOBAL $conn;

if ($conn->connect_error) {
	unset($conn);
	die("<h1 style=\"font-family:sans-serif\">Database server is unreachable</h1>");
} else {
	$conn->set_charset("utf8");
}

?>