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
    $id = 130010; # 東京
	$weather = new Weather();
    $result = $weather->search($id);

    echo $result['forecasts'][0]['dateLabel'];
    echo nl2br("\n");
    echo $result['forecasts'][0]['telop'];
    echo nl2br("\n");
    echo "最高気温：".$result['forecasts'][0]['temperature']['max']['celsius'];
    echo nl2br("\n");
    echo "最低気温：".$result['forecasts'][0]['temperature']['min'];
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

    /* MEMO
    "http://weather.livedoor.com/area/forecast/1310100" ["name"]=> string(12) "千代田区" } [1]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1310200" ["name"]=> string(9) "中央区" } [2]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1310300" ["name"]=> string(6) "港区" } [3]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1310400" ["name"]=> string(9) "新宿区" } [4]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1310500" ["name"]=> string(9) "文京区" } [5]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1310600" ["name"]=> string(9) "台東区" } [6]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1310700" ["name"]=> string(9) "墨田区" } [7]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1310800" ["name"]=> string(9) "江東区" } [8]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1310900" ["name"]=> string(9) "品川区" } [9]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1311000" ["name"]=> string(9) "目黒区" } [10]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1311100" ["name"]=> string(9) "大田区" } [11]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1311200" ["name"]=> string(12) "世田谷区" } [12]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1311300" ["name"]=> string(9) "渋谷区" } [13]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1311400" ["name"]=> string(9) "中野区" } [14]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1311500" ["name"]=> string(9) "杉並区" } [15]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1311600" ["name"]=> string(9) "豊島区" } [16]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1311700" ["name"]=> string(6) "北区" } [17]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1311800" ["name"]=> string(9) "荒川区" } [18]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1311900" ["name"]=> string(9) "板橋区" } [19]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1312000" ["name"]=> string(9) "練馬区" } [20]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1312100" ["name"]=> string(9) "足立区" } [21]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1312200" ["name"]=> string(9) "葛飾区" } [22]=> array(2) { ["link"]=> string(49) 
    "http://weather.livedoor.com/area/forecast/1312300" ["name"]=> string(12) "江戸川区" } [23]=> array(2) { ["link"]=> string(49) 
    */
?>

</body>
</html>