<?php
if(!isset($_GET['forum'])) {
?>
	<tr class="forum_header">
		<th>Directory</th>
		<th class="threads">Threads</th>
	</tr>
<?php

$sth = $con->prepare("SELECT * FROM forumtopics ORDER BY id");
$sth->execute();
foreach($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {

?>
<tr class="forum_item">
	<td>
		<div id="topic"><?php echo "<a href='forum.php?forum=".$row['id']."'>".$row['topic']."</a>"; ?></div>
		<div id="description"><?php echo $row['description']; ?></div>
	</td> 
	<td class="threads"><?php echo $row['t_threads']; ?></td>
</tr>
<?php
}
} else {
	include('threads.php');
}
?>