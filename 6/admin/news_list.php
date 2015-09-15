<?php 

// 検索文字列取得
$search = '';
if (isset($_POST['search'])) {
	$search = $_POST['search'];
	echo '「' . $search . '」で検索...';
}

// 表示ページ数取得
define('NEWS_VIEW', 5);
$page = intval($_GET['page']);
$news_start = ($page - 1) * NEWS_VIEW;

// ====================
// ニュース一覧表示
// ====================
$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
if ($search != "") {
	// 検索ありの場合。あいまい検索で該当するニュースをn件取得する
	$sql = "SELECT news_id, DATE_FORMAT(create_date,'%Y.%m.%d') AS format_date, news_title, show_flg FROM news WHERE news_title LIKE :search ORDER BY create_date DESC LIMIT " . NEWS_VIEW . " OFFSET " . $news_start;
} else {
	// 検索なしの場合。すべてのニュースをn件取得する
	$sql = "SELECT news_id, DATE_FORMAT(create_date,'%Y.%m.%d') AS format_date, news_title, show_flg FROM news ORDER BY create_date DESC LIMIT " . NEWS_VIEW . " OFFSET " . $news_start;
}
$stmt = $pdo->prepare($sql);
if ($search != "") {
	$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// HTML作成
$view = '';
$view = $view . '<table border="1" width="900" cellspacing="0" cellpadding="5" bordercolor="#ccc">';
$view = $view . '<tr>';
$view = $view . '<th width="100">投稿日</th>';
$view = $view . '<th width="600">タイトル</th>';
$view = $view . '<th width="100">表示</th>';
$view = $view . '<th width="100">編集</th>';
$view = $view . '</tr>';
foreach($results as $row) {
	$news_id = $row['news_id'];
	$view = $view . '<tr>';
	$view = $view . '<td>';
	$view = $view . $row['format_date'];
	$view = $view . '</td>';
	$view = $view . '<td class="news-title">';
	$view = $view . $row['news_title'];
	$view = $view . '</td>';
	$view = $view . '<td>';
	$view = $view . ($row['show_flg'] == 1 ? 'ON' : 'OFF');
	$view = $view . '</td>';
	$view = $view . '<td>';
	$view = $view . '<a href="update.php?news_id=' . $news_id . '">編集</a>';
	$view = $view . '</td>';
	$view = $view . '</tr>';
}
$view = $view . '</table>';

// ====================
// ページング表示
// ====================
// ニュースの総数取得
if ($search != "") {
	$sql = "SELECT COUNT(news_id) AS cnt FROM news WHERE (show_flg = 1) AND (news_title LIKE :search)";
} else {
	$sql = "SELECT COUNT(news_id) AS cnt FROM news WHERE show_flg = 1";
}
$stmt = $pdo->prepare($sql);
if ($search != "") {
	$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 最大ページ数計算
$news_cnt = $results[0]['cnt'];
$max_page = ceil($news_cnt / NEWS_VIEW);

$view = $view . '<div id="page_change">';

// 現在1ページ目以外なら「前のn件」表示
if ($page != 1) {
	$view = $view . '<div id="prev"><a href="news_list.php?page=' . (intval($_GET['page']) - 1) . '">前の'. NEWS_VIEW . '件</a></div>';
} else {
	$view = $view . '<div id="prev">　</div>';
}

// 「現在のページ数 / 最大ページ数」表示
$view = $view. '<div id="page">' . $page . ' / ' . $max_page . '</div>';

// 現在最終ページ以外なら「次のn件」表示
if ($max_page != $page) {
	$view = $view . '<div id="next"><a href="news_list.php?page=' . (intval($_GET['page']) + 1) . '">次の' . NEWS_VIEW . '件</a></div>';
}
$view = $view . '</div>';

$pdo = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
	<style>
		.list {
			width: 900px;
		}
		.search {
			width: 900px;
			text-align: right;
		}
		table {
		}
		#page_change {
		}
		#prev {
			float: left;
			width: 100px;
			text-align: center;
		}
		#page {
			float: left;
			width: 700px;
			text-align: center;
		}
		#next {
			float: left;
			width: 100px;
			text-align: center;
		}
	</style>
</head>
<body>
    <header></header>
    
	<section class="search">
		<form action="news_list.php?page=1" method="post">
			検索：<input type="text" name="search" value="" />
		</form>
	</section>
	<section class="list">
        <h2></h2>
        <?php echo $view ?>
    </section>

    <footer></footer>

    <!--end #information-->
</body>
</html>