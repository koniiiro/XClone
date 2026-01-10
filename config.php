<?php
//  エラー表示あり 
error_reporting(E_ALL);
ini_set('display_errors',1);
// 日本時間に設定する
date_default_timezone_set('Asia/Tokyo');
//URLディレクトリ設定
define('HOME_URL','/XClone/');
//データベースの接続情報
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'x_clone');