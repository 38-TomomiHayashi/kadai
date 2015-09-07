<?php
$news_id = $_GET['news_id'];

$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
$sql = "SELECT news_id, DATE_FORMAT(create_date,'%Y.%m.%d') as format_date, news_title, news_detail FROM news WHERE news_id = " . $news_id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$date = $results[0]['format_date'];
$title = $results[0]['news_title'];
$detail = nl2br($results[0]['news_detail']);

$pdo = null;
?>

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
            <span class="section-title-ja text-center"><?php echo $date ?></span>
        </h2>
        <article class="news-detail">
            <dl class="clearfix">
                <dt class="news-title"><?php echo $title ?></dt>
                <dd><?php echo $detail ?></dd>
            </dl>
            
        </article>
    </section>

    <!--#information-->
    <?php include('footer.php'); ?>

    <!--end #information-->
<p class="btn-pageTop"><a href="#"><img src="img/btn-pagetop.png" alt=""></a></p>
</body>
</html>