<?php

	$text = $_POST['post_text'];
	$user = $_SESSION['user'];
	$date2 = date('Y/m/d H:i');
	$t_id = $_GET['forum'];
	$p_id = $_GET['thread'];

	$sth = $con->prepare('INSERT INTO `forumposts` (text, user, date, p_id) VALUES(:text, :user, :date, :p_id)');

	$sth->bindParam(':text', $text);
	$sth->bindParam(':user', $user);
	$sth->bindParam(':date', $date2);
	$sth->bindParam(':p_id', $p_id);

	$sth->execute();
	header("Location: forum.php?forum=".$t_id."&thread=".$p_id);
?>
