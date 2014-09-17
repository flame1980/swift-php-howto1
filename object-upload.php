#!/usr/bin/env php
<?php

/**
 * ConoHaオブジェクトストレージにオブジェクトをアップロードするサンプル
 *
 * @link https://www.conoha.jp/blog/tech/3429.html
 */

require_once 'config.php';

// cURLの初期化
$curl = curl_init();

// アップロードするデータを作成
$content = 'このはちゃん清楚かわいい';
$fp = tmpfile();
fwrite($fp, $content, strlen($content));
fseek($fp, 0, SEEK_SET);

// HTTPヘッダー
$headers = array(
    // X-Auth-Tokenヘッダーでトークンを指定します
    'X-Auth-Token: ' . AUTH_TOKEN,

    // Content-Typeヘッダーでアップロードするオブジェクトの形式を指定します。
    'Content-Type: text/plain; charset=utf-8'
);

// リクエストURL
// /(スラッシュ)区切りの最後のフィールドがオブジェクト名になる
$url = 'https://objectstore-r1nd1001.cnode.jp/v1/470710ce0ae24060886720fe4e7cf210/test-conoha/test.txt';

// cURLのオプション
$options = array(

    // オブジェクトを作成する場合はPUT
    CURLOPT_PUT => true,
    
    // オブジェクトデータ
    CURLOPT_INFILE => $fp,
    
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

// HTTPステータスコードを取得します。
// オブジェクトの作成、更新が成功すると201 Createdが返ります。
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if($status_code != 201) {
    $msg =sprintf('Error. The server returned status code(%d).', $status_code);
    throw new RuntimeException($msg);
}

$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
echo "status code: " . $status_code . "\n";

