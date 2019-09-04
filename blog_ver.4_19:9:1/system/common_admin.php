<?php
// 関連ファイルをロード
require_once "common.php";

// セッション開始
session_start(); 

// ログイン状態のチェック
$logined_flag = false; // ログイン状態フラグ
if (!isset($ignore_login)) {
    // 認証用変数をsessionから取得
    if (isset($_SESSION["user_loginid"])) {
        $session_user_loginid = $_SESSION["user_loginid"];
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE user_loginid = ? LIMIT 1");
            $stmt->execute(array($session_user_loginid)); // クエリの実行
            $row_user = $stmt->fetch(PDO::FETCH_ASSOC); // SELECT結果を配列に格納
            if ($row_user) {
                // 該当のuserレコードがあったらログイン状態にする
                $logined_flag = true;
            }
        } catch (PDOException $e) {
            // エラー発生時
            exit("ログイン状態のチェックに失敗しました");
        }
    }
    
    // ログイン状態でなかったら、ログインページへジャンプ
    if (!$logined_flag) {
        header("Location: login.php");
        exit;
    }
}


// post_edit.php/confirm-post_edit.phpにおける入力確認
// →post_edit.php/confirm-post_edit.php以外は、sessionを使わない
// →common/admin.phpは管理者ページでは必ず読み取る。（理由：ログイン状態の有無を判断するため。）
// →$_SESSION["title"]・$_SESSION["category"]・$_SESSION["content"]がemptyじゃなければ、$_SESSION["title"]・$_SESSION["category"]・$_SESSION["content"]を消す。
// →なおかつ、post_edit.php/confirm-post_edit.php以外は消すという設定を加える。

if (!empty($_SESSION["title"]) || !empty($_SESSION["category"]) || !empty($_SESSION["content"]) || !empty($_SESSION["ht_content"])) {
// var_dump($_SESSION["title"]);

// ltrimは最初の文字を消す関数
    $self = ltrim($_SERVER['PHP_SELF'], "/");
    
// var_dump($self);
    $denyList = array(
    'post_edit.php', 'confirm-post_edit.php', 'confirm-fin_post_edit.php',
    'confirm-myworks-post.php', 'confirm-fin_myworks-post.php', 
    'myworks-post.php', 
    'confirm-myworks-comment.php', 'confirm-fin_myworks-comment.php' ,'self_introduce_edit.php', 'confirm-self_introduce_edit.php', 'confirm-fin_self_introduce_edit.php', 
    'header_text_edit.php', 'confirm-header_text_edit.php', 'confirm-fin_header_text_edit.php', 
    'footer_text_edit.php', 'confirm-footer_text_edit.php', 'confirm-fin_footer_text_edit.php'

);
    if(!in_array($self, $denyList)){
        unset($_SESSION["title"]);
        unset($_SESSION["category"]);
        unset($_SESSION["content"]);
        unset($_SESSION["ht_content"]);
        // var_dump($self);
    }
}
