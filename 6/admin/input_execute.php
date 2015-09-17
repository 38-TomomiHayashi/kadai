<?php
$news_title = htmlspecialchars($_POST["news_title"], ENT_QUOTES, 'UTF-8');
$news_detail = htmlspecialchars($_POST["news_detail"], ENT_QUOTES, 'UTF-8');
$show_flg = ($_POST["show_flg"] == 'ON' ? 1 : 0);
$author = htmlspecialchars($_POST["author"], ENT_QUOTES, 'UTF-8');

$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
$sql = "INSERT INTO news (news_id, news_title, news_detail, show_flg, author, create_date, update_date) VALUES (NULL, :news_title, :news_detail, :show_flg, :author, sysdate(), sysdate()) ";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':news_title', $news_title, PDO::PARAM_STR);
$stmt->bindValue(':news_detail', $news_detail, PDO::PARAM_STR);
$stmt->bindValue(':show_flg', $show_flg, PDO::PARAM_INT);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$result = $stmt->execute();
// var_dump($result);
if($result) {
	$msg = "データが登録できました";
} else {
	$msg = "データの登録に失敗しました";
}
$pdo = null;
?>

<?php include('header.php'); ?>
<div class="message"></div><?php echo $msg ?></div>
<?php include('footer.php'); ?>