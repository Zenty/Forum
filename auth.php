<?php
session_start();
if(!isset($_SESSION['auth'])) {
	$_SESSION['online'] = false;
} else {
	$_SESSION['online'] = true;

	$sth = $con->prepare("SELECT rank FROM users WHERE name = :name");
	$sth->bindParam(":name", $_SESSION['user']);
	$sth->execute();

	$test = $sth->fetchColumn(0);
	if($test > 0) {
		$_SESSION['admin'] = true;
	} else {
		$_SESSION['admin'] = false;
	}	
}