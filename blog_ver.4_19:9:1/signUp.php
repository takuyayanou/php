<?php
    // セッション開始
    session_start();

    require_once "system/config.php";

    // 作成したデータベースに接続(今回は「my_works」)
    // ここで$pdoとすることで、postやcommentなどを使いやすくしている。
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);
    $error = '';

    // ログインボタンが押されたら
    if (isset($_POST['signUp'])) {
        if (empty($_POST['user_loginid'])) {
            $error = 'ユーザーIDが未入力です。';
        } elseif (empty($_POST['user_password'])) {
            $error = 'パスワードが未入力です。';
        }
        if (!empty($_POST['user_loginid']) && !empty($_POST['user_password'])) {

            $user_loginid = $_POST['user_loginid'];
            $user_password = $_POST['user_password'];
            $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            // idの重複とパスワードの桁数チェック
            function check($id,$count){
                if($count > 0){
                    throw new Exception('そのユーザーIDは既に使用されています。');
                }
                if ($id < 8) {
                    throw new Exception('パスワードは8桁以上で入力してください。');
                }
            }

            try {
                // $sqlname = "SELECT COUNT(*) FROM users WHERE user_loginid = '$user_loginid'";
                $ss = $pdo->query("SELECT COUNT(*) FROM users WHERE user_loginid = '$user_loginid'");

                $count = $ss->fetchColumn();

                $id = strlen($_POST['user_password']);

                check($id,$count);


        // prepareは雛形を作るようなもの。valuesは動的になる。
                $stmt = $pdo->prepare("INSERT INTO users(user_loginid, user_password) VALUES (:user_loginid, :user_password)");

        // ここは、signUp.phpとlogin.phpで、sha1(〜);もしくはpassword_hash(〜, PASSWORD_DEFAULT);で揃える。ここでは、sha1(〜);で揃えた。
                // $pass = password_hash($user_password, PASSWORD_DEFAULT);
                $pass = sha1($user_password);

                $stmt->bindParam(':user_loginid', $user_loginid, PDO::PARAM_STR);
                $stmt->bindParam(':user_password', $pass, PDO::PARAM_STR);
                $stmt->execute();
                $_SESSION['user_loginid'] = $user_loginid;
                echo '<script>
                alert("登録が完了しました。"); 
                location.href="post_list.php";
                </script>';
            } catch(Exception $e){}
            $error = $e->getMessage();

        }
    }
?>