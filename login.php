<?php include_once("connect.php"); ?>
<?php include_once("auth.php"); ?>
<?php
if($_SESSION["online"]) {
	header("Location: index.php");
} else {

if (isset($_SESSION['test'])){
	if(isset($_GET['error'])) {
	switch($_GET["error"]) {
		case "1":
		$msg = "<font color='yellow'><b>You seem to have forgotten something!</b></font><br>";
		break;
		
		case "2":
		$msg = "<font color='yellow'><b>Wrong password or username!</b></font><br>";
		break;

		default:
		$msg = "";
	}
	} else { 
	$msg = ""; }
} else {
	$msg = "";
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Website</title>
	<link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>

<div id="cover">
	<div id="main">
		<div id="wrapper">
			<div id="login_div_top">Login</div>
			<div id="login_div">
				<form action="loginhandler.php" method="post">
					<?php echo $msg; ?>
					<label for="login_name">Username:</label><br>
					<input id="login_input_n" type="text" name="login_name"><br>

					<label for="login_pass">Password:</label><br>
					<input id="login_input_p" type="password" name="login_pass"><br>

			</div>
			<div id="login_div_bot">
				
					<input id="button_l" type="submit" name="login_button" value="Login">
				</form>
				<form action="register.php" method="post">
					<input id="button_r" type="submit" name="register" value="Register">
				</form>

			</div>
		</div>
	</div>
</div>
	
</body>
</html>

<?php
}
?>