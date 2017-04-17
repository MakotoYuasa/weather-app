<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<title>weather</title>
</head>
<body>
    <h2>東京の天気</h2>
<?php

    /*
    Livedoor Weather Web Service
    http://weather.livedoor.com/forecast/webservice/json/v1
    */
    #$url = "http://weather.livedoor.com/forecast/webservice/json/v1";

    class Weather {
        public function search($city_id) {
            # JSONの読み込み
            $json = file_get_contents("http://weather.livedoor.com/forecast/webservice/json/v1?city=$city_id");

            # 文字化けしないようにUTF-8に変換する
            $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
            
            # 連想配列にして格納する
            $obj = json_decode($json, true);

            #return $obj['description']['text'];
            return $obj;
        }
    }
    /* 東京:130010, 千葉:120010, 埼玉:110010 */
    $id = 130010; # 東京
	$weather = new Weather();
    $result = $weather->search($id);

    echo $result['forecasts'][0]['dateLabel'];
    echo nl2br("\n");  // 改行
    echo $result['forecasts'][0]['telop'];
    echo nl2br("\n");
    echo "最高気温：".$result['forecasts'][0]['temperature']['max']['celsius'];
    echo nl2br("\n");
    echo "最低気温：".$result['forecasts'][0]['temperature']['min']['celsius'];
    echo nl2br("\n");
    //echo $result['forecasts']['image']['url'];
    echo nl2br("\n");

    #echo $result['forecasts'][0]['image']['url'];
    #var_dump($result['forecasts'][0]['image']['url']);
    $img_path = $result['forecasts'][0]['image']['url'];
?>

<!-- アイコンの表示 -->
<img src="<?=$img_path?>">

<?php
    echo nl2br("\n");
    echo $result['description']['text'];
    #var_dump($result);
?>

</body>
</html>