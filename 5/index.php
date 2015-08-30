<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<form action="xxx.php" method="post">
	<dl id="entry-form">
			<dt><label for="name">氏名</label></dt>
			<dd><input type="text" name="name" id="name"></dd>

			<dt><label for="age">年齢</label></dt>
			<dd><input type="text" name="age" id="age"></dd>

			<dt><label for="sex">性別</label></dt>
			<dd>
					<select name="sex">
							<option>男性</option>
							<option>女性</option>
					</select>
			</dd>

			<dt><label>趣味</label></dt>
			<dd>
					<div id="hoby">
							<input type="radio" name="hoby" value="startup" id="startup">
							<label for="startup">読書</label><br>
							<input type="radio" name="hoby" value="job" id="job">
							<label for="job">散歩</label><br>
					</div>
			</dd>
	</dl>
	<p id="entry-buttun">
			<input type="image" src="./img/btn-entry.png" alt="ENTRY" id="entry-btn">
	</p>
</form>

</body>
</html>