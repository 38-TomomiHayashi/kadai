<?php
session_start();
$result = session_destroy();

if ($result) {
	$msg = 'ログオフしました。';
} else {
	$msg = 'ログオフに失敗しました。';
}
?>

<?php include('header.php'); ?>
<div class="message"></div><?php echo $msg ?></div>
<?php include('footer.php'); ?>