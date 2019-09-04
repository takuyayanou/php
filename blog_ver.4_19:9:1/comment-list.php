<?php 
require_once "system/common_admin.php";

// データの問い合わせ
// $rows_comment = array(); // 配列の初期化
$comment_no = intval($_GET['no']);

// var_dump($comment_no);

try {
    $st = $pdo->query("SELECT * FROM comment WHERE post_no=$comment_no ORDER BY no DESC");
    $cl_comments = $st->fetchAll(PDO::FETCH_ASSOC); // SELECT結果を二次元配列に格納
} catch (PDOException $e) {
    // エラー発生時
    exit("クエリの実行に失敗しました");
}
?>
<?php $page_title = "記事管理";?>
<?php require "header.php";?>
    <ul>
        <!-- <li>
        <p>ログインに成功しました。</p>
        </li> -->
        <!-- <li>
            <a href="myworks-post.php" class="btn btn-outline-primary mt-3 ml-3">記事を追加する</a>
        </li> -->
        <li>
            <a href="post_list.php" class="btn btn-outline-primary mt-3 ml-3">記事管理</a>
        </li>
        <li>
            <a href="setting.php" class="btn btn-outline-primary mt-3 ml-3">自己紹介設定へ</a>
        </li>
        <li>
            <a href="my-blog.php" class="btn btn-outline-primary my-3 ml-3">ブログへ</a>
        </li>
    </ul>

<div class="pl">

<?php if ($cl_comments) {?>

    <table border="1" width="100%" class="pl-table">
        <tr>
            <!-- <th></th> -->
            <th>名前</th>
            <th>本文</th>
            <th>更新日時</th>
            <th>作成日時</th>
        </tr>
    <?php     foreach ($cl_comments as $cl_comment) {;?>
        <tr>
            <!-- <td>
                <a href="comment-edit.php?mode=change&no=<?php echo he($cl_comment["post_no"]);?>" class="d-block btn btn-outline-primary mt-3">編集</a>
                <a href="comment-edit.php?mode=delete&no=<?php echo he($cl_comment["post_no"]);?>" class="d-block btn btn-outline-primary mt-3">削除</a>
            </td> -->
            <td><?php echo he($cl_comment["name"]);?></td>
            <td><?php echo nl2br(he($cl_comment["content"]));?></td>
            <td><?php echo he($cl_comment["updated_time"]);?></td>
            <td><?php echo he($cl_comment["created_time"]);?></td>
        </tr>
    <?php     }?>
    </table>
<?php }?>

</div>
<?php require "footer.php";?>
