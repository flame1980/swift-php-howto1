#!/usr/bin/env php
<?php

/**
 * ConoHaオブジェクトストレージにコンテナを作成するサンプル
 *
 * @link https://www.conoha.jp/blog/tech/3429.html
 */

require_once 'config.php';

// cURLの初期化
$curl = curl_init();

// HTTPヘッダー
$headers = array(
    // X-Auth-Tokenヘッダーでトークンを指定します
    'X-Auth-Token: ' . AUTH_TOKEN,
    'Content-Length: 0',
    
    // Acceptヘッダーでレスポンスの形式を指定できる
    // application/jsonの他にapplication/xmlやtext/xmlなど
    'Accept: application/json'
);

// リクエストURL
// /(スラッシュ)区切りの最後のフィールドがコンテナ名になる
$url = ENDPOINT_URL . '/test-conoha';

// cURLのオプション
$options = array(

    // コンテナを作成する場合はPUTメソッドを使う
    CURLOPT_PUT => true,
    
    // URLの設定
    CURLOPT_URL => $url,

    // リクエスト/レスポンスが見やすいように冗長表示する
    CURLOPT_VERBOSE => true,
    
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
);
curl_setopt_array($curl, $options);

// HTTPリクエストを実行
// レスポンスには何も含まれていません。
$body = curl_exec($curl);
if(curl_errno($curl)) {
    $msg = sprintf('cURL error: %s', curl_error($curl));
    throw new RuntimeException($msg);
}

// HTTPステータスコードを取得します。
// 以下のようなステータスコードが返ってきます。
// 
// 201 Created     正常にコンテナが作成された
// 202 Accepted    リクエストが受け付けられた(すでに同じ名前のコンテナがあった場合など)
// 401 Unauthorize 認証失敗(トークンが正しくない)
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
echo "status code: " . $status_code . "\n";

