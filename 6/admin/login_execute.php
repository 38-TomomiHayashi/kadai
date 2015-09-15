<?php
session_start();

$name = "";
$password = "";
if (isset($_POST['name'])) {
	$name = $_POST["name"];
}
if (isset($_POST['password'])) {
	$password = $_POST["password"];
}

// password.jsonから読み込み
$json = file_get_contents('password.json');
$array = json_decode($json,true);
$regist_name = $array["name"];
$regist_password = $array["password"];

//var_dump($array);
//var_dump($regist_name);
//var_dump($regist_password);

if(($name === $regist_name) & ($password === $regist_password)) {
	$_SESSION['login'] = 1;
	header("Location: index.php");
} else {
	$msg = "ログインに失敗しました";
}
?>

<?php include('header.php'); ?>
<div class="message"></div><?php echo $msg ?></div>
<?php include('footer.php'); ?>