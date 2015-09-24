<?php

// 新着順に記事リストを表示
$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE show_flg=1 ORDER BY create_date DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$post_list = "";
foreach($results as $row) {
	$post_id = $row['post_id'];
	$post_image = ("" == $row['post_image']) ? 'img/image_none.png' : $row['post_image'];
	$post_list = $post_list . '<div class="post_short">';
	$post_list = $post_list . '<img src="' . $post_image . '">';
	$post_list = $post_list . '<div id="date">' . $row['format_date'] . '</div>';
	$post_list = $post_list . '<h3>' . '<a href="post.php?id=' . $post_id . '">' . $row['post_title'] . '</a></h3>';
	$post_list = $post_list . '<div id="detail">' . mb_substr($row['post_detail'], 0, 150) . ' ...</div>';
	$post_list = $post_list . '</div>';
}
$pdo = null;

// ====================
// TOP記事
// ====================
// TOPに載せたい記事idを配列で指定
/*
$top_post_id = array(1, 3);
$top_post = '';

$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");

foreach($top_post_id as $id) {
	$sql = "SELECT post_image, post_title, post_detail FROM post WHERE post_id =" . $id;
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$top_post = $top_post . '<div class="post_short">';
	foreach($results as $row) {
		$post_image = ("" == $row['post_image']) ? 'img/image_none.png' : $row['post_image'];
		$top_post = $top_post . '<img src="' . $post_image . '">';
		$top_post = $top_post . '<h3>' . $row['post_title'] . '</h3>';
		$top_post = $top_post . '<div>' . $row['post_detail'] . '</div>';
	}
	$top_post = $top_post . '</div>';
}

$pdo = null;
*/
?>

<?php include('header.php'); ?>
<section id="content_area">
	<section id="main_area">
		<?php echo $post_list ?>
	</section>
	<?php include('sidebar.php'); ?>
</section>
<?php include('footer.php'); ?>