<?php

// Our username, password & database name variables.
$db_name = 'Zenty';
$db_pass = "newpass";
$db = "forum";

try {

	#Connect to PDO(MySQL)
	$con = new PDO("mysql: host=localhost; dbname=$db", $db_name, $db_pass);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$con->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8
	 
}
	#Error Message
	catch(PDOException $e) {
	echo "ERROR: ".$e->getMessage();
	}