<?php
include('function.php');

$search = "";
if (isset($_POST['search'])) {
	$search = $_POST['search'];
}

$post_list = "";
if ("" != $search) {
	$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE post_title LIKE :search and show_flg=1 ORDER BY create_date DESC";
	$bind_info = array(array('var' => ':search', 'value' => "%$search%", 'param' => PDO::PARAM_STR));

	$results = sql_contact($sql, $bind_info);
	$post_list = create_post_list($results);
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