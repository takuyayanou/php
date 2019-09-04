<?php

    require_once "system/common_admin.php";
    //ホスト名取得
    $h = (empty($_SERVER["HTTPS"]) ? "http://" : "https://"). $_SERVER['HTTP_HOST'];

    // $hはドメイン部分
    if ($_SERVER['HTTP_REFERER'] == $h. '/confirm-header_text_edit.php') {

        $stmt = $pdo->prepare("UPDATE header_text SET ht_content = ? WHERE no = ?");
        $stmt->execute(array($_SESSION["ht_content"], $_SESSION["no"]));
    }
        // 完了
        $page_message = "登録が完了しました";
        header("Location: setting.php");
        exit;
    // }
    ?>