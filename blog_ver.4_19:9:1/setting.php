<?php $page_title = "記事管理";?>
<?php require "header.php";?>
<div class="mt-10">
    <ul>
        <!-- <li>
        <p>ログインに成功しました。</p>
        </li> -->
        <li class="">
            <a href="post_list.php" class="btn btn-outline-primary mt-3 ml-3">記事管理へ</a>
        </li>
        <li class="d-inline-block">
            <a href="my-blog.php" class="btn btn-outline-primary mt-3 ml-3">ブログへ</a>
        </li>
        <li>
            <a href="logout.php" class="btn btn-outline-primary my-3 ml-3">ログアウト</a>
        </li>
    </ul>
    <!-- <a href="index.php" class="btn btn-outline-primary my-3 ml-3">一覧へ戻る</a> -->
</div>

<!-- <div class="">
    <h3>設定</h3>
    <div class="mt-10">
        <ul>
            <li class="">
                <a href="self_introduce.php" class="btn btn-outline-primary mt-3 ml-3">自己紹介</a>
            </li>
            <li class="d-inline-block">
                <a href="blog
                _name.php" class="btn btn-outline-primary mt-3 ml-3">ブログ名</a>
            </li>
        </ul>
    </div>
</div> -->


<div class="tab_wrap">
	<input id="tab1" type="radio" name="tab_btn" checked>
	<input id="tab2" type="radio" name="tab_btn">
	<input id="tab3" type="radio" name="tab_btn">

	<div class="tab_area">
		<label class="tab1_label" for="tab1">自己紹介</label>
		<label class="tab2_label" for="tab2">ブログ名</label>
		<label class="tab3_label" for="tab3">フッターテキスト</label>
	</div>

    <!-- 自己紹介 -->
    <?php 
        require_once "system/common_admin.php";

        // 自己紹介文＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
        
        // データの問い合わせ
        $self_introduce = array(); // 配列の初期化
        try {
            $st_self_introduce = $pdo->query("SELECT * FROM self_introduce ORDER BY no DESC limit 0, 1");
            $self_introduce = $st_self_introduce->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // エラー発生時
            exit("クエリの実行に失敗しました");
        }

        // 自己紹介画像＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
        if(!empty($_FILES)) {
            $fileName = $_FILES['selfImage']['name'];
        // var_dump($fileName);
            if($fileName != "") {
                $selfImage = $fileName;

                move_uploaded_file($_FILES['selfImage']['tmp_name'],'file_upload/self_introduce/'. $selfImage);

                $sql = sprintf('INSERT INTO self_introduceImage_upload SET selfImage="%s"', $selfImage);
                $stmt = $pdo->prepare($sql);
                $stmt -> execute();
            }
        }

        $stsi = $pdo->query('SELECT * FROM self_introduceImage_upload ORDER BY no DESC LIMIT 1');
        $selfImage = $stsi->fetch(PDO::FETCH_ASSOC);
        
    ?>

	<div class="panel_area">
		<div id="panel1" class="tab_panel main-image">
        <h3>自己紹介</h3>
            <form action="setting.php" method="post" enctype="multipart/form-data" class="ml-3 mb-3 fs-9">
                <label>自己紹介画像</label>
                <input type="file" name="selfImage" class="input-upfile">
                <input type="submit" value="アップロード" class="btn btn-outline-primary input-logout w-20 mt-1">
            </form>
            <img src="<?php echo 'file_upload/self_introduce/'. $selfImage['selfImage'];?>" class="self-image">

        <div class="pl">
        <?php if ($self_introduce) {?>
            <table border="1" width="100%" class="s-table">
                <tr>
                    <th></th>
                    <th>名前</th>
                    <th>本文</th>
                </tr>
                <tr>
                    <td>
                        <a href="self_introduce_edit.php?mode=change&no=<?php echo he($self_introduce["no"]);?>" class="d-block btn btn-outline-primary mt-3">編集</a>

                    </td>
                    <td><?php echo he($self_introduce["name"]);?></td>
                    <td><?php echo nl2br(he($self_introduce["content"]));?></td>
                </tr>
            <?php     }?>
                </table>
        </div>
    </div>

    <!-- ブログ名 -->
    <?php

        // データの問い合わせ
        $headerText = array(); // 配列の初期化
        try {
            $st_ht = $pdo->query("SELECT * FROM header_text ORDER BY no DESC limit 0, 1");
            $headerText = $st_ht->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // エラー発生時
            exit("クエリの実行に失敗しました");
        }
    ?>

    <div id="panel2" class="tab_panel header-text">
        <h3>ブログ名</h3>
        <div class="pl">
        <?php if ($headerText) {?>
            <table border="1" width="100%" class="s-table">
                <tr>
                    <th></th>
                    <th>本文</th>
                </tr>
                <tr>
                    <td>
                        <a href="header_text_edit.php?mode=change&no=<?php echo he($headerText["no"]);?>" class="d-block btn btn-outline-primary">編集</a>

                    </td>
                    <td><?php echo nl2br(he($headerText["ht_content"]));?></td>
                </tr>
                </table>
            <?php     }?>
        </div>
    </div>

    <!-- フッターテキスト -->
    <?php

    // データの問い合わせ
    $footerText = array(); // 配列の初期化
    try {
        $st_ft = $pdo->query("SELECT * FROM footer_text ORDER BY no DESC limit 0, 1");
        $footerText = $st_ft->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // エラー発生時
        exit("クエリの実行に失敗しました");
    }
    ?>
    <div id="panel3" class="tab_panel">
        <h3>フッターテキスト</h3>
        <div class="pl">
        <?php if ($footerText) {?>
            <table border="1" width="100%" class="s-table">
                <tr>
                    <th></th>
                    <th>本文</th>
                </tr>
                <tr>
                    <td>
                        <a href="footer_text_edit.php?mode=change&no=<?php echo he($footerText["no"]);?>" class="d-block btn btn-outline-primary">編集</a>

                    </td>
                    <td><?php echo nl2br(he($footerText["ft_content"]));?></td>
                </tr>
            </table>
        <?php }?>
        </div>
    </div>

	</div>
