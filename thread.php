<?php
	if(isset($_POST['saveEdit'])) {
		$replaceArray = array("<", ">", "$", "#");
		$editText = str_replace($replaceArray, "",$_POST['editText']);

		$sth = $con->prepare("UPDATE forumposts SET text = :newText WHERE id = :id");
		$sth->bindParam(':newText', $editText); 
		$sth->bindParam(':id', $_POST['id']); 
		$sth->execute();
	}

	$t_id = $_GET['forum'];
	$p_id = $_GET['thread'];

	$sth = $con->prepare('SELECT thread_name FROM `forumposts` WHERE (p_id) = (:p_id) ORDER BY id');
	$sth->bindParam(':p_id', $p_id);

	$sth->execute();
	$thread_name = $sth->fetchColumn();
?>
	<tr class="forum_header">
		<th>
		<?php 
		echo $thread_name." - ".	"<a href='forum.php?forum=".$t_id."'>Return</a>"; ?><div id="pages">
		<?php
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
			$sth = $con->prepare("SELECT COUNT(id) FROM forumposts WHERE (p_id) = (:p_id)");
			$sth->bindParam(':p_id', $p_id);
			$sth->execute(); 
			$row = $sth->fetch(); 
			$total_records = $row[0]; 
			$total_pages = ceil($total_records / 10); 
 				
			for ($i=1; $i<=$total_pages; $i++) { 
				echo "<a href='forum.php?forum=".$t_id."&thread=".$p_id."&page=".$i."'";
			if($page==$i) {
				echo "id=active2";
			}
			echo ">";
			echo "".$i."</a> "; 
		}
		?>
		</div></th>
	</tr>
<?php

$p_id = $_GET['thread'];

$start_from = ($page-1) * 10; 
$sth = $con->prepare("SELECT * FROM forumposts WHERE p_id = :p_id ORDER BY id LIMIT $start_from, 10");
$sth->bindParam(':p_id', $p_id);
$sth->execute();

foreach($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
$id = $row['id'];
$text = $row['text'];
?>
	<tr class="forum_post">
		<td>
		<div id="post_user"><?php echo $row['user']; 
		if(isset($_POST['edit']) && $_POST['id'] == $id) {
			?>
		<form action="" method="post">
		<textarea id="input2" rows="8" name="editText" 
		required><?php echo $text; ?></textarea><br />
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input id="button_r" type="submit" name="saveEdit" value="Edit"><br />
	</form>
			<?php
		} else {
			if(ucfirst(strtolower($row['user'])) == ucfirst(strtolower($_SESSION['user'])) OR $_SESSION['admin']) {
		?>
			<form action="" method="post">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input id="editButton" type="submit" name="edit" value="Edit">
			</form>
		<?php
			}
		?>
		</div>
		<?php echo $row['text']; ?><br><br>
		<?php echo "<font color='#FF9933'><i>".substr($row['date'],0,-3)."</i></font>"; ?>
		<?php } ?>
		</td>
	<tr>
<?php
}
?>