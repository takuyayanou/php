<?php
// 関連ファイルをロード
require_once "config.php";
require_once "lib.php";

// データベース接続を確立
try {
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // エラーモードの設定
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // prepareのエミュレーションを停止
} catch (PDOException $e) {
    // エラー発生時
    exit("データベースの接続に失敗しました");
}

// require_once "config.php";
// $db = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);