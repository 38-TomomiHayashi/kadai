<?php

include('function.php');

$poster_id = 0;
if (isset($_GET['id'])) {
	$poster_id = (int)$_GET['id'];
}

$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE poster_id=" . $poster_id . " and show_flg=1 ORDER BY create_date DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$post_list = create_post_list($results);
$poster_name = get_poster($poster_id);

$pdo = null;
?>

<?php include('header.php'); ?>
<section id="content_area">
	<section id="main_area">
		<div>投稿者：<?php echo $poster_name ?></div>
		<?php echo $post_list ?>
	</section>
	<?php include('sidebar.php'); ?>
</section>
<?php include('footer.php'); ?>