#!/usr/bin/env php
<?php

/**
 * ConoHaオブジェクトストレージのコンテナ一覧を取得するサンプル
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
    
    // Acceptヘッダーでレスポンスの形式を指定できる
    // application/jsonの他にapplication/xmlやtext/xmlなど
    'Accept: application/json'
);

// リクエストURL
$url = ENDPOINT_URL;

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

// 結果を表示します。
echo $body . "\n";

