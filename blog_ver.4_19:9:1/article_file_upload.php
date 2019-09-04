<?php
require_once "system/common_admin.php";
$article_no = intval($_GET['no']);
// 記事画像＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
if(!empty($_FILES)) {
    $fileName = $_FILES['articleImage']['name'];

    if($fileName != "") {
        $articleImage = $fileName;

        move_uploaded_file($_FILES['articleImage']['tmp_name'],'file_upload/articleImage/'. $articleImage);

        // $sql = sprintf('INSERT INTO articleImage_upload SET articleImage="%s"', $articleImage);
        // $stmt = $pdo->prepare($sql);

        $sql = sprintf('INSERT INTO articleImage_upload SET post_no="%d", articleImage="%s"', $article_no, $articleImage);
        $stmt = $pdo->prepare($sql);
        $stmt -> execute();
        
        // $stmt -> execute(array(null, $article_no, $articleImage));

        // header("Location: post_list.php");
        // exit;
    }   
}

    $staf = $pdo->query("SELECT * FROM articleImage_upload WHERE post_no=$article_no ORDER BY no DESC");
    $articleImage = $staf->fetch(PDO::FETCH_ASSOC);

    // $st = $pdo->query("SELECT * FROM comment WHERE post_no=$article_no ORDER BY no DESC");

?>
<p><?php echo $article_no;?></p>
<div class="main-image">
    <form action="article_file_upload.php?no=<?php echo $article_no;?>" method="post" enctype="multipart/form-data" class="ml-3 mb-3 fs-9">
        <label>画像</label>
        <input type="file" name="articleImage" class="input-upfile">
        <input type="submit" value="アップロード" class="btn btn-outline-primary input-logout w-20 mt-1">
    </form>
    <img src="<?php echo 'file_upload/articleImage/'. $articleImage['articleImage'];?>">
</div>