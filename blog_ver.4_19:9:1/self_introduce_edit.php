<?php require_once "system/common_admin.php";

// ホワイトリスト変数の作成
$whitelist = array("send", "mode", "no", "name", "content");
$request = whitelist($whitelist);

$page_message = ""; // ページに表示するメッセージ
$page_error = ""; // エラーメッセージ
$mode = $request["mode"]; // 動作モード（新規-指定なし/修正-change/削除-delete）

// フォーム初期値のセット
$form = array();
$form["no"] = $request["no"];
$form["name"] = $request["name"];
$form["content"] = $request["content"];

// 修正モード時はフォーム初期値をセット
// &&   →   かつ
// ||   →   または
if ($_SESSION["name"] && $_SESSION["content"]) {
    $form["name"] = $_SESSION["name"];
    $form["content"] = $_SESSION["content"];
} elseif ((!isset($request["send"]) && $mode == "change") ||  $mode == "delete") {
    try {
        $stmt = $pdo->prepare("SELECT * FROM self_introduce WHERE no = ? LIMIT 1");
        $stmt->execute(array($request["no"])); // クエリの実行
        $self_introduce = $stmt->fetch(PDO::FETCH_ASSOC); // SELECT結果を配列に格納

        if ($self_introduce) {
            // データ取得成功時は、フォーム初期値をセット
            if ($mode == "change") {
                $form["name"] = $self_introduce["name"];
                $form["content"] = $self_introduce["content"];
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
    if ($request["name"] == "") {
        $page_error = "名前を入力してください\n";
    } elseif ($request["content"] == "") {
        $page_error = "自己紹介文を入力してください\n";
    }
}


// var_dump($_SESSION);


?>
<?php $page_title = "自己紹介編集";?>
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
    <form action="confirm-self_introduce_edit.php" method="post" class="pe-form">
        <div>
            名前<span class="attention">[必須]</span><br>
            <input type="text" name="name" size="30" value="<?php echo he($form["name"]); ?>">
        </div>
        <div>
            自己紹介文<br>
            <textarea name="content" rows="5" cols="20"><?php echo he($form["content"]); ?></textarea>
        </div>
        <div>
            <input type="submit" name="send" value="入力確認" class="btn btn-outline-primary my-3 ml-3 w-auto">
            <input type="hidden" name="mode" value="<?php echo he($mode); ?>">
            <input type="hidden" name="no" value="<?php echo he($form["no"]); ?>">
        </div>
    </form>
<?php require "footer.php";?>
