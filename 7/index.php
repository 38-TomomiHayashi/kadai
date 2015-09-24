<?php
include('function.php');

// 新着順に記事リストを表示
$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE show_flg=1 ORDER BY create_date DESC";
$results = sql_contact($sql);
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
		<?php echo $post_list ?>
	</section>
	<?php include('sidebar.php'); ?>
</section>
<?php include('footer.php'); ?>