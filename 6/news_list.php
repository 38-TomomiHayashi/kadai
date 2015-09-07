<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('header.php'); ?>
    
    <section class="news contents-box">
        <h2 class="section-title text-center">
            <span class="section-title__yellow">News</span>
        </h2>
        <article class="news-detail">
            <dl class="clearfix">
				<?php 
				define('NEWS_VIEW', 5);
				$news_start = (intval($_GET['page']) - 1) * NEWS_VIEW;	// 最新n+1番目のニュースから表示
				$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");

				// ニュースn件表示
				$sql = "SELECT news_id, DATE_FORMAT(create_date,'%Y.%m.%d') AS format_date, news_title, news_detail FROM news ORDER BY create_date DESC LIMIT " . NEWS_VIEW . " OFFSET " . $news_start;
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach($results as $row) {
					$news_id = $row['news_id'];
					echo '<dt>';
					echo $row['format_date'];
					echo '</dt>';
					echo '<dd class="news-title">';
					echo $row['news_title'];
					echo '</dd>';
					echo '<a href="news.php?news_id=' . $news_id . '">';
					echo '<dd class="news-description">';
					echo mb_substr($row['news_detail'], 0, 150);
					if (mb_strlen($row['news_detail']) > 150) {echo ' ...';}
					echo '</dd>';
					echo '</a>';
					echo'<hr>';
				}

				// 「前のn件」「次のn件」リンク表示
				$sql = "SELECT COUNT(news_id) AS cnt FROM news WHERE show_flg = 1";
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$news_cnt = $results[0]['cnt'];
				if ($news_start != 0) {
					echo '<a href="news_list.php?page=' . (intval($_GET['page']) - 1) . '">前の'. NEWS_VIEW . '件</a>';
				}
				if ($news_cnt > ($news_start + NEWS_VIEW)) {
					echo '<div class="news-next"><a href="news_list.php?page=' . (intval($_GET['page']) + 1) . '">次の' . NEWS_VIEW . '件</a></div>';
				}
				$pdo = null;
				?>
            </dl>
            
        </article>
    </section>

    <!--#information-->
    <?php include('footer.php'); ?>

    <!--end #information-->
<p class="btn-pageTop"><a href="#"><img src="img/btn-pagetop.png" alt=""></a></p>
</body>
</html>