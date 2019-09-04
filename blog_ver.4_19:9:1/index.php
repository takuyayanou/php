<?php require_once "system/common_admin.php";?>
<?php $page_title = "トップページ";?>
<?php require "header.php";?>
<body>
    <ul>
      <li>
        <p>ログインに成功しています。</p>
      </li>
      <li>
        <a href="post_list.php" class="btn btn-outline-primary mt-1 ml-3">記事管理</a>
      </li>
      <li>
        <a href="setting.php" class="btn btn-outline-primary mt-3 ml-3">設定画面</a>
      </li>
      <li>
        <a href="my-blog.php" class="btn btn-outline-primary mt-3 ml-3">ブログへ</a>
      </li>
      <li>
        <a href="logout.php" class="btn btn-outline-primary my-3 ml-3">ログアウト</a>
      </li>
    </ul>
    <!-- <form method="post" action="logout.php" class="d-block ml-3 my-3">
        <input type="submit" name="btn_logout" value="ログアウト" class="btn btn-outline-primary input-logout">
    </form> -->
<?php require "footer.php";?>
