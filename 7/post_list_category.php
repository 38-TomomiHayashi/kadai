<?php

include('function.php');

$category_id = 0;
if (isset($_GET['id'])) {
	$category_id = (int)$_GET['id'];
}

$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE category_id=" . $category_id . " and show_flg=1 ORDER BY create_date DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$post_list = create_post_list($results);
$category_name = get_category($category_id);

$pdo = null;
?>

<?php include('header.php'); ?>
<section id="content_area">
	<section id="main_area">
		<div>カテゴリー：<?php echo $category_name ?></div>
		<?php echo $post_list ?>
	</section>
	<?php include('sidebar.php'); ?>
</section>
<?php include('footer.php'); ?>