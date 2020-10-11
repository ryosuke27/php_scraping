# 情報共有サイト一括検索
概要

・Google Custom Search API(カスタムサーチAPI)を使って
カスタム検索から結果を取得し、表示する。

・表示はPHPQueryというPHPのスクレイピングライブラリを使って
表示させたいワードのみを抽出して表示する

## Description
詳細

#### 1.Google Custom Search APIを作成し、APIキーと検索エンジンIDを取得
https://developers.google.com/custom-search/v1/overview

既定の検索用URLに対して取得したAPIキー、検索エンジンID、検索キーワード、対象となるURLを入れた
リクエストパラメータを生成し、リクエスト実行

検索用URL：https://www.googleapis.com/customsearch/v1?

#### 2.JSONで返却された検索結果をデコード

```
$reqUrl = $baseUrl . $param;
$retJson = file_get_contents($reqUrl, true);
$ret = json_decode($retJson, true);
```

#### 3.phpQueryを用いて表示させたい内容のみ抽出し表示

```
$html = file_get_contents($value['link']);
$dom = phpQuery::newDocument($html);
echo "<li>Title:" . $dom->find('h1')->text() . "<br>\n";
```


