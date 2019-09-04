<?php 
    require_once "system/common_admin.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームから送信されたデータを各変数に格納
        $no = $_POST["no"];
        $ht_content = $_POST["ht_content"];
    }

    // var_dump($_POST);

    $_SESSION["no"] = $no;
    $_SESSION["ht_content"] = $ht_content;

    // ホワイトリスト変数の作成
    $whitelist = array("send", "mode", "no", "ht_content");
    $request = whitelist($whitelist);

    $page_message = ""; 
    // // ページに表示するメッセージ
    $page_error = ""; 
    // // エラーメッセージ
    $mode = $request["mode"]; 

    // エラーチェック
    if (isset($request["send"])) {
        if ($_SESSION["ht_content"] == "") {
            $page_error = "ブログ名を入力してください\n";
            // header("Location: post_edit.php");
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
        <p class="ml-20 mt-3">ブログ名</p>
    <?php }?>
    <!-- contact-ht_content -->
    <div class="contact-content pe-form mt-3">
        <input type="hidden" name="ht_content" value="<?php echo $_SESSION["ht_content"]; ?>">
        <!-- contact-dl -->
        <dl class="contact-dl">
            <dt class="contact-label">ブログ名</dt>
            <dd class="contact-input con-input-1 mb--3">
                <?php echo $_SESSION["ht_content"];?>
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
            <a href="confirm-fin_header_text_edit.php" class="btn btn-outline-primary my-3 ml-3">変更完了</a>
        </div><!-- /contact-send -->
        
    </div><!-- /contact-content -->

<?php require "footer.php";?>
