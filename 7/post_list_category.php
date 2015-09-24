<?php
include('function.php');

$category_id = 0;
if (isset($_GET['id'])) {
	$category_id = (int)$_GET['id'];
}

$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE category_id= :category_id and show_flg=1 ORDER BY create_date DESC";
$bind_info = array(array('var' => ':category_id', 'value' => $category_id, 'param' => PDO::PARAM_INT));

$results = sql_contact($sql, $bind_info);
$post_list = create_post_list($results);
$category_name = get_category($category_id);
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