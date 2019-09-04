<?php
    require_once "system/common_admin.php";

    // 変数の初期化
    $error = $title = $category = $content = '';

    // 現在の日付を取得
    $updated_time = date('Y-m-d H:i:s');
    $time = date('Y-m-d');

    //投稿ボタンが押されたかをチェック
    if (@$_POST['submit']) {

        //フォームから送られた記事タイトルを変数に格納
        $title = $_POST['title'];

        //フォームから送られた記事タイトルを変数に格納
        $category = $_POST['category'];

        //フォームから送られた本文を変数に格納
        $content = $_POST['content'];

        if (!$title) $error .= 'タイトルがありません。<br>';
        //mb_strlen：文字数が設定文字より多いときエラーが表示
        if (mb_strlen($title) > 80) $error .='タイトルが長過ぎます。<br>';

        
        if (!$category) $error .= 'カテゴリがありません。<br>';


        if (!$content) $error .= '本文がありません。<br>';
        // エラーメッセージが無い場合
        if (!$error) {

            // $st = $pdo->prepare("INSERT INTO post(no,category, title, content, articleImage, updated_time, time) VALUES (?, ?, ?, NOW(), NOW())");
            $st = $pdo->prepare("INSERT INTO post(no,category, title, content, articleImage, updated_time, time) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $st->execute(array(null, $category, $title, $content, null, $updated_time, $time));

            header('Location: post_list.php');
            exit();
        }
    }

    // ============== ブログ名 ============================
    // データの問い合わせ:
    $headerText = array(); // 配列の初期化
    try {
        $st_ht = $pdo->query("SELECT * FROM header_text ORDER BY no DESC limit 0, 1");
        $headerText = $st_ht->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // エラー発生時
        exit("クエリの実行に失敗しました");
    }

    require 't_myworks-post.php';
?>