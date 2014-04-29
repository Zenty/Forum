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
			<a href="index.php"><li id="active">Mainpage</li></a>
			<a href="forum.php"><li>Forum</li></a>
			<a href="account.php"><li>Account</li></a>
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

			<?php 
 				if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

				$sth = $con->prepare("SELECT COUNT(id) FROM posts");
				$sth->execute(); 
				$row = $sth->fetch(); 
				$total_records = $row[0]; 
				$total_pages = ceil($total_records / 4); 
 				
 				echo "<div id='pagewrapper'>";
				for ($i=1; $i<=$total_pages; $i++) { 
					echo "<a id='postpages' href='index.php?page=".$i."'";
					if($page==$i) {
						echo "id=active";
					}
					echo ">";
					echo "".$i."</a> "; 
				}; 
				echo "<div/>";
			?>

			<?php
				$start_from = ($page-1) * 4; 		
				$sth = $con->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $start_from, 4");
				$sth->execute();
				foreach($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
			?>

			<div id="float">
				<div id="main_info_div_top"><?php echo $row['topic']; ?></div>
				<div id="main_info_div">
					<?php echo $row['text']; ?>
				</div>
				<div id="main_info_div_bot">
					<?php echo "<i>Posted <b><font color='#FF9933'>".$row['date']."</font></b> by <b><font color='#FF9933'>".$row['author']."</font></b></i>"; ?><br>
				</div>
			</div>

			<?php
				}
			?>
		</div>
	</div>
	</div>

	<?php } ?>
</body>
</html>