</div>


<!-- self_introduce_upload================================================== -->
<!-- <div class="main-image">
    <h3>自己紹介</h3>
    <form action="setting.php" method="post" enctype="multipart/form-data" class="ml-3 mb-3 fs-9">
        <label>自己紹介画像</label>
        <input type="file" name="selfImage" class="input-upfile">
        <input type="submit" value="アップロード" class="btn btn-outline-primary input-logout w-20 mt-1">
    </form>
    <img src="<?php echo 'file_upload/self_introduce/'. $selfImage['selfImage'];?>" class="self-image">


    <div class="pl">
    <?php if ($self_introduce) {?>
        <table border="1" width="100%" class="pl-table">
            <tr>
                <th></th>
                <th>名前</th>
                <th>本文</th>
            </tr>
            <tr>
                <td>
                    <a href="self_introduce_edit.php?mode=change&no=<?php echo he($self_introduce["no"]);?>" class="d-block btn btn-outline-primary mt-3">編集</a>

                </td>
                <td><?php echo he($self_introduce["name"]);?></td>
                <td><?php echo nl2br(he($self_introduce["content"]));?></td>
            </tr>
        <?php     }?>
            </table>
    </div>
</div>

<div class="header-text">
    <h3>ブログ名</h3>
    <div class="pl">
    <?php if ($headerText) {?>
        <table border="1" width="100%" class="pl-table">
            <tr>
                <th></th>
                <th>本文</th>
            </tr>
            <tr>
                <td>
                    <a href="header_text_edit.php?mode=change&no=<?php echo he($headerText["no"]);?>" class="d-block btn btn-outline-primary mt-3">編集</a>

                </td>
                <td><?php echo nl2br(he($headerText["content"]));?></td>
            </tr>
        <?php     }?>
            </table>
    </div>
</div> -->
<?php require "footer.php";?>
