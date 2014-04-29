<?php
if(!isset($_GET['thread'])) {
?>	
	<tr class="forum_header">
		<th>Threads</th>
		<th class="posts">Posts</th>
	</tr>
<?php
$t_id = $_GET['forum'];

$sth = $con->prepare("SELECT * FROM forumthreads WHERE t_id = :t_id ORDER BY id");
$sth->bindParam(':t_id', $t_id);
$sth->execute();
foreach($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {

?>
	<tr class="forum_item">
		<td>
		<div id="topic2"><?php echo "<a href='?forum=".$t_id."&thread=".$row['id']."'>".$row['name']."</a>"; ?></div>
		<div id="description"><?php echo "Started by: <font color='#FF9933'>".$row['user']."</font> at <font color='#FF9933'>".$row['date']."</font>"; ?></div>
		</td>
		<td class="posts"><?php echo $row['posts']; ?></td>
	<tr>
<?php
}
?>
	<tr class="forum_item">
		<td class="newforumpost">
			<form action="newforumpost.php" method="post">
			<input type="submit" id="newforumpostbutton" name="newforumpost" value="New Post">
			</form>
		</td>
	<tr>
<?php
} else {
	echo "hello";
}
?>