<?php
    require_once "../system/common.php";

    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);

    if(!empty($_FILES)) {
        $fileName = $_FILES['image']['name'];
        if($fileName != "") {
            $image = $fileName;

            move_uploaded_file($_FILES['image']['tmp_name'],'image/'. $image);

            $sql = sprintf('INSERT INTO upload_sample SET image="%s"', $image);
            $stmt = $pdo->prepare($sql);
            $stmt -> execute();
        }
    }

    $stmt = $pdo->query('SELECT * FROM upload_sample WHERE id = 6');
    $image = $stmt->fetch();
    // var_dump($image);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>fileサンプル</title>
</head>
<body>
    <img src="<?php echo 'image/'. $image['image'];?>">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit">
    </form>
</body>
</html>
