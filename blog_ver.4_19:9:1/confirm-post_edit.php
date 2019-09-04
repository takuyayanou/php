<?php 
    require_once "system/common_admin.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームから送信されたデータを各変数に格納

        $no = $_POST["no"];
        $title = $_POST["title"];
        $category = $_POST["category"];
        $content = $_POST["content"];
    }

    // var_dump($_POST);

    $_SESSION["no"] = $no;
    $_SESSION["title"] = $title;
    $_SESSION["category"] = $category;
    $_SESSION["content"] = $content;

    // ホワイトリスト変数の作成
    $whitelist = array("send", "mode", "no", "category", "title", "content");
    $request = whitelist($whitelist);

    $page_message = ""; 
    // // ページに表示するメッセージ
    $page_error = ""; 
    // // エラーメッセージ
    $mode = $request["mode"]; 
    // // 動作モード（新規-指定なし/修正-change/削除-delete）

    // フォーム初期値のセット
    // $form = array();
    // $form["no"] = $request["no"];
    // $form["category"] = $request["category"];
    // $form["title"] = $request["title"];
    // $form["content"] = $request["content"];

// var_dump($request);

    // 修正モード時はフォーム初期値をセット
    // if ((!isset($request["send"]) && $mode == "change") ||  $mode == "delete") {
    //     try {
    //         $stmt = $pdo->prepare("SELECT * FROM post WHERE no = ? LIMIT 1");
    //         $stmt->execute(array($request["no"])); // クエリの実行
    //         $row_post = $stmt->fetch(PDO::FETCH_ASSOC); // SELECT結果を配列に格納
    // // var_dump($row_post);
    //         if ($row_post) {
    //             // データ取得成功時は、フォーム初期値をセット
    //             if ($mode == "change") {
    //                 $form["category"] = $row_post["category"];
    //                 $form["title"] = $row_post["title"];
    //                 $form["content"] = $row_post["content"];
    //             }
    //         } else {
    //             // データ取得失敗時は停止
    //             exit("異常なアクセスです");
    //         }
    //     } catch (PDOException $e) {
    //         // エラー発生時
    //         exit("クエリの実行に失敗しました");
    //     }
    // }



    // エラーチェック
    if (isset($request["send"])) {
        if ($_SESSION["title"] == "") {
            $page_error = "記事タイトルを入力してください\n";
            // header("Location: post_edit.php");
        } elseif ($_SESSION["category"] == "") {
            $page_error = "カテゴリーを入力してください\n";
        }
    }

    // 登録実行
    // if (isset($request["send"]) && $page_error == "") {
    //     // データベースへ保存
    //     try {
    //         $pdo->beginTransaction();
    //         if ($mode == "change") {
    //             // 修正モード
    //             $stmt = $pdo->prepare("UPDATE post SET category = ?, title = ?, content = ? WHERE no = ?");
    //             $stmt->execute(array($request["category"], $request["title"], $request["content"], $request["no"]));
    //         } else {
    //             // $mode空白時は新規登録
    //             $stmt = $pdo->prepare("INSERT INTO post (category, title, content, time) VALUES (?, ?, ?, NOW())");
    //             $stmt->execute(array($request["category"], $request["title"], $request["content"]));
    //             $mode = "change"; // 新規作成が成功したら、修正モードにする
    //             $form["no"] = $pdo->lastInsertId("no"); // 追加したpost_idを取得する
    //         }
    //         $pdo->commit();
    //     } catch (PDOException $e) {
    //         // エラー発生時
    //         $pdo->rollBack();
    //         exit("クエリの実行に失敗しました");
    //     }

    //     // 完了
    //     $page_message = "登録が完了しました";
    //     header("Location: post_list.php");
    //     exit;
    // }
?>

<?php require "header.php";?>
<body>
    <p class="ml-20 mt-3">
        <?php echo he($page_message); ?>
    </p>
    <p class="attention ml-20 mt-3">
        <?php echo he($page_error); ?>
    </p>
    <?php if ($mode == "change") {?>
        <p class="ml-20 mt-3">
            記事ID[<?php echo $_SESSION["no"]; ?>]の修正確認
        </p>
    <?php }?>
    <!-- contact-content -->
    <div class="contact-content pe-form mt-3">
        <input type="hidden" name="title" value="<?php echo $_SESSION["title"]; ?>">
        <input type="hidden" name="category" value="<?php echo $_SESSION["category"]; ?>">
        <input type="hidden" name="content" value="<?php echo $_SESSION["content"]; ?>">
        <!-- contact-dl -->
        <dl class="contact-dl">
            <dt class="contact-label">題名</dt>
            <dd class="contact-input mb-39">
                <?php echo $_SESSION["title"];?>
            </dd>
        </dl>

        <!-- contact-dl -->
        <dl class="contact-dl">
            <dt class="contact-label">カテゴリ</dt>
            <dd class="contact-input mb-39">
                <?php echo $_SESSION["category"];?>
            </dd>
        </dl>
            
        <dl class="contact-dl">
            <dt class="contact-label">記事本文</dt>
            <dd class="contact-input con-input-1 mb--3">
                <?php echo $_SESSION["content"];?>
            </dd>
            
        </dl>

        <?php
            //ホスト名取得
            $h = $_SERVER['HTTP_HOST'];
            
            // リファラ値があれば、かつ外部サイトでなければaタグで戻るリンクを表示
            if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$h) !== false)) {
        ?>
        <div class="contact-send">
            <?php 
                echo '<a href="' . $_SERVER['HTTP_REFERER'] . '" class="btn btn-outline-primary mt-3 ml-3">前に戻る</a>';
            }?>
        </div><!-- /contact-send -->

        <div class="contact-send">
            <a href="confirm-fin_post_edit.php" class="btn btn-outline-primary my-3 ml-3">登録</a>
        </div><!-- /contact-send -->
        
    </div><!-- /contact-content -->

<?php require "footer.php";?>
