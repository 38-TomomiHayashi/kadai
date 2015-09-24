<?php
include('function.php');

$poster_id = 0;
if (isset($_GET['id'])) {
	$poster_id = (int)$_GET['id'];
}

$sql = "SELECT post_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, post_image, post_title, post_detail FROM post WHERE poster_id= :poster_id and show_flg=1 ORDER BY create_date DESC";
$bind_info = array(array('var' => ':poster_id', 'value' => $poster_id, 'param' => PDO::PARAM_INT));

$results = sql_contact($sql, $bind_info);
$post_list = create_post_list($results);
$poster_name = get_poster($poster_id);

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