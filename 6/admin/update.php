<?php
$news_id = $_GET['news_id'];

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

<html>
<head>
<style>
	form {
		width: 800px;
		margin: 30px auto;
		padding: 10px;
		border: solid 1px #ccc;
		text-align: center;
	}
	dt {
		clear: both;
		float: left;
		width: 100px;
		text-align: right;
		line-height: 2.0em;
	}
	dd {
		margin-top: 6px;
		margin-left: 10px;
		float: left;
		text-align: left;
	}
	dl:after {
		content: "";
		display: block;
		clear: both;
	}
	.btn {
		width: 100px;
		text-align: rignt;
	}
</style>
</head>
<body>
<form action="update_execute.php" method="post">
	<dl>
		<dt>タイトル：</dt>
		<dd><input type="text" name="news_title" size="100" value="<?php echo $news_title ?>" /></dd>
		<dt>詳細：</dt>
		<dd><textarea name="news_detail" rows="10" cols="100"><?php echo $news_detail ?></textarea></dd>
		<dt>表示：</dt>
		<dd>
			<select name="show_flg">
				<option <?php if($show_flg == 1){echo 'selected="selected"';} ?> >ON</option>
				<option <?php if($show_flg == 0){echo 'selected="selected"';} ?> >OFF</option>
			</select>
		</dd>
		<dt>執筆者：</dt>
		<dd><input type="text" name="author" value="<?php echo $author ?>" /></dd>
	</dl>
	<input type="hidden" name="news_id" value="<?php echo $news_id ?>" />
	<input class="btn" type="submit" />
</form>
</body>
</html>