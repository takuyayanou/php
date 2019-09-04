<?php

require_once "system/common_admin.php";
//ホスト名取得
$h = (empty($_SERVER["HTTPS"]) ? "http://" : "https://"). $_SERVER['HTTP_HOST'];

$post_no = $_SESSION["post_no"];
var_dump($post_no);


// var_dump($_SERVER['HTTP_REFERER']);
// var_dump($h. '/confirm-myworks-post.php');
// $hはドメイン部分
if ($_SERVER['HTTP_REFERER'] == $h. '/confirm-myworks-comment.php') {
// var_dump($_SESSION);
    $stmt = $pdo->prepare("INSERT INTO comment (post_no, name, content, created_time) VALUES (?, ?, ?, NOW())");
    $stmt->execute(array($_SESSION["post_no"], $_SESSION["name"], $_SESSION["content"]));
}
// 登録実行
    // if (isset($request["send"]) && $page_error == "") {
        // データベースへ保存
        // try {
            // $pdo->beginTransaction();
            // // if ($mode == "change") {
            //     // 修正モード
            //     $stmt = $pdo->prepare("UPDATE post SET category = ?, title = ?, content = ? WHERE no = ?");
            //     $stmt->execute(array($request["category"], $request["title"], $request["content"], $request["no"]));
            // } 
            // else {
            //     // $mode空白時は新規登録
            //     $stmt = $pdo->prepare("INSERT INTO post (category, title, content, time) VALUES (?, ?, ?, NOW())");
            //     $stmt->execute(array($request["category"], $request["title"], $request["content"]));
            //     $mode = "change"; // 新規作成が成功したら、修正モードにする
            //     $form["no"] = $pdo->lastInsertId("no"); // 追加したpost_idを取得する
            // }
            // $pdo->commit();
        // } catch (PDOException $e) {
        //     // エラー発生時
        //     $pdo->rollBack();
        //     exit("クエリの実行に失敗しました");
        // }

        // 完了
        $page_message = "登録が完了しました";
        header("Location: post-article.php?no=$post_no");
        exit;
    
    ?>