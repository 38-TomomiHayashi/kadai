<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php
// 1行ずつ読み込み
$line = file('data/data.txt');
echo '<TABLE cellpadding="4" cellspacing="1" style="background-color : #aaaaaa;"><TBODY>';

for ($a = 0; $a < count($line); $a++) {
	// カンマで区切る
	$data = split(",", $line[$a]);

	/////////////////
	// 表形式で出力
	echo '<TR>';
	
	if ($a == 0) {
		$style = 'background-color : #e5e5e5;';
	} else {
		$style = 'background-color : #ffffff;';
	}

	for ($b = 0; $b < count($data); $b++) {
		echo '<TD style="' . $style . '">' . $data[$b] . '</TD>';
	}
	
	echo '</TR>';
}
echo '</TBODY></TABLE>';
?>
</body>