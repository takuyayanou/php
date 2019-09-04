<?php $page_title = "記事管理";?>
<?php require "header.php";?>
<div class="mt-10">
    <ul>
        <!-- <li>
        <p>ログインに成功しました。</p>
        </li> -->
        <li class="">
            <a href="setting.php" class="btn btn-outline-primary mt-3 ml-3">設定画面へ</a>
        </li>
        <!-- <li class="d-inline-block">
            <a href="my-blog.php" class="btn btn-outline-primary mt-3 ml-3">ブログへ</a>
        </li>
        <li>
            <a href="logout.php" class="btn btn-outline-primary my-3 ml-3">ログアウト</a>
        </li> -->
    </ul>
    <!-- <a href="index.php" class="btn btn-outline-primary my-3 ml-3">一覧へ戻る</a> -->
</div><!-- /contact-send -->

<!-- self_introduce_upload================================================== -->
<div class="main-image">
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
</div>
<?php require "footer.php";?>
