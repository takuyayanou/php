<?php 
    require_once "system/common_admin.php";
    // データの問い合わせ
    $rows_post = array(); // 配列の初期化
    try {
        $stmt = $pdo->prepare("SELECT * FROM post ORDER BY no DESC");
        $stmt->execute(); // クエリの実行
        $rows_post = $stmt->fetchAll(); // SELECT結果を二次元配列に格納

        
    } catch (PDOException $e) {
        // エラー発生時
        exit("クエリの実行に失敗しました");
    }

// メイン画像＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
    if(!empty($_FILES)) {
        $fileName = $_FILES['mainImage']['name'];
    // var_dump($fileName);
        if($fileName != "") {
            $mainImage = $fileName;

            move_uploaded_file($_FILES['mainImage']['tmp_name'],'file_upload/mainImage/'. $mainImage);

            $sql = sprintf('INSERT INTO mainImage_upload SET mainImage="%s"', $mainImage);
            $stmt = $pdo->prepare($sql);
            $stmt -> execute();
        }
    }

    $stmt = $pdo->query('SELECT * FROM mainImage_upload ORDER BY no DESC LIMIT 1');
    $mainImage = $stmt->fetch(PDO::FETCH_ASSOC);

// // 記事画像＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
//     if(!empty($_FILES)) {
//         $Article_fileName = $_FILES['articleImage']['name'];
//     // var_dump($fileName);
//         if($Article_fileName != "") {
//             $articleImage = $Article_fileName;

//             move_uploaded_file($_FILES['articleImage']['tmp_name'],'file_upload/articleImage/'. $articleImage);

//             $sql = sprintf('INSERT INTO articleImage_upload SET articleImage="%s"', $articleImage);
//             $stmt = $pdo->prepare($sql);
//             $stmt -> execute();
//         }
//     }

//     $stmt = $pdo->query('SELECT * FROM articleImage_upload ORDER BY no DESC LIMIT 1');
//     $articleImage = $stmt->fetch(PDO::FETCH_ASSOC);

// ?>

<?php $page_title = "記事管理";?>
<?php require "header.php";?>
    <ul>
        <li>
            <a href="setting.php" class="btn btn-outline-primary mt-3 ml-3">設定画面へ</a>
        </li>

        <li class="d-inline-block">
            <a href="my-blog.php" class="btn btn-outline-primary mt-3 ml-3">ブログへ</a>
        </li>

        <li>
            <a href="logout.php" class="btn btn-outline-primary my-3 ml-3">ログアウト</a>
        </li>
    </ul>

    <div class="main-image">
        <form action="post_list.php" method="post" enctype="multipart/form-data" class="ml-3 mb-3 fs-9">
            <label>メイン画像</label>
            <input type="file" name="mainImage" class="input-upfile">
            <input type="submit" value="アップロード" class="btn btn-outline-primary input-logout w-20 mt-1">
        </form>
        <img src="<?php echo 'file_upload/mainImage/'. $mainImage['mainImage'];?>" class="self-image">
    </div>

<div>
    <a href="myworks-post.php" class="btn btn-outline-primary my-3 ml-3">記事を追加する</a>
</div>
<div class="pl">

<?php if ($rows_post) {?>
    <table border="1" width="100%" class="pl-table">
        <tr>
            <th></th>
            <th>タイトル</th>
            <th>画像・動画</th>
            <th>カテゴリ</th>
            <th>本文</th>
            <th>更新日時</th>
            <th>作成日時</th>
        </tr>
    <?php foreach ($rows_post as $row_post) { ;?>
        <tr>
            <td>
                <a href="post_edit.php?mode=change&no=<?php echo he($row_post["no"]);?>" class="d-block btn btn-outline-primary mt-3">編集</a>

                <!-- <form action="post_edit.php?mode=delete&no=<?php echo he($row_post["no"]);?>" method="post" onsubmit="return submitChk()" class="d-block mt-3 c-white">
                    <input type="submit" value="削除" class="btn btn-outline-primary input-logout w-100">
                </form> -->
                <a href="post_edit.php?mode=delete&no=<?php echo he($row_post["no"]);?>" class="d-block btn btn-outline-primary mt-3 pe-delete" id="<?php echo $row_post['no']; ?>">削除</a>

                <!-- onclick="submitChk('外部のページへ移動します。よろしいですか？')" -->


                <a href="comment-list.php?no=<?php echo he($row_post["no"]);?>" class="d-block btn btn-outline-primary mt-3">コメント一覧
                    <?php
                        $st_comment = $pdo->prepare("SELECT * FROM comment WHERE post_no={$row_post['no']}");
                        $st_comment->execute(); // クエリの実行
                        $comments = $st_comment->fetchAll(PDO::FETCH_ASSOC); // SELECT結果を二次元配列に格納
                        $comments_num = count($comments);
                    ?>
                    (<?php echo $comments_num; ?>件)
                </a>
            </td>
            <td><?php echo he($row_post["title"]);?></td>
            <td>
                <!-- 工事中・・・ -->
                <a href="article_file_upload.php?no=<?php echo he($row_post["no"]);?>">記事のアップロードへ</a>
            </td>
            <td><?php echo he($row_post["category"]);?></td>
            <td><?php echo nl2br(he($row_post["content"]));?></td>
            <td><?php echo he($row_post["updated_time"]);?></td>
            <td><?php echo he($row_post["time"]);?></td>
        </tr>
    <?php     }?>
        </table>
    <?php }?>
</div>
<?php require "footer.php";?>
