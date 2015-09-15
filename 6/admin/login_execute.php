<?php
session_start();

$name = $_POST["name"];
$password = $_POST["password"];

/* データベースからユーザ名＆パスワード取得（未テスト）
$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
$sql = "SELECT * FROM user WHERE name = $:name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$regist_name = $results[0]['name'];
$regist_password = $results[0]['password'];

$pdo = null;
*/

// password.txtから読み込み

// とりあえず直書き
$regist_name = 'admin';
$regist_password = 'password';

if(($name == $regist_name) & ($password == $regist_password)) {
	$_SESSION['login'] = 1;
	header("Location: index.php");
} else {
	echo "ログインに失敗しました";
}
?>
<html>
<head>
</head>
<body>
</body>
</html>