<?php
include_once("connect.php");

if(!isset($_POST["register_button"])) {
	header("Location: register.php");
} else {

session_start();
if($_POST['new_user'] == "" || $_POST['new_pass'] == "" || $_POST['new_pass_re'] == "") {
	$_SESSION['test'] = true;
	header("Location: register.php?error=1");
} else {

	$sth = $con->prepare("SELECT COUNT(*) AS count FROM `users` WHERE name=?");
	$sth->execute(array($_POST['new_user']));

	while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
	  $username_count = $row['count'];
	} 

	if($username_count > 0) {
		$_SESSION['test'] = true;
		header("Location: register.php?error=2");
	} else {
		if($_POST['new_pass'] == $_POST['new_pass_re']) {	

			$sth = $con->prepare("INSERT INTO users (name, pass) VALUES (:name, :pass)");
			$sth->bindParam(":name", $_POST['new_user']);
			$sth->bindParam(":pass", crypt($_POST['new_pass'], "$3a$08$2"));
			$sth->execute();

			$_SESSION['test'] = false;
			$_SESSION['auth'] = true;
			$_SESSION['user'] = $_POST['new_user'];
			header("Location: register.php?creation=true");

		} else {
			$_SESSION['test'] = true;
			header("Location: register.php?error=3");
		}
	}
}
}