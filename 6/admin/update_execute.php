<?php
$news_id = $_POST["news_id"];
$news_title = $_POST["news_title"];
$news_detail = $_POST["news_detail"];
$show_flg = ($_POST["show_flg"] == 'ON' ? 1 : 0);
$author = $_POST["author"];

$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
$sql = "UPDATE news SET news_title = :news_title, news_detail = :news_detail, show_flg = :show_flg, author = :author, update_date = SYSDATE() WHERE news_id = " . $news_id;
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':news_title', $news_title, PDO::PARAM_STR);
$stmt->bindValue(':news_detail', $news_detail, PDO::PARAM_STR);
$stmt->bindValue(':show_flg', $show_flg, PDO::PARAM_INT);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$result = $stmt->execute();
if($result) {
	echo "データが登録できました";
	echo '<a href="index.php">管理画面へ</a>';
} else {
	echo "データの登録に失敗しました";
}
$pdo = null;
?>
<html>
<head>
</head>
<body>
</body>
</html>