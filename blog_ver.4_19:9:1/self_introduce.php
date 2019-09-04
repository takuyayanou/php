<?php 
    require_once "system/common_admin.php";

    // 自己紹介文＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
    
    // データの問い合わせ
    $self_introduce = array(); // 配列の初期化
    try {
        $st_self_introduce = $pdo->query("SELECT * FROM self_introduce ORDER BY no DESC limit 0, 1");
        $self_introduce = $st_self_introduce->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // エラー発生時
        exit("クエリの実行に失敗しました");
    }

    // 自己紹介画像＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
    if(!empty($_FILES)) {
        $fileName = $_FILES['selfImage']['name'];
    // var_dump($fileName);
        if($fileName != "") {
            $selfImage = $fileName;

            move_uploaded_file($_FILES['selfImage']['tmp_name'],'file_upload/self_introduce/'. $selfImage);

            $sql = sprintf('INSERT INTO self_introduceImage_upload SET selfImage="%s"', $selfImage);
            $stmt = $pdo->prepare($sql);
            $stmt -> execute();
        }
    }

    $stsi = $pdo->query('SELECT * FROM self_introduceImage_upload ORDER BY no DESC LIMIT 1');
    $selfImage = $stsi->fetch(PDO::FETCH_ASSOC);
    

    // ブログ名＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

    // データの問い合わせ
    $headerText = array(); // 配列の初期化
    try {
        $st_ht = $pdo->query("SELECT * FROM header_text ORDER BY no DESC limit 0, 1");
        $headerText = $st_ht->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // エラー発生時
        exit("クエリの実行に失敗しました");
    }

    require 't_self_introduce.php';

?>
