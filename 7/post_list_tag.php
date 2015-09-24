<?php

include('function.php');

$tag_id = 0;
if (isset($_GET['id'])) {
	$tag_id = (int)$_GET['id'];
}

$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
$sql = "SELECT post.post_id, DATE_FORMAT(post.create_date,'%Y.%m.%d') as format_date, post.post_image, post.post_title, post_detail FROM post INNER JOIN post_tag ON post.post_id = post_tag.post_id WHERE post_tag.tag_id = " . $tag_id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$post_list = create_post_list($results);
$tag_name = get_tag($tag_id);

$pdo = null;
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