<?php 
session_start();

$name = "";
$age = "";
$sex = "";
$hobby = array();

// 「送信する」ボタン押下時の入力チェック
$errors = array();
if (isset($_POST['submit'])) {	
	if ($_POST['name'] === "") {
		$errors['name'] = "氏名が入力されていません。";
	} else {
		$name = $_POST['name'];
	}
	
	if ($_POST['age'] === "") {
		$errors['age'] = "年齢が入力されていません。";
	} else {
		$age = $_POST['age'];
	}
	
	if (!isset($_POST['sex'])) {
		$errors['sex'] = "性別が選択されていません。";
	} else {
		$sex = $_POST['sex'];
	}
	
	if (!isset($_POST['hobby'])) {
		$errors['hobby'] = "趣味が選択されていません。";
	} else {
		$hoby = $_POST['hoby'];
	}
	
	// 入力エラーがなければ次のページに移動
	if (empty($errors)) {
		$_SESSION['enq'] = $_POST;
		header("Location: comfirm_enq.php");
		exit();
	}
}
?> 

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>アンケート</title>
<style>
	#ancate {
		width: 500px;
		height: auto;
		margin: 30px auto;
		border: solid 1px #cccccc;
		padding: 20px;
	}
	#message {
		color: red;
		width: 500px;
		margin: 0 auto;
	}
</style>
</head>
<body>
<h2>アンケート</h2>
<div id="message">
<ul>
<?php
foreach($errors as $message){
    echo "<li>"; 
    echo $message;
    echo "</li>"; 
}
?>
</ul>
</div>
<div id="ancate">
	<form action="input_enq.php" method="post">
	<dl id="entry-form">
		<dt><label for="name">氏名</label></dt>
		<dd><input type="text" name="name" id="name" 
				   value="<?php echo $name ?>"></dd>

		<dt><label for="age">年齢</label></dt>
		<dd><input type="number" name="age" id="age" 
				   value="<?php echo $age ?>"></dd>

		<dt><label>性別</label></dt>
		<dd>
			<div id="sex">
				<input type="radio" name="sex" value="男性" id="male">
				<label for="male">男性</label><br>
				<input type="radio" name="sex" value="女性" id="female">
				<label for="female">女性</label><br>
			</div>
		</dd>
		
		<dt><label>趣味</label></dt>
		<dd>
			<div id="hobby">
				<input type="checkbox" name="hobby[]" value="読書" id="book">
				<label for="book">読書</label><br>
				<input type="checkbox" name="hobby[]" value="散歩" id="walking">
				<label for="walking">散歩</label><br>
			</div>
		</dd>
	</dl>
	<input type="submit" name="submit" value="送信する">
</form>
</div>

</body>
</html>