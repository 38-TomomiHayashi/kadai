<?php
session_start();

if(isset($_SESSION['login'])) {
	if ($_SESSION['login'] == 1) {
		// echo('ログイン済み');
	}
	else {
		header("Location: login.php");
	}
} else {
	header("Location: login.php");
}
?>

<?php include('header.php'); ?>
<section id="admin_content_area">
	<dl class="dl_block">
		<dt>投稿者の皆さまへお知らせ</dt>
		<dd>
			<ul>
				<li>お知らせ１</li>
				<li>お知らせ２</li>
			</ul>
		</dd>
	</dl>
</section>
<?php include('footer.php'); ?>