<?php

require_once "system/config.php";

    if(isset($_GET["target"]) && $_GET["target"] !== ""){
        $target = $_GET["target"];
    }
    else{
        header("Location: test.php");
    }
    $MIMETypes = array(
        'png' => 'image/png',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'mp4' => 'video/mp4'
    );
    try {
        $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);
        $sql = "SELECT * FROM main_image WHERE fname = :target;";
        $stmt = $pdo->prepare($sql);
        $stmt -> bindValue(":target", $target, PDO::PARAM_STR);
        $stmt -> execute();
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        header("Content-Type: ".$MIMETypes[$row["extension"]]);
        echo ($row["raw_data"]);
    }
    catch (PDOException $e) {
        echo("<p>500 Inertnal Server Error</p>");
        exit($e->getMessage());
    }
?>