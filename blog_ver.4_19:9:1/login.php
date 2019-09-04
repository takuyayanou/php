<?php 
$ignore_login = true;
require_once "system/common_admin.php";

// ログアウト機能はない場合、下記をコメントアウトすることにより、ログアウトできる。
// unset($_SESSION["user_loginid"]);

// 既にログインしている場合にはメインページに遷移
if (isset($_SESSION['user_loginid'])) {
  header('Location: post_list.php');
  exit;
}



// ホワイトリスト変数の作成
$whitelist = array("send", "user_loginid", "user_password");
$request = whitelist($whitelist);
$page_message = ""; // ページに表示するメッセージ
$page_error = ""; // エラーメッセージ

// エラーチェック
if (isset($request["send"])) {
    if ($request["user_loginid"] == "") {
        $page_error .= "ログインIDを入力してください\n";
    }
    if ($request["user_password"] == "") {
        $page_error .= "パスワードを入力してください\n";
    }
}

// ログイン実行
if (isset($request["send"]) && $page_error == "") {
    try {
        // まずはログインIDでSELECTする
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_loginid = ? LIMIT 1");
        $stmt->execute(array($request["user_loginid"])); // クエリの実行
        $row_user = $stmt->fetch
        (PDO::FETCH_ASSOC); // SELECT結果を配列に格納

        if ($row_user) {
            // 該当のuserレコードがあったら、パスワードを照合する

            // ここは、signUp.phpとlogin.phpで、sha1(〜);もしくはpassword_hash(〜, PASSWORD_DEFAULT);で揃える。ここでは、sha1(〜);で揃えた。
                // $pass = password_hash($request["user_password"], PASSWORD_DEFAULT);
            $pass = sha1($request["user_password"]);

            if ($pass == $row_user["user_password"]) {
                $_SESSION["user_loginid"] = $row_user["user_loginid"];
                header("Location: index.php");
                exit;
            }
        }
        $page_error .= "入力内容をご確認ください\n";
    } catch (PDOException $e) {
        // エラー発生時
        exit("ログイン処理に失敗しました");
    }
}
?>
<?php $page_title = "ログイン";?>
<?php require "header.php";?>

<!-- lg -->
<div class="lg">

    <p class="attention">
      <?php echo nl2br(he($page_error)); ?>
    </p>

    <div class="lg-form">
      <h3 class="lg-title">ログインしてください。</h3>

      <form action="login.php" method="post" class="lg-content">

        <div class="lg-login">
          ログインID<br>
          <input type="text" name="user_loginid" size="30" value="">
        </div>

        <div class="lg-pass">
          パスワード<br>
          <input type="password" name="user_password" size="30" value="">
        </div>

        <div class="lg-submit">
          <input type="submit" name="send" value="ログインする" class="btn btn-outline-primary mt-1">
        </div>

      </form>
    </div>

    <div class="lg-form">
      <h3 class="lg-title">初めての方はこちら</h3>
      <form action="signUp.php" method="post" class="lg-content">

        <div  class="lg-login">
          ID<br>
          <input type="text" name="user_loginid" size="30" value="">
        </div>
        
        <div class="lg-pass">
          パスワード<br>
          <input type="password" name="user_password" size="30" value="">
        </div>

        <div class="lg-submit">
          <input type="submit" name="signUp" value="登録する" class="btn btn-outline-primary mt-1">
        </div>
        <p>※パスワードは半角英数字をそれぞれ含んだ,8文字以上</p>
      </form>
    </div>
</div><!-- lg -->

      <a href="my-blog.php" class="btn btn-outline-primary my-3 ml-20">ブログへ</a>

<?php require "footer.php";?>