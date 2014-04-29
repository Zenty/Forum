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
		$msg = "<font color='yellow'><b>That username already exist!</b></font><br>";
		break;

		case "3":
		$msg = "<font color='yellow'><b>The passwords doesn't seem to match!</b></font><br>";
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
			<div id="login_div_top">Register</div>
			<div id="login_div">
				<form action="registerhandler.php" method="post">
					<?php echo $msg; ?>
					<label for="new_user">Username:</label><br>
					<input id="login_input_n" type="text" name="new_user"><br>

					<label for="new_pass">Enter password:</label><br>
					<input id="login_input_p2" type="password" name="new_pass"><br>

					<label for="new_pass_re">Re-Enter password:</label><br>
					<input id="login_input_p" type="password" name="new_pass_re"><br>

			</div>
			<div id="login_div_bot">
				
					<input id="button_rb" type="submit" name="register_button" value="Create Account">
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