<?php

/**
 * ConoHaコントロールパネルで表示される情報を設定してください。
 *
 * @link https://www.conoha.jp/blog/tech/3429.html
 */

// ユーザ名
define('USERNAME', '');

// パスワード
define('PASSWORD', '');

// 認証トークン(token-get.phpで取得する)
define('AUTH_TOKEN', '');

// テナント名
define('TENANT_NAME', '');

// テナントID
define('TENANT_ID', '');

// API Auth URL
define('AUTH_URL', 'https://ident-r1nd1001.cnode.jp/v2.0');

// オブジェクトストレージエンドポイントURL
define('ENDPOINT_URL', 'https://objectstore-r1nd1001.cnode.jp/v1/' . TENANT_ID);

