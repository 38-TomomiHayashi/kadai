<?php include('header.php'); ?>
<form id="form_input" action="input_execute.php" method="post">
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
<?php include('footer.php'); ?>