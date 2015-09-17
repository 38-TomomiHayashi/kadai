<?php
$news_id = (int)$_GET['news_id'];

$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
$sql = "SELECT * FROM news WHERE news_id = " . $news_id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$news_title = $results[0]['news_title'];
$news_detail = $results[0]['news_detail'];
$show_flg = ($results[0]['show_flg'] == 1 ? 'ON' : 'OFF');
$author = $results[0]['author'];

$pdo = null;
?>

<?php include('header.php'); ?>
<form id="form_input" action="update_execute.php" method="post">
	<dl>
		<dt>タイトル：</dt>
		<dd><input type="text" name="news_title" size="100" value="<?php echo $news_title ?>" /></dd>
		<dt>詳細：</dt>
		<dd><textarea name="news_detail" rows="10" cols="100"><?php echo $news_detail ?></textarea></dd>
		<dt>表示：</dt>
		<dd>
			<select name="show_flg">
				<option <?php if($show_flg == 'ON'){echo 'selected="selected"';} ?> >ON</option>
				<option <?php if($show_flg == 'OFF'){echo 'selected="selected"';} ?> >OFF</option>
			</select>
		</dd>
		<dt>執筆者：</dt>
		<dd><input type="text" name="author" value="<?php echo $author ?>" /></dd>
	</dl>
	<input type="hidden" name="news_id" value="<?php echo $news_id ?>" />
	<input class="btn" type="submit" />
</form>
<?php include('footer.php'); ?>