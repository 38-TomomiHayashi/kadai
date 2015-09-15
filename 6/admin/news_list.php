<?php 
define('NEWS_VIEW', 10);	// 1ページに表示する件数

// 検索文字列取得
$search = '';
if (isset($_POST['search'])) {
	$search = $_POST['search'];
	//echo '「' . $search . '」で検索...';
}

// 表示ページ数取得
$page = 1;
if (isset($_GET['page'])) {
	$page = intval($_GET['page']);
}
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

// table作成
$view = '';
$view = $view . '<table>';
$view = $view . '<tr>';
$view = $view . '<th>投稿日</th>';
$view = $view . '<th>タイトル</th>';
$view = $view . '<th>表示</th>';
$view = $view . '<th>編集</th>';
$view = $view . '</tr>';
foreach($results as $row) {
	$news_id = $row['news_id'];
	$view = $view . '<tr>';
	$view = $view . '<td id="table_date">';
	$view = $view . $row['format_date'];
	$view = $view . '</td>';
	$view = $view . '<td id="table_title">';
	$view = $view . $row['news_title'];
	$view = $view . '</td>';
	$view = $view . '<td id="table_view">';
	$view = $view . ($row['show_flg'] == 1 ? 'ON' : 'OFF');
	$view = $view . '</td>';
	$view = $view . '<td id="table_edit">';
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

// 現在1ページ目以外なら「前のn件」表示
$view_page = "";
if ($page != 1) {
	$view_page = $view_page . '<a href="news_list.php?page=' . ($page - 1) . '">前へ</a>';
} else {
	$view_page = $view_page . '前へ';
}

// 「現在のページ数 / 最大ページ数」表示
$view_page = $view_page . '　　' . $page . ' / ' . $max_page . '　　';

// 現在最終ページ以外なら「次のn件」表示
if ($max_page != $page) {
	$view_page = $view_page . '<a href="news_list.php?page=' . ($page + 1) . '">次へ</a>';
} else {
	$view_page = $view_page . '次へ';
}

$pdo = null;
?>

<?php include('header.php'); ?>

<section class="search">
	<form action="news_list.php?page=1" method="post">
		検索：<input type="text" name="search" value="" />
	</form>
</section>
<section class="news_list">
	<?php echo $view ?>
</section>
<section class="page">
	<?php echo $view_page ?>
</section>

<?php include('footer.php'); ?>