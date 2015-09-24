<?php
include('function.php');

$tag_id = 0;
if (isset($_GET['id'])) {
	$tag_id = (int)$_GET['id'];
}

$sql = "SELECT post.post_id, DATE_FORMAT(post.create_date,'%Y.%m.%d') as format_date, post.post_image, post.post_title, post_detail FROM post INNER JOIN post_tag ON post.post_id = post_tag.post_id WHERE post_tag.tag_id = :tag_id";
$bind_info = array(array('var' => ':tag_id', 'value' => $tag_id, 'param' => PDO::PARAM_INT));

$results = sql_contact($sql, $bind_info);
$post_list = create_post_list($results);
$tag_name = get_tag($tag_id);

?>

<?php include('header.php'); ?>
<section id="content_area">
	<section id="main_area">
		<div>タグ：<?php echo $tag_name ?></div>
		<?php echo $post_list ?>
	</section>
	<?php include('sidebar.php'); ?>
</section>
<?php include('footer.php'); ?>