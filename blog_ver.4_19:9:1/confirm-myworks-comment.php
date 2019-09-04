<?php require_once "system/common_admin.php";

    // 変数の初期化
    $error = $name = $content = '';

    // 現在の日付を取得
    $updated_time = date('Y-m-d H:i:s');
    $created_time = date('Y-m-d');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームから送信されたデータを各変数に格納
        $post_no = $_POST["post_no"];
        $name = $_POST["name"];
        $content = $_POST["content"];
    }
    $_SESSION["post_no"] = $post_no;
    $_SESSION["name"] = $name;
    $_SESSION["content"] = $content;

    // ホワイトリスト変数の作成
    $whitelist = array("send", "post_no", "name", "content");
    $request = whitelist($whitelist);

    // エラーチェック
    if (isset($request["send"])) {
        if ($_SESSION["name"] == "") {
            $page_error = "名前を入力してください\n";
            // header("Location: post_edit.php");
        } elseif ($_SESSION["content"] == "") {
            $page_error = "本文を入力してください\n";
        }
    }

// メイン画像＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
// if(!empty($_FILES)) {
//     $fileName = $_FILES['articleImage']['name'];
// // var_dump($fileName);
//     if($fileName != "") {
//         $articleImage = $fileName;

//         move_uploaded_file($_FILES['articleImage']['tmp_name'],'file_upload/articleImage/'. $articleImage);

//         $sql = sprintf('INSERT INTO post SET articleImage="%s"', $articleImage);
// var_dump($sql);
//         $stmt = $pdo->prepare($sql);
//         $stmt -> execute();
//     }
// }

// $stmt = $pdo->query('SELECT * FROM post WHERE post_no=1');
// $articleImage = $stmt->fetch(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="ページの内容を表す文章">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- drawer.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
    
    <!-- jquery & iScroll -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
    
    <!-- スムーズなページ内を移動をサポートしてくれる「smooth-scroll.js」 -->
    <script src="js/smooth-scroll.polyfills.min.js"></script>

    <title>記事投稿 | Special Blog</title>

    <link rel="stylesheet" href="css/myworks-post_style.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>    
</head>

<body>
<div class="wrap">

<!-- header -->

<main role="main" class="mt-0">

    <!-- mv -->
    <!-- <section id="mv">
        <div class="inner"> -->

        <!-- </div> -->
        <!-- /inner -->
    <!-- </section> -->
    <!-- /mv -->

    <!-- contact -->
    <section id="contact">
        <div class="contact-form">
        <h4 class="ml-20 mt-3">新しいコメントの入力確認</h4>
            <!-- contact-content -->
            <div class="contact-content-1 ml-20 mt-3">
                <!-- contact-dl -->
                <dl class="contact-dl">
                    <dt class="contact-label">名前</dt>
                    <dd class="contact-input-2 mb-39">
                        <?php echo $_SESSION["name"];?>
                    </dd>
                </dl>

                <!-- contact-dl -->
                <dl class="contact-dl">
                    <dt class="contact-label">本文</dt>
                    <dd class="contact-input-2 con-input-1 mb--3">
                        <?php echo $_SESSION["content"];?>
                    </dd>
                </dl>

                <!-- <dl class="contact-dl">
                    <dt class="contact-label-1">画像アップロード</dt>
                    <dd class="contact-input-1 mb-39">
                    </dd>
                </dl> -->
                <?php
                    //ホスト名取得
                    $h = $_SERVER['HTTP_HOST'];
                    
                    // リファラ値があれば、かつ外部サイトでなければaタグで戻るリンクを表示
                    if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$h) !== false)) {
                ?>
                <div class="mt-10">
                    <?php echo '<a href="' . $_SERVER['HTTP_REFERER'] . '" class="btn btn-outline-primary mt-3 ml-3">前に戻る</a>';
                    }?>
                    
                </div><!-- /contact-send -->

                <div class="mt-10">
                    <a href="confirm-fin_myworks-comment.php" class="btn btn-outline-primary mt-3 ml-3">投稿</a>
                </div><!-- /contact-send -->
                
            </div><!-- /contact-content -->
            
        </div><!-- /contact-form -->
    </section><!-- /contact -->
</main>

<?php require "footer.php";?>