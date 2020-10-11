<!DOCTYPE html>
<html lang="ja">
<?php
//スクレイピングファイル読み込み
require_once("./phpQuery-onefile.php");


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
$key = $_POST['word'];

$query = "{$key} site:https://qiita.com/";

//------------------------------------
// リクエストパラメータ生成
//------------------------------------
$paramAry = array(
                'q' => $query,
                'key' => $apiKey,
                'cx' => $searchEngineId,
                'alt' => 'json',
                'start' => $startNum,
                'num' => 3
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
$num = $startNum;
echo "<h1>情報共有サイト一括検索</h1>";
echo "<ul>";
foreach($ret['items'] as $value){
    echo "<li>No." . $num . "</li><br>\n";
    $html = file_get_contents($value['link']);
    $dom = phpQuery::newDocument($html);
    echo "<li>Title:" . $dom->find('h1')->text() . "<br>\n";
    echo "URL:<a href='{$value['link']}'>" . $value['link'] . "</a></li><br>\n";

    $num++;
}
echo "</ul>";
?>
<style>
ul, ol {
  padding: 0;
  position: relative;
}

ul li, ol li, h1 {
  color: black;
  border-left: solid 6px #2d8fdd;/*左側の線*/
  background: #f1f8ff;/*背景色*/
  margin-bottom: 3px;/*下のバーとの余白*/
   line-height: 1.5;
  padding: 0.5em;
  list-style-type: none!important;/*ポチ消す*/
}
</style>


