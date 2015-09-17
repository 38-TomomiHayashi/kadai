<?php
$news_id = (int)$_POST["news_id"];
$news_title = htmlspecialchars($_POST["news_title"], ENT_QUOTES, 'UTF-8');
$news_detail = htmlspecialchars($_POST["news_detail"], ENT_QUOTES, 'UTF-8');
$show_flg = ($_POST["show_flg"] == 'ON' ? 1 : 0);
$author = htmlspecialchars($_POST["author"], ENT_QUOTES, 'UTF-8');

$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
$sql = "UPDATE news SET news_title = :news_title, news_detail = :news_detail, show_flg = :show_flg, author = :author, update_date = SYSDATE() WHERE news_id = " . $news_id;
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':news_title', $news_title, PDO::PARAM_STR);
$stmt->bindValue(':news_detail', $news_detail, PDO::PARAM_STR);
$stmt->bindValue(':show_flg', $show_flg, PDO::PARAM_INT);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$result = $stmt->execute();
if($result) {
	$msg = 'データが登録できました<br>';
	$msg = $msg . '<a href="news_list.php">ニュース一覧へ</a><br>';
} else {
	$msg = 'データの登録に失敗しました';
}
$pdo = null;
?>

<?php include('header.php'); ?>
<div class="message"></div><?php echo $msg ?></div>
<?php include('footer.php'); ?>