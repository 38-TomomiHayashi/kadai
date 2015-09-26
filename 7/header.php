<!DOCTYPE html>
<html>
<head>
	<title>Tech. News</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header>
		<h1><a href="index.php">TECH. NEWS</a></h1>
		<div class="text_right" id="search">
			<form action="post_list_search.php" method="post">
				<input type="text" name="search" value="" />
				<input type="submit" name="search_btn" value="検索">
			</form>
		</div>
	</header>
	<section id="menu_area">
		<ul id="menu">
			<li><a href="index.php">トップ</a></li>
			<li><a href="post_list.php?category_id=1">ニュース</a></li>
			<li><a href="post_list.php?category_id=2">コラム</a></li>
			<li><a href="post_list.php?category_id=3">連載</a></li>
		</ul>
		<ul id="submenu">
			<li><a href="post_list.php?tag_id=1">HTML5</a></li>
			<li><a href="post_list.php?tag_id=2">CSS3</a></li>
			<li><a href="post_list.php?tag_id=3">JavaScript</a></li>
			<li><a href="post_list.php?tag_id=4">PHP</a></li>
		</ul>
	</section>