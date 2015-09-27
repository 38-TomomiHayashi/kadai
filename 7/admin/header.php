<!DOCTYPE html>
<html>
<head>
	<title>Tech. News</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css">
	<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>
</head>
<body>
	<header>
		<h1><a href="../index.php">TECH. NEWS</a></h1>
		<div class="text_right">
			<!--<div class="btn" id="logoff_btn">ログオフ</div>-->
			<form action="logoff.php" method="post">
				<!--<input type="submit" name="logoff" value="ログオフ" style="visibility:hidden;">-->
				<input class="btn" type="submit" name="logoff_btn" value="ログオフ">
			</form>
		</div>
	</header>
	<section id="menu_area">
		<ul id="menu">
			<li><a href="index.php">トップ</a>
			</li>
			<li class="drop_menu"><a>記事管理</a>
				<ul>
					<li><a href="input.php">新規投稿</a></li>
					<li><a href="update.php">記事更新</a></li>
				</ul>
			</li>
			<li><a href="user_manage.php">ユーザー管理</a></li>
			<li><a href="setting.php">設定</a></li>
			<li class="menu_margin"><a>　</a></li>
		</ul>
	</section>