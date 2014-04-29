<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Website</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<?php include_once("connect.php"); ?>
	<?php include_once("auth.php"); ?>
	<?php
	if($_SESSION['online'] == false) {
		header("Location: login.php");
	} else { ?>

	<div id="logo">
		<div id="sitename">Website</div>
		<div id="signout">Welcome, <b><?php echo ucfirst(strtolower($_SESSION['user'])); ?></b>!<br>
		<a href="signout.php">Sign out</a>
		</div>
	</div>
	 <div id="menu">
 		<ul>
			<a href="index.php"><li>Mainpage</li></a>
			<a href="forum.php"><li>Forum</li></a>
			<a href="account.php"><li id="active">Account</li></a>
			<?php
			if($_SESSION['admin']) {
			echo '<a href="adminpanel.php"><li>Admin</li></a>';	
			}
			?>
 		</ul>
 	</div>
	<div id="wrapper">
	<div id="content">
		<div id="main_div">
			
			<div id="float">
				<?php
				include("changepassword.html");
				?>
			</div>

		</div>
	</div>
	</div>

	<?php } ?>
</body>
</html>