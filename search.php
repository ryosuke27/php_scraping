<?php


//------------------------------------
// Google Custom Search API 定数設定
//------------------------------------
//APIキー
$apiKey = "AIzaSyAVBcxxIR3rWrTGRtUdgYT--uCl7JTC03Q";

//検索エンジンID
$searchEngineId = "ebaa468c0546e1751";

// 検索用URL
$baseUrl = "https://www.googleapis.com/customsearch/v1?";

//取得開始位置
$startNum = 1;

//--------------------------
// 検索キーワード取得
//--------------------------
$key = $_POST['key'];
switch($key){
    case economic:
        $key = "経済";
    break;
    case IT:
        $key = "IT";
    break;
    case buisiness:
        $key = "ビジネス";
    break;
    case sports:
        $key = "スポーツ";
    break;
    case health:
        $key = "健康";
    break;
    case weather:
        $key = "天気";
    break;
}

$query = "{$key} site:www.google.co.jp";

//------------------------------------
// リクエストパラメータ生成
//------------------------------------
$paramAry = array(
                'q' => $query,
                'key' => $apiKey,
                'cx' => $searchEngineId,
                'alt' => 'json',
                'start' => $startNum
        );
$param = http_build_query($paramAry);

//------------------------------------
// 実行＆結果取得
//------------------------------------
$reqUrl = $baseUrl . $param;
$retJson = file_get_contents($reqUrl, true);
$ret = json_decode($retJson, true);

//------------------------------------
// 結果表示
//------------------------------------

//画面表示
//var_dump($ret);

//JSON形式でファイル出力
file_put_contents(dirname(__FILE__) . "/data/ret_" . $startNum . "_" . date('Ymd_His') . ".txt", $retJson);

//項目を画面表示
$num = $startNum;
foreach($ret['items'] as $value){
    echo "順位:" . $num . "<br>\n";
    echo "タイトル:" . $value['title'] . "<br>\n";
    echo "URL:<a href='{$value['link']}'>" . $value['link'] . "</a><br>\n";
    echo "-------------------------------------------------------------------------<br>\n";

    $num++;
}