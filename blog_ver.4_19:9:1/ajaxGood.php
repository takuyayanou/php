<?php
// require_once "system/config.php";

// // postがある場合
// if(isset($_POST['good_no'])){
//     $no = $_POST['good_no'];
//     $pn = $_POST['post_no'];
//     $cnt = $_POST['good_count']+1;
//     try{
//         //DB接続

//         // 作成したデータベースに接続(今回は「my_works」)
//         // ここで$pdoとすることで、postやcommentなどを使いやすくしている。
//         $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);


//         $sql = "INSERT INTO good (no, post_no, count) VALUES
//         ($no, $pn, $cnt)
//         ON DUPLICATE KEY UPDATE count = $cnt";
//     // var_dump($sql);
//         $pdo->query($sql);
//     }catch(Exception $e){
//         error_log('エラー発生：'.$e->getMessage());
//     }
// }

?>