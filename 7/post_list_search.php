<?php

include('function.php');
$search = "";
$post_list = "";

if (isset($_POST['search'])) {
	$search = $_POST['search'];
}

if ("" != $search) {
	$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
	$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE post_title LIKE :search and show_flg=1 ORDER BY create_date DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$post_list = create_post_list($results);

	$pdo = null;
}
?>

<?php include('header.php'); ?>
<section id="content_area">
	<section id="main_area">
		<div>検索："<?php echo $search ?>"</div>
		<?php echo $post_list ?>
	</section>
	<?php include('sidebar.php'); ?>
</section>
<?php include('footer.php'); ?>