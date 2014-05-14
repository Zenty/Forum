<?php

	$t_id = $_GET['forum'];
	$p_id = $_GET['thread'];

	$sth = $con->prepare('SELECT thread_name FROM `forumposts` WHERE (p_id) = (:p_id) ORDER BY id');
	$sth->bindParam(':p_id', $p_id);

	$sth->execute();
	$thread_name = $sth->fetchColumn();
?>
	<tr class="forum_header">
		<th><?php echo $thread_name." - ".	"<a href='forum.php?forum=".$t_id."'>Return</a>"; ?></th>
	</tr>
<?php

$p_id = $_GET['thread'];

$sth = $con->prepare("SELECT * FROM forumposts WHERE p_id = :p_id ORDER BY id");
$sth->bindParam(':p_id', $p_id);
$sth->execute();

foreach($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {

?>
	<tr class="forum_post">
		<td>
		<div id="post_user"><?php echo "#".$row['id']." ".$row['user']; ?></div>
		<?php echo $row['text']; ?>
		</td>
	<tr>
<?php
}