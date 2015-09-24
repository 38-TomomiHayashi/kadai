<?php

/*---------------------
カテゴリー名取得
in:  カテゴリーID(int)
out: カテゴリー名(str)
----------------------*/
function get_category ($category_id) {
	$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
	$sql = "SELECT category_name FROM category WHERE category_id = " . $category_id;
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if (isset($results)) {
		$category_name = $results[0]['category_name'];
	}
	$pdo = null;
	return $category_name;
}

/*---------------------
投稿者名取得
in:  投稿者ID(int)
out: 投稿者名(str)
----------------------*/
function get_poster ($poster_id) {
	$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
	$sql = "SELECT poster_name FROM poster WHERE poster_id = " . $poster_id;
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$poster_name = $results[0]['poster_name'];
	$pdo = null;
	return $poster_name;
}

/*---------------------
タグ名取得
in:  タグID(int)
out: タグ名(str)
----------------------*/
function get_tag ($tag_id) {
	$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
	$sql = "SELECT tag_name FROM tag WHERE tag_id = " . $tag_id;
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$tag_name = $results[0]['tag_name'];
	$pdo = null;
	return $tag_name;
}

/*---------------------
タグ取得
in:  記事ID(int)
out: タグ情報(array(tag_info(tag_id, tag_name))
----------------------*/
function get_tag_list ($post_id) {
	$pdo = new PDO("mysql:host=localhost;dbname=tech_news;charset=utf8", "root", "");
	$sql = "SELECT tag.tag_id, tag.tag_name FROM post_tag INNER JOIN tag ON post_tag.tag_id = tag.tag_id WHERE post_tag.post_id = " . $post_id;
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$tag_list = array();
	$tag_info = array();
	foreach ($results as $row) {
		$tag_info['tag_id'] = $row['tag_id'];
		$tag_info['tag_name'] = $row['tag_name'];
		array_push($tag_list, $tag_info);
	}
	$pdo = null;
	return $tag_list;
}

/*---------------------
記事リスト作成
in:  DB記事情報
out: HTML記事リスト
----------------------*/
function create_post_list ($results) {
	$post_list = "";
	foreach($results as $row) {
		$post_id = $row['post_id'];
		$post_image = ("" == $row['post_image']) ? 'img/image_none.png' : $row['post_image'];

		$post_list = $post_list . '<div class="post_short">';
		$post_list = $post_list . '<img src="' . $post_image . '">';
		$post_list = $post_list . '<div id="date">' . $row['format_date'] . '</div>';
		$post_list = $post_list . '<h3>' . '<a href="post.php?id=' . $post_id . '">' . $row['post_title'] . '</a></h3>';
		$post_list = $post_list . '<div id="detail">' . mb_substr($row['post_detail'], 0, 150) . ' ...</div>';
		$post_list = $post_list . '</div>';
	}
	return $post_list;
}

?>