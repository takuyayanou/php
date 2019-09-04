<?php require_once "system/common_admin.php";

// ホワイトリスト変数の作成
$whitelist = array("send", "mode", "no", "ft_content");
$request = whitelist($whitelist);

$page_message = ""; // ページに表示するメッセージ
$page_error = ""; // エラーメッセージ
$mode = $request["mode"]; // 動作モード（新規-指定なし/修正-change/削除-delete）

// フォーム初期値のセット
$form = array();
$form["no"] = $request["no"];
$form["ft_content"] = $request["ft_content"];

// 修正モード時はフォーム初期値をセット
// &&   →   かつ
// ||   →   または
if ($_SESSION["ft_content"]) {
    $form["ft_content"] = $_SESSION["ft_content"];
} elseif ((!isset($request["send"]) && $mode == "change") ||  $mode == "delete") {
    try {
        $stmt = $pdo->prepare("SELECT * FROM footer_text WHERE no = ? LIMIT 1");
        $stmt->execute(array($request["no"])); // クエリの実行
        $footer_text = $stmt->fetch(PDO::FETCH_ASSOC); // SELECT結果を配列に格納

        if ($footer_text) {
            // データ取得成功時は、フォーム初期値をセット
            if ($mode == "change") {
                $form["ft_content"] = $footer_text["ft_content"];
            }
        } else {
            // データ取得失敗時は停止
            exit("異常なアクセスです");
        }
    } catch (PDOException $e) {
        // エラー発生時
        exit("クエリの実行に失敗しました");
    }
} 


// エラーチェック
if (isset($request["send"])) {
    if ($request["ft_content"] == "") {
        $page_error = "ブログ名を入力してください\n";
    }
}


// var_dump($_SESSION);


?>
<?php $page_title = "フッターテキスト編集";?>
<?php require "header.php";?>
<body>
    <p class="ml-20">
        <a href="setting.php" class="btn btn-outline-primary my-3 ml-3">前へ戻る</a>
    </p>
    <p class="ml-20">
        <?php echo he($page_message); ?>
    </p>
    <p class="attention ml-20">
        <?php echo he($page_error); ?>
    </p>
<?php if ($mode == "change") {?>
    <p class="ml-20">
        自己紹介を修正しています
    </p>
<?php }?>
    <form action="confirm-footer_text_edit.php" method="post" class="pe-form">
        <div>
        フッターテキスト<br>
            <input name="ft_content" rows="5" cols="20" value="<?php echo he($form["ft_content"]); ?>">
        </div>
        <div>
            <input type="submit" name="send" value="入力確認" class="btn btn-outline-primary my-3 ml-3 w-auto">
            <input type="hidden" name="mode" value="<?php echo he($mode); ?>">
            <input type="hidden" name="no" value="<?php echo he($form["no"]); ?>">
        </div>
    </form>
<?php require "footer.php";?>
