<?php

    require_once "system/common_admin.php";
    //ホスト名取得
    $h = (empty($_SERVER["HTTPS"]) ? "http://" : "https://"). $_SERVER['HTTP_HOST'];


    // var_dump($_SERVER['HTTP_REFERER']);
    // var_dump($h. '/confirm-post_edit.php');
    // $hはドメイン部分
    if ($_SERVER['HTTP_REFERER'] == $h. '/confirm-self_introduce_edit.php') {

        $stmt = $pdo->prepare("UPDATE self_introduce SET name = ?, content = ? WHERE no = ?");
        $stmt->execute(array($_SESSION["name"], $_SESSION["content"], $_SESSION["no"]));
    }
        // 完了
        $page_message = "登録が完了しました";
        header("Location: setting.php");
        exit;
    // }
    ?>