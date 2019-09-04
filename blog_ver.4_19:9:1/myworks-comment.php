<?php
require_once "system/config.php";

    // 変数の初期化
    $post_no = $error = $name = $content = '';
     // 作成したデータベースに接続(my_works)
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);
    if (@$_POST['submit']) {

        // strip_tags:文字列のタグを除去する関数
        if (!empty($_POST["post_no"])) {
            $post_no = strip_tags($_POST['post_no']);
        }
        if (!empty($_POST["name"])) {
            $name = strip_tags($_POST['name']);
        }
        if (!empty($_POST["content"])) {
            $content = strip_tags($_POST['content']);
        }

        if (!$name) $error .= '名前がありません。<br>';
        if (!$content) $error .= 'コメントがありません。<br>';
        if (!$error) {

            // // 作成したデータベースに接続(my_works)
            // $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);

            // 変数をSQL文に組み込む必要があるので、prepare+executeを使う
            $st = $pdo->prepare("INSERT INTO comment(no,post_no,name,content,updated_time, created_time) VALUES(?,?,?,?,?,?)");
            $st_st = $st->execute(array(null,$post_no, $name, $content,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));

            header("Location: post-article.php?no=$post_no");
            exit();
        }
    } else {
        $post_no = strip_tags($_GET['no']);
    }

    // ============== ブログ名 ============================
    // データの問い合わせ
    $headerText = array(); // 配列の初期化
    try {
        $st_ht = $pdo->query("SELECT * FROM header_text ORDER BY no DESC limit 0, 1");
        $headerText = $st_ht->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // エラー発生時
        exit("クエリの実行に失敗しました");
    }

    require 't_myworks-comment.php';
?>