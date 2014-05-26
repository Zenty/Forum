<?php
$sth = $con->prepare("SELECT * FROM forumthreads ORDER BY id");
$sth->execute();
foreach($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {

		$id = $row['id'];

		$sth = $con->prepare("SELECT COUNT(id) FROM forumposts WHERE (p_id) = (:p_id)");
		$sth->bindParam(':p_id', $id);
		$sth->execute(); 
		$row = $sth->fetch(); 

		$t_posts = $row[0];

		$sth = $con->prepare("UPDATE forumthreads SET posts = :posts WHERE id = :id");
		$sth->bindParam(':posts', $t_posts); 
		$sth->bindParam(':id', $id); 
		$sth->execute();
	}

$sth = $con->prepare("SELECT * FROM forumtopics ORDER BY id");
$sth->execute();
foreach($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {

		$id = $row['id'];

		$sth = $con->prepare("SELECT COUNT(id) FROM forumthreads WHERE t_id = :t_id");
		$sth->bindParam(':t_id', $id);
		$sth->execute(); 
		$row = $sth->fetch(); 

		$t_threads = $row[0];

		$sth = $con->prepare("UPDATE forumtopics SET t_threads = :t_threads WHERE id = :id");
		$sth->bindParam(':t_threads', $t_threads); 
		$sth->bindParam(':id', $id); 
		$sth->execute();

	}
?>