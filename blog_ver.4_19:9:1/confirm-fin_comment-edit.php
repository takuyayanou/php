<?php

    require_once "system/common_admin.php";

    $comment_no = $_SESSION["no"];

    //ホスト名取得
    $h = (empty($_SERVER["HTTPS"]) ? "http://" : "https://"). $_SERVER['HTTP_HOST'];

    // var_dump($_SERVER['HTTP_REFERER']);
    // var_dump($h. '/confirm-post_edit.php');
    // $hはドメイン部分
    if ($_SERVER['HTTP_REFERER'] == $h. '/confirm_comment-edit.php') {

        $stmt = $pdo->prepare("UPDATE comment SET name = ?, content = ? WHERE no = ?");
        $changes = $stmt->execute(array($_SESSION["name"], $_SESSION["content"], $_SESSION["no"]));
        // var_dump($changes);
    }
        // 完了
        $page_message = "登録が完了しました";
        header("Location: comment-list.php?no=$comment_no");
        exit;
    // }
    ?>