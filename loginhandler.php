<?php
include_once("connect.php");

if(!isset($_POST["login_button"])) {
	header("Location: login.php");
} else {

session_start();
if($_POST['login_name'] == "" || $_POST['login_pass'] == "") {
	$_SESSION['test'] = true;
	header("Location: login.php?error=1");
} else {

try {

	$sth = $con->prepare("SELECT * FROM users WHERE name = :name AND pass = :pass");
	$sth->bindParam(':name', $_POST['login_name']);
	$sth->bindParam(':pass', crypt($_POST['login_pass'], "$3a$08$2"));
	$sth->execute();

	$rows = $sth->fetch(PDO::FETCH_NUM);

	if($rows > 0) {
		$_SESSION['test'] = false;
		$_SESSION['auth'] = true;
		$_SESSION['user'] = $_POST['login_name'];
		header("Location: login.php?login=okej");
	}
	else 
	{
		$_SESSION['test'] = true;
		header("Location: login.php?error=2");
	}

} catch(PDOException $e) {
	echo $e->getMessage();
}
}
}