<html>
<head>
<style>
	form {
		width: 800px;
		margin: 30px auto;
		padding: 10px;
		border: solid 1px #ccc;
		text-align: center;
	}
	dt {
		clear: both;
		float: left;
		width: 100px;
		text-align: right;
		line-height: 2.0em;
	}
	dd {
		margin-top: 6px;
		margin-left: 10px;
		float: left;
		text-align: left;
	}
	dl:after {
		content: "";
		display: block;
		clear: both;
	}
	.btn {
		width: 100px;
		text-align: rignt;
	}
</style>
</head>
<body>
<form action="input_execute.php" method="post">
	<dl>
		<dt>タイトル：</dt>
		<dd><input type="text" name="news_title" size="100" value="" /></dd>
		<dt>詳細：</dt>
		<dd><textarea name="news_detail" rows="10" cols="100"></textarea></dd>
		<dt>表示：</dt>
		<dd>
			<select name="show_flg">
				<option>ON</option>
				<option>OFF</option>
			</select>
		</dd>
		<dt>執筆者：</dt>
		<dd><input type="text" name="author" value="" /></dd>
	</dl>
	<input class="btn" type="submit" />
</form>
</body>
</html>