<?php
include('function.php');

$category_id = 0;
$tag_id = 0;
$poster_id = 0;
$search = "";

$refine = "";

$sql = "";
$bind_info = null;

// カテゴリーで絞り込み
if (isset($_GET['category_id'])) {
	$category_id = (int)$_GET['category_id'];
	$refine = 'カテゴリー：' . getCategory($category_id);
	$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE category_id= :category_id and show_flg=1 ORDER BY create_date DESC";
	$bind_info = array(array('var' => ':category_id', 'value' => $category_id, 'param' => PDO::PARAM_INT));
}

// タグで絞り込み
else if (isset($_GET['tag_id'])) {
	$tag_id = (int)$_GET['tag_id'];
	$refine = 'タグ：' . getTag($tag_id);
	$sql = "SELECT post.post_id, DATE_FORMAT(post.create_date,'%Y.%m.%d') as format_date, post.post_image, post.post_title, post_detail FROM post INNER JOIN post_tag ON post.post_id = post_tag.post_id WHERE post_tag.tag_id = :tag_id";
	$bind_info = array(array('var' => ':tag_id', 'value' => $tag_id, 'param' => PDO::PARAM_INT));
	
}

// 投稿者で絞り込み
else if (isset($_GET['poster_id'])) {
	$poster_id = (int)$_GET['poster_id'];
	$refine = '投稿者：' . getPoster($poster_id);
	$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE poster_id= :poster_id and show_flg=1 ORDER BY create_date DESC";
	$bind_info = array(array('var' => ':poster_id', 'value' => $poster_id, 'param' => PDO::PARAM_INT));
}

// 検索結果で絞り込み
else if (isset($_POST['search'])) {
	$search = $_POST['search'];
	$refine = "検索：" . $search;
	$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE post_title LIKE :search and show_flg=1 ORDER BY create_date DESC";
	$bind_info = array(array('var' => ':search', 'value' => "%$search%", 'param' => PDO::PARAM_STR));
}

// 絞り込み条件がない場合は、新着順にすべての記事を表示
else {
	$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE show_flg=1 ORDER BY create_date DESC";
}

$results = sqlContact($sql, $bind_info);
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

?>

<?php include('header.php'); ?>
<section id="content_area">
	<section id="main_area">
		<div><?php echo $refine ?></div>
		<?php echo $post_list ?>
	</section>
	<?php include('sidebar.php'); ?>
</section>
<?php include('footer.php'); ?>