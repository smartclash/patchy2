<?php

// May make this a class in the future
// May make an easy install in the future (*Hint Hint* 4.0)

DEFINE("db_host","");
DEFINE("db_user","");
DEFINE("db_pass","");
DEFINE("db_dbse","patchy");

$conn = new mysqli(db_host,db_user,db_pass,db_dbse);
//GLOBAL $conn;

if ($conn->connect_error) {
	unset($conn);
	die("Server Connection Failure");
} else {
	$conn->set_charset("utf8");
}

?>