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
<h2>アンケート</h2>
<div id="ancate">
<form action="comfirm_enq.php" method="post">
	<dl id="entry-form">
		<dt><label for="name">氏名</label></dt>
		<dd><input type="text" name="name" id="name"></dd>

		<dt><label for="age">年齢</label></dt>
		<dd><input type="number" name="age" id="age"></dd>

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

<?php 
if (isset($_POST["submit"])) {   
    if (empty($_POST["name"]) || empty($_POST["age"])
				|| empty($_POST["sex"]) || empty($_POST["hobby"])) {   
      window.ale("未入力の項目があります。");  
      exit();  
    }
} 
?> 