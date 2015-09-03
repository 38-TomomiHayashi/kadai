<html>
<head>
<meta charset="utf-8">
<title>アンケート</title>
<style>
	#ancate {
		width: 500px;
		height: auto;
		margin: 30px auto;
		border: solid 1px #cccccc;
		padding: 20px;
	}
</style>
</head>
<body>

<h2>ご回答ありがとうございます。</h2>
<a href="index.php">→TOPに戻る</a>

<?php
$data = $_POST["name"] . "," . $_POST["age"] . ",". $_POST["sex"] . "," . $_POST["hobby"] . PHP_EOL;
$file = fopen("data/data.txt","a");	// ファイル読み込み
flock($file, LOCK_EX);			// ファイルロック
fputs($file, $data);
flock($file, LOCK_UN);			// ファイルロック解除
fclose($file);
?>

</body>
</html>