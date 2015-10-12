<?php
require("config.php");

// お店の検索範囲を指定（ぐるなびAPIでは最小半径300mになるため、自力で範囲を狭める）
define("SEARCH_RANGE_LAT", 0.001);	// 0.001で50mくらい？
define("SEARCH_RANGE_LON", 0.0005);	// 0.0005で50mくらい？

$lat = 0.0;
$lon = 0.0;
if (isset($_GET['lat'])) {
	$lat = $_GET["lat"];
}
if (isset($_GET['lon'])) {
	$lon = $_GET["lon"];
}

if ($lat != 0.0 && $lon != 0.0) {
	
	////////////////////////////////////////////
	// テスト用。吉祥寺のコピスにいることにする。
	$lat = 35.704719;
	$lon = 139.579049;
	////////////////////////////////////////////
	
	/*****************************************************************************************
	  ぐるなびWebサービスのレストラン検索APIで緯度経度検索を実行しパースするプログラム
	  注意：緯度、経度、範囲の値は固定で入れています。
		 アクセスキーはユーザ登録時に発行されたキーを指定してください。
	*****************************************************************************************/

	//エンドポイントのURIとフォーマットパラメータ
	$uri   = "http://api.gnavi.co.jp/RestSearchAPI/20150630/";
	//APIアクセスキー
	$acckey = $key_id;
	//返却値のフォーマット
	$format= "json";
	//範囲
	$range = 1;
	// 測定モード
	$mode = 2;
	// 最大取得件数（500件までしか動作しない様子）
	$rest_num = 500;

	//URL組み立て
	$url = $uri . "?format=" .  $format .  "&keyid=" .  $acckey .  "&latitude=" .  $lat . "&longitude=" . $lon . "&range=" . $range . "&input_coordinates_mode=" . $mode . "&coordinates_mode=" . $mode . "&hit_per_page=" . $rest_num;
	
	//API実行
	$json = file_get_contents($url);
	//取得した結果をオブジェクト化
	$obj  = json_decode($json);

	//結果をパース
	$all_rest_data = array();
	foreach((array)$obj as $key => $val){
		/*
	   if(strcmp($key, "total_hit_count" ) == 0 ){
		   echo "total:".$val."\n";
	   }
	   */

	   if(strcmp($key, "rest") == 0){
		   foreach((array)$val as $restArray){
				// 検索結果を配列に格納
				$rest_data = new restData();
				if(checkString($restArray->{'id'})) $rest_data->id = $restArray->{'id'};
				if(checkString($restArray->{'name'})) $rest_data->name = $restArray->{'name'};
				if(checkString($restArray->{'latitude'})) $rest_data->latitude = $restArray->{'latitude'};
				if(checkString($restArray->{'longitude'})) $rest_data->longitude = $restArray->{'longitude'};
				if(checkString($restArray->{'coupon_url'}->{'mobile'})) $rest_data->coupon_url = $restArray->{'coupon_url'}->{'mobile'};
				array_push($all_rest_data, $rest_data);
		   }
		   // var_dump($all_rest_data);

	   }
	}
	
	// 近くのお店を表示する
	$view = "<ul id='rest-list'>";
	foreach($all_rest_data as $rest_data) {
		// お店の座標と現在地の差を計算
		$diff_lat = abs($rest_data->latitude - $lat);
		$diff_lon = abs($rest_data->longitude - $lon);
		
		// 指定範囲以内にお店があれば表示
		if (($diff_lat <= SEARCH_RANGE_LAT) && ($diff_lon <= SEARCH_RANGE_LON) && ($rest_data->coupon_url != "")) {
			$view .= "<li><a href='";
			$view .= $rest_data->coupon_url;
			$view .= "'>";
			$view .= $rest_data->name;
			$view .= "</li>";
		}
	}
	$view .= "</ul>";
}

//文字列であるかをチェック
function checkString($input) {
	if(isset($input) && is_string($input)) {
		return true;
	}else{
		return false;
	}
}

// レストランデータクラス
class restData {
	public $id = 0;
	public $name = "";
	public $latitude  = 0.0;
	public $longitude  = 0.0;
	public $coupon_url = "";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>index</title>
<script src="js/jquery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
	// 現在のurl取得
	var url = window.location.search;
	
	// クエリパラメータ有無を判定
	if (url.indexOf("?") == -1) {
		
		$("#view").html("近くのお店を検索中です．．．");
	
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(
				// 位置情報取得成功
				function(pos) {
					var lat = pos.coords.latitude;
					var lon = pos.coords.longitude;

					// クエリパラメータを追加してリロード
					document.location = "index.php?lat=" + lat + "&lon=" + lon;
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
	}
});
</script>
</head>
<body>
	<div id="view"><?php echo $view?></div>
</body>
</html>