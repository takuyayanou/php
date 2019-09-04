<?php 
    require_once "system/common_admin.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームから送信されたデータを各変数に格納

        $no = $_POST["no"];
        $name = $_POST["name"];
        $content = $_POST["content"];
    }

    $_SESSION["no"] = $no;
    $_SESSION["name"] = $name;
    $_SESSION["content"] = $content;

    // ホワイトリスト変数の作成
    $whitelist = array("send", "mode", "no", "post_no", "name", "content");
    $request = whitelist($whitelist);

    $page_message = ""; 
    // // ページに表示するメッセージ
    $page_error = ""; 
    // // エラーメッセージ
    $mode = $request["mode"]; 
    // // 動作モード（新規-指定なし/修正-change/削除-delete）

    // エラーチェック
    if (isset($request["send"])) {
        if ($_SESSION["name"] == "") {
            $page_error = "名前を入力してください\n";
            // header("Location: post_edit.php");
        } elseif ($_SESSION["content"] == "") {
            $page_error = "コメント本文を入力してください\n";
        }
    }

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
        <input type="hidden" name="name" value="<?php echo $_SESSION["name"]; ?>">
        <input type="hidden" name="content" value="<?php echo $_SESSION["content"]; ?>">
        <input type="hidden" name="post_no" value="<?php echo $_SESSION["post_no"]; ?>">
        <!-- contact-dl -->
        <dl class="contact-dl">
            <dt class="contact-label">名前</dt>
            <dd class="contact-input mb-39">
                <?php echo $_SESSION["name"];?>
            </dd>
        </dl>
            
        <dl class="contact-dl">
            <dt class="contact-label">コメント本文</dt>
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
            <a href="confirm-fin_comment-edit.php" class="btn btn-outline-primary my-3 ml-3">登録</a>
        </div><!-- /contact-send -->
        
    </div><!-- /contact-content -->

<?php require "footer.php";?>
