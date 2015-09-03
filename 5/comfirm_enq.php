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
</style>
</head>
<body>
<h2>アンケート入力内容確認</h2>
<p>以下の内容で送信してよろしいですか？</p>
<div id="ancate">
<form action="input_finish.php" method="post">
	<dl id="entry-form">
		<dt><label for="name">氏名</label></dt>
		<dd><input type="text" name="name" id="name" readonly="readonly"
							 value="<?php echo $_POST["name"]; ?>" ></dd>

		<dt><label for="age">年齢</label></dt>
		<dd><input type="number" name="age" id="age" readonly="readonly"
							 value="<?php echo $_POST["age"]; ?>" ></dd>

		<dt><label>性別</label></dt>
		<dd><input type="text" name="sex" id="sex" readonly="readonly"
							 value="<?php echo $_POST["sex"]; ?>" ></dd>
		
		<dt><label>趣味</label></dt>
		<dd><input type="text" name="hobby" id="hobby" readonly="readonly"
							 value="<?php echo implode('/', $_POST["hobby"]); ?>" ></dd>
	</dl>
	<input type="submit" value="送信する">
</form>
</div>

</body>
</html>