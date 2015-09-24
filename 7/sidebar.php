<?php 

// ====================
// 新着記事
// ====================
$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
$sql = "SELECT post_id, post_title FROM post WHERE show_flg = 1 ORDER BY create_date DESC LIMIT 5";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($results);

// リスト作成
$new_post = '';
$new_post = $new_post . '<ul>';
foreach($results as $row) {
	$post_id = $row['post_id'];
	$new_post = $new_post . '<li>';
	$new_post = $new_post . '<a href="post.php?id=' . $post_id . '">';
	$new_post = $new_post . $row['post_title'];
	$new_post = $new_post . '</a>';
	$new_post = $new_post . '</li>';
}
$new_post = $new_post . '</ul>';
$pdo = null;

// ====================
// 人気記事
// ====================
$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
$sql = "SELECT pv.post_id, post.post_title, COUNT(pv.post_id) as pv_cnt FROM pv INNER JOIN post ON post.post_id = pv.post_id WHERE post.show_flg = 1 GROUP BY pv.post_id ORDER BY pv_cnt DESC LIMIT 10";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($results);

// リスト作成
$popular_post = '';
$popular_post = $popular_post . '<ul>';
foreach($results as $row) {
	$post_id = $row['post_id'];
	$popular_post = $popular_post . '<li>';
	$popular_post = $popular_post . '<a href="post.php?id=' . $post_id . '">';
	$popular_post = $popular_post . $row['post_title'];
	$popular_post = $popular_post . '</a>';
	$popular_post = $popular_post . '</li>';
}
$popular_post = $popular_post . '</ul>';
$pdo = null;

?>

<section id="sidebar_area">
	<div class="sidebar_item" id="new_post">
		<h3 class="sidebar_title">新着記事</h3>
		<?php echo $new_post ?>
	</div>
	<div class="sidebar_item" id="popular_post">
		<h3 class="sidebar_title">人気の記事</h3>
		<?php echo $popular_post ?>
	</div>
</section>