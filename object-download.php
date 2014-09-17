#!/usr/bin/env php
<?php

/**
 * ConoHaオブジェクトストレージからダウンロードするサンプル
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
);

// リクエストURL
// /(スラッシュ)区切りの最後のフィールドがオブジェクト名になる
$url = 'https://objectstore-r1nd1001.cnode.jp/v1/470710ce0ae24060886720fe4e7cf210/test-conoha/test.txt';

// cURLのオプション
$options = array(

    // URLの設定
    CURLOPT_URL => $url,
    
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

echo $body . "\n";

