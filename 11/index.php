<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>index</title>
<script src="js/jquery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){

	$("button").click(function() {
		$("#msg").html("位置情報取得中．．．");
		
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(
				// 位置情報取得成功
				function(pos) {
					var lat = pos.coords.latitude;
					var lon = pos.coords.longitude;

					// 位置情報を追加してSubmit
					$("input[name=lat]").attr("value",lat);
					$("input[name=lon]").attr("value",lon);
					$("form").submit();
					
				}

				, // 位置情報取得失敗
				function(error) {
					var message = "";
					alert(error.code);
				}
			);
		} else {
			alert("このブラウザではGeolocationが使えません。");
		}
	});
});
</script>
</head>
<body>
	<header>
		<h2>マッハDEクーポン</h2>
	</header>
	<form action="rest_list.php" method="post">
  		<input type="text" name="keyword" value="" placeholder="検索キーワード">
		<input type="hidden"  name="lat" value="">
		<input type="hidden"  name="lon" value="">
		<input type="text" name="dummy" style="display:none"><!-- Enterで送信されないようにダミー配置 -->
	</form>
	<button>近くのお店を検索</button>
	<div id="msg"> </div>
</body>
</html>