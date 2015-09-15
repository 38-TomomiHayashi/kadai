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
<section class="logoff">
	<form id="logoff" action="logoff.php" method="post">
		<input class="btn" type="submit" value="ログオフ" />
	</form>
</section>
<section class="menu">
	<ol>
	<li><a href="input.php">ニュース新規追加</a></li>
	<li><a href="news_list.php?page=1">ニュース一覧（更新はここから）</a></li>
	<!-- <li><a href="search_ps.php">ニュース検索</a></li> -->
	</ol>
</section>
<?php include('footer.php'); ?>