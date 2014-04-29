<?php	
		$sth = $con->prepare("UPDATE users SET pass = :newpass WHERE name = :name");
		$sth->bindParam(':newpass', crypt($_POST['newpass'], '$3a$08$2')); 
		$sth->bindParam(':name', $_SESSION['user']);
		$sth->execute();

		$msg = "<font color='#00FF00'><b>Password has been changed!</b></font><br />"
?>