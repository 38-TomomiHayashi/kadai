<?php
include('function.php');

$post_id = 0;
if (isset($_GET['id'])) {
	$post_id = (int)$_GET['id'];
}

$sql = "SELECT DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_title, post_detail, category_id, post_image, poster_id FROM post WHERE post_id = :post_id";
$bind_info = array(array('var' => ':post_id', 'value' => $post_id, 'param' => PDO::PARAM_INT));
$results = sql_contact($sql, $bind_info);

$date = $results[0]['format_date'];
$image = ("" == $results[0]['post_image']) ? 'img/image_none.png' : $results[0]['post_image'];
$title = $results[0]['post_title'];
$detail = nl2br($results[0]['post_detail']);
$category_id = $results[0]['category_id'];
$poster_id = $results[0]['poster_id'];

// カテゴリー取得
$category_name = get_category($category_id);

// 投稿者取得
$poster_name = get_poster($poster_id);

// タグリスト取得
$tag_list = get_tag_list($post_id);

// メタ情報作成
$meta = "";
$meta = $meta . 'by.' . '<a href="post_list_poster.php?id=' . $poster_id . '">' . $poster_name . '</a>';
$meta = $meta . '　';
$meta = $meta . 'カテゴリー：<a href="post_list_category.php?id=' . $category_id . '">' . $category_name . '</a>';
if (0 != count($tag_list)) {
	$meta = $meta . '　タグ：';
	foreach ($tag_list as $tag_info) {
		$meta = $meta . '<a href="post_list_tag.php?id=' . $tag_info['tag_id'] . '">' . $tag_info['tag_name'] . '</a>';
		$meta = $meta . '　';
	}
}

//====================
// 閲覧数設定
//====================
$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
$sql = "INSERT INTO pv (post_id, pv_date) VALUES (:post_id, sysdate()) ";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
$result = $stmt->execute();
$pdo = null;

?>

<?php include('header.php'); ?>
<section id="content_area">
	<section id="main_area">
		<div id="post">
			<div id="post_image"><img src="<?php echo $image ?>"></div>
			<div id="post_date"><?php echo $date ?></div>
			<h2><?php echo $title?></h2>
			<div id="post_meta"><?php echo $meta ?></div>
			<div id="post_detail"><?php echo $detail ?></div>
		</div>
	</section>
	<?php include('sidebar.php'); ?>
</section>
<?php include('footer.php'); ?>