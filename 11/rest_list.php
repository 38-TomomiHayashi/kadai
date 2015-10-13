<?php
require("config.php");

// お店の検索範囲を指定（ぐるなびAPIでは最小半径300mになるため、自力で範囲を狭める）
define("SEARCH_RANGE_LAT", 0.1);	// 0.001で50mくらい？
define("SEARCH_RANGE_LON", 0.1);	// 0.0005で50mくらい？

$keyword = "";
$lat = 0.0;
$lon = 0.0;
$view = "<a href='index.php'>TOPへ</a><br>";
$hit_count = 0;

if (isset($_POST['keyword'])) {
	$keyword = $_POST['keyword'];
}
if (isset($_POST['lat'])) {
	$lat = $_POST['lat'];
}
if (isset($_POST['lon'])) {
	$lon = $_POST['lon'];
}

if ($lat != 0.0 && $lon != 0.0) {
	
	////////////////////////////////////////////
	// テスト用。吉祥寺にいることにする。
	//$lat = 35.704719;
	//$lon = 139.579049;
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
	$mode = 1;
	// 最大取得件数（500件までしか動作しない様子）
	$rest_num = 100;

	//URL組み立て
	$url = $uri . '?format=' .  $format .  '&keyid=' .  $acckey .  '&latitude=' .  $lat . '&longitude=' . $lon . '&range=' . $range . '&input_coordinates_mode=' . $mode . '&coordinates_mode=' . $mode . '&hit_per_page=' . $rest_num . '&freeword=' . $keyword;
	
	//var_dump($url);
	
	//API実行
	$json = file_get_contents($url);
	//取得した結果をオブジェクト化
	$obj  = json_decode($json);
	
	//var_dump($obj);

	//結果をパース
	$all_rest_data = array();
	foreach((array)$obj as $key => $val){
		if(strcmp($key, "total_hit_count" ) == 0 ){
			//echo "total:".$val."\n";
			$hit_count = (int)$val;
		}

		if(strcmp($key, "rest") == 0){
			if ($hit_count == 1) {
				// 検索結果が1件の場合
				// 検索結果を配列に格納
				$rest_data = new restData();
				if(checkString($val->{'id'})) $rest_data->id = $val->{'id'};
				if(checkString($val->{'name'})) $rest_data->name = $val->{'name'};
				if(checkString($val->{'latitude'})) $rest_data->latitude = $val->{'latitude'};
				if(checkString($val->{'longitude'})) $rest_data->longitude = $val->{'longitude'};
				if(checkString($val->{'coupon_url'}->{'mobile'})) $rest_data->coupon_url = $val->{'coupon_url'}->{'mobile'};
				array_push($all_rest_data, $rest_data);
			} else {
				// 検索結果が複数の場合
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
			}
		}
	}
	
	// お店リスト表示
	if ($hit_count > $rest_num) {
		$view .= "<div>近くのお店が多すぎます。キーワードを指定してください。</div>";
	} else if ($hit_count == 0) {
		$view .= "<div>検索結果：" . $hit_count . "件</div>";
	} else {
		$view .= "<div>検索結果：" . $hit_count . "件</div>";
		$view .= "<ul id='rest-list'>";
		foreach($all_rest_data as $rest_data) {
			// お店の座標と現在地の差を計算
			$diff_lat = abs($rest_data->latitude - $lat);
			$diff_lon = abs($rest_data->longitude - $lon);

			// 指定範囲以内にお店があれば表示
			if (($diff_lat <= SEARCH_RANGE_LAT) && ($diff_lon <= SEARCH_RANGE_LON)) {
				if ($rest_data->coupon_url != "") {
					// クーポンあり
					$view .= "<li><a href='";
					$view .= $rest_data->coupon_url;
					$view .= "'>";
					$view .= $rest_data->name;
					$view .= "</li>";
				} else {
					// クーポンなし（表示する？）
					$view .= "<li>";
					$view .= $rest_data->name;
					$view .= "</li>";
				}
			}
		}
		$view .= "</ul>";
	}
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
});
</script>
</head>
<body>
	<div id="view"><?php echo $view ?></div>
</body>
</html>