<?php require_once "system/common_admin.php";?>
<?php
// ホワイトリスト変数の作成
$whitelist = array("send", "mode", "no", "post_no", "name", "content");
$request = whitelist($whitelist);

$page_message = ""; // ページに表示するメッセージ
$page_error = ""; // エラーメッセージ
$mode = $request["mode"]; // 動作モード（新規-指定なし/修正-change/削除-delete）

// フォーム初期値のセット
$form = array();
$form["no"] = $request["no"];
$form["post_no"] = $request["post_no"];
$form["name"] = $request["name"];
$form["content"] = $request["content"];

// 修正モード時はフォーム初期値をセット
if ($_SESSION["name"] && $_SESSION["content"]) {
    $form["name"] = $_SESSION["name"];
    $form["content"] = $_SESSION["content"];
} elseif ((!isset($request["send"]) && $mode == "change") ||  $mode == "delete") {

    try {
        $stmt = $pdo->prepare("SELECT * FROM comment WHERE post_no = ? ORDER BY no DESC");
        // $stmt = $pdo->prepare("SELECT * FROM comment WHERE post_no = ? LIMIT 1");
        $stmt->execute(array($request["no"])); // クエリの実行
        $row_comment = $stmt->fetch(PDO::FETCH_ASSOC); // SELECT結果を配列に格納
        
        if ($row_comment) {
            // データ取得成功時は、フォーム初期値をセット
            if ($mode == "change") {
                $form["name"] = $row_comment["name"];
                $form["content"] = $row_comment["content"];
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
        $article_no = intval($_GET['no']);
        $pdo->beginTransaction();
        $stmt = $pdo->prepare("DELETE FROM comment WHERE no = ?");
        $stmt->execute(array($request["no"]));
        $pdo->commit();
    } catch (PDOException $e) {
        // エラー発生時
        $pdo->rollBack();
        exit("クエリの実行に失敗しました");
    }
    header("Location: comment-list.php?no=$article_no");
    exit();
}

// エラーチェック
if (isset($request["send"])) {
    if ($request["name"] == "") {
        $page_error = "名前を入力してください\n";
    } elseif ($request["content"] == "") {
        $page_error = "コメント本文を入力してください\n";
    }
}

// 登録実行
// if (isset($request["send"]) && $page_error == "") {
//     // var_dump($request);
//     $request["no"] = intval($request["no"]);
//     // データベースへ保存
//     try {
//         $pdo->beginTransaction();
//         if ($mode == "change") {
//             // 修正モード
//             $stmt = $pdo->prepare("UPDATE comment SET name = :name, content = :content WHERE no = :no");
//             // $stmt = $pdo->prepare("UPDATE comment SET name = ?, content = ? WHERE no = ?");
//             $changes = $stmt->execute(array(':name' => $request["name"], ':content' => $request["content"], ':no' => $request["no"]));
//     // var_dump($changes);
//     // →bool(true)
//         }
//         $result = $pdo->commit();

//     // var_dump($result);
//     // →bool(true)

//     } catch (PDOException $e) {
//         // エラー発生時
//         $pdo->rollBack();
//         exit("クエリの実行に失敗しました");
//     }

//     // 完了
//     $page_message = "登録が完了しました";
// }
?>
<?php $page_name = "コメント編集";?>
<?php require "header.php";?>
<body>
    <p class="ml-20">
        <a href="comment-list.php?no=<?php echo $request['no']; ?>" class="btn btn-outline-primary my-3 ml-3">コメント一覧へ戻る</a>
    </p>
    <p class="ml-20">
        <?php echo he($page_message); ?>
    </p>
    <p class="attention ml-20">
        <?php echo he($page_error); ?>
    </p>
    <?php if ($mode == "change") {?>
        <p class="ml-20">
            コメントID[<?php echo he($form["no"]); ?>]を修正しています
        </p>
    <?php }?>

    <form action="confirm_comment-edit.php" method="post" class="pe-form">
        <div>
            名前<span class="attention">[必須]</span><br>
            <input type="text" name="name" size="30" value="<?php echo he($form["name"]); ?>">
        </div>
        <div>
            コメント本文<br>
            <textarea name="content" rows="5" cols="20"><?php echo he($form["content"]); ?></textarea>
        </div>
        <div>
            <input type="submit" name="send" value="入力確認" class="btn btn-outline-primary my-3 ml-3 w-auto">
            <input type="hidden" name="mode" value="<?php echo he($mode); ?>">
            <input type="hidden" name="no" value="<?php echo he($form["no"]); ?>">
        </div>
    </form>
    
<?php require "footer.php";?>
