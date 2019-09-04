<?php require_once "system/common_admin.php";

// ホワイトリスト変数の作成
$whitelist = array("send", "mode", "no", "category", "title", "content");
$request = whitelist($whitelist);

$page_message = ""; // ページに表示するメッセージ
$page_error = ""; // エラーメッセージ
$mode = $request["mode"]; // 動作モード（新規-指定なし/修正-change/削除-delete）

// フォーム初期値のセット
$form = array();
$form["no"] = $request["no"];
$form["category"] = $request["category"];
$form["title"] = $request["title"];
$form["content"] = $request["content"];

// 修正モード時はフォーム初期値をセット
// &&   →   かつ
// ||   →   または
if ($_SESSION["title"] && $_SESSION["category"] && $_SESSION["content"]) {
    $form["category"] = $_SESSION["category"];
    $form["title"] = $_SESSION["title"];
    $form["content"] = $_SESSION["content"];
} elseif ((!isset($request["send"]) && $mode == "change") ||  $mode == "delete") {
    try {
        $stmt = $pdo->prepare("SELECT * FROM post WHERE no = ? LIMIT 1");
        $stmt->execute(array($request["no"])); // クエリの実行
        $row_post = $stmt->fetch(PDO::FETCH_ASSOC); // SELECT結果を配列に格納

        if ($row_post) {
            // データ取得成功時は、フォーム初期値をセット
            if ($mode == "change") {
                $form["category"] = $row_post["category"];
                $form["title"] = $row_post["title"];
                $form["content"] = $row_post["content"];
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

// 削除モード
if ($mode == "delete") {
    try {
        $pdo->beginTransaction();
        $stmt = $pdo->prepare("DELETE FROM post WHERE no = ?");
        $stmt->execute(array($request["no"]));
        $pdo->commit();
    } catch (PDOException $e) {
        // エラー発生時
        $pdo->rollBack();
        exit("クエリの実行に失敗しました");
    }
    header("Location: post_list.php");
    exit;
}

// エラーチェック
if (isset($request["send"])) {
    if ($request["title"] == "") {
        $page_error = "記事タイトルを入力してください\n";
    } elseif ($request["category"] == "") {
        $page_error = "カテゴリーを入力してください\n";
    }
}

?>
<?php $page_title = "記事編集";?>
<?php require "header.php";?>
<body>
    <p class="ml-20">
        <a href="post_list.php" class="btn btn-outline-primary my-3 ml-3">一覧へ戻る</a>
    </p>
    <p class="ml-20">
        <?php echo he($page_message); ?>
    </p>
    <p class="attention ml-20">
        <?php echo he($page_error); ?>
    </p>
<?php if ($mode == "change") {?>
    <p class="ml-20">
        記事ID[<?php echo he($form["no"]); ?>]を修正しています
    </p>
<?php }?>
    <form action="confirm-post_edit.php" method="post" class="pe-form">
        <div>
            記事タイトル <span class="attention">[必須]</span><br>
            <input type="text" name="title" size="30" value="<?php echo he($form["title"]); ?>">
        </div>
        <div>
            記事カテゴリー <span class="attention">[必須]</span><br>
            <input type="text" name="category" size="30" value="<?php echo he($form["category"]); ?>">
        </div>
        <div>
            記事本文<br>
            <textarea name="content" rows="5" cols="20"><?php echo he($form["content"]); ?></textarea>
        </div>
        <div>
            <input type="submit" name="send" value="入力確認" class="btn btn-outline-primary my-3 ml-3 w-auto">
            <input type="hidden" name="mode" value="<?php echo he($mode); ?>">
            <input type="hidden" name="no" value="<?php echo he($form["no"]); ?>">
        </div>
    </form>
<?php require "footer.php";?>
