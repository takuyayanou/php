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

    <title><?php echo $article_one['title']; ?></title>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>    
    <link rel="stylesheet" href="css/myworks-post_style.css">
</head>

<body class="drawer drawer--right">
<div class="wrap">

<!-- header -->
<header id="header" role="banner">
<div class="inner">

    <div class="header-left">
        <!-- header-img -->
        <div class="header-img">
            <a href="my-blog.php">
                <p class="ht"><?php echo $headerText["ht_content"]; ?></p>
            </a>
        </div>
        <!-- <div class="header-text">
            <p>「プログラマー × 家庭教師 × ソフトボール × 英語 × 講演家」   </p>
        </div> -->
    </div>

        
    <div class="header-right">
        <button type="button" class="drawer-toggle drawer-hamburger">
            <span class="sr-only">toggle navigation</span>
            <span class="drawer-hamburger-icon"></span>
        </button>
        <!-- drawer-nav -->
        <nav  class="drawer-nav" role="navigation">
            <ul class="drawer-menu">
                <li><a class="drawer-menu-item" href="my-blog.php">home</a></li>
                <li><a class="drawer-menu-item" href="">menu2</a></li>
                <li><a class="drawer-menu-item" href="">menu3</a></li>
                <li><a class="drawer-menu-item" href="">menu4</a></li>
                <li><a class="drawer-menu-item" href="">menu5</a></li>
                <li><a class="drawer-menu-item" href="">menu6</a></li>
                <li><a class="drawer-menu-item" href="myworks-contact.php">Contact</a></li>
            </ul>
        </nav><!-- drawer-nav -->
    </div>

</div><!-- inner -->
</header> <!-- header -->


<main role="main">

<!-- <section id="mv">
    <div class="inner">

    </div> -->
    <!-- /inner -->
<!-- </section> -->
<!-- /mv -->
    <div id="wrap">
    <div class="inner">
    
        <div class="row mx-3 row-dis">
        <!-- article -->
        <section id="article" class="col-xs-12">
            <div class="imgEffect">
                <div class="imgCover"></div>
                <img src="img/about.jpg" alt="">
                <div class="text">
                    <p class="date d-inline-block"><?php echo $article_one['time']; ?></p>
                    <p class="date pl-2 d-inline-block"><?php echo $article_one['category']; ?></p>
                    <h3 class="cat"><?php echo $article_one['title']; ?></h3>
                </div>
            </div>

            <div class="textArea">
                <h3>
                <!-- 本文は複数行入る可能性があるので、nl2br関数で改行をbrタグに変換しています。 -->
                    <span><?php echo nl2br($article_one['content']); ?></span>
                </h3>
            </div>

            <div class="good">
                <span class="good-count">
                    <i class="far fa-thumbs-up" id="<?php echo $article_one['good_no']; ?>" data-postno="<?php echo $article_one['no']; ?>"></i>
                    <span><?php echo empty($article_one['count']) ? 0: $article_one['count']; ?></span>
                </span>
            </div>

            <div class="good mt-0">
                <span class="good-count">
                    <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2Flocalhost%3A8888%2Fpost-article.php%3Fno%3D%3C%3Fphp%20echo%20%24article_no&width=83&layout=button_count&action=like&size=small&show_faces=false&share=false&height=21&appId" width="83" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </span>
            </div>

            <div class="good">
                <span class="good-count">
                    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </span>
            </div>
            

            <div class="comments">
                <h4><i class="fas fa-comment-dots"></i>COMMENT</h4>

<!-- １：fetchAllした配列をforeachする -->
                        <?php foreach ($comments as $comment) { ?>
                        <div class="comment-title">
                            <p class="ct-1"><?php echo $comment['name']; ?></p>
                            <p class="ct-2"><?php echo $comment['updated_time']; ?></p>
                        </div>
                        <p><?php echo nl2br($comment['content']); ?></p>

                        <?php } ?>

                    <p class="commment_link">
                        <a href="myworks-comment.php?no=<?php echo $article_no; ?>" class="btn btn-outline-primary mt-4 my-3">コメントする</a>
                    </p>
            </div>
            <?php
                //ホスト名取得
                $h = $_SERVER['HTTP_HOST'];
                
                // リファラ値があれば、かつ外部サイトでなければaタグで戻るリンクを表示
                if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$h) !== false)) {
            ?>
            <div class="commment_link_1">
                <?php echo '<a href="my-blog.php" class="btn btn-outline-primary mt-4 my-3">ブログへ戻る</a>';
                }?>
                
            </div><!-- /contact-send -->

            <div class="share-container">
                <p class="title">SHARE</p>
                <ul class="sns-wrap">

                    <li class="facebook">
                        <a href="javascript:window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(location.href),'sharewindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=!');"><i class="fab fa-facebook-f"></i></a>
                    </li>

                    <li class="twitter">
                        <a href="javascript:window.open('http://twitter.com/share?text='+encodeURIComponent(document.title)+'&url='+encodeURIComponent(location.href),'sharewindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=!');"><i class="fab fa-twitter"></i></a>
                    </li>


                    <li class="google">
                        <a href="javascript:window.open('https://plus.google.com/share?url='+encodeURIComponent(location.href),'sharewindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=!');"><i class="fab fa-google-plus-g"></i></a>
                    </li>

                    <li class="line">
                        <a href="javascript:window.open('http://line.me/R/msg/text/?'+encodeURIComponent(document.title)+'%20'+encodeURIComponent(location.href),'sharewindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=!');"><i class="fab fa-line"></i></a>
                    </li>
                </ul>
            </div>


            <!-- <div class="commment_link_1">
                <a href="my-blog.php" class="btn btn-outline-primary mt-4 my-3">ブログへ戻る</a>
            </div> -->

    
            
        </section><!-- /article -->
    </div><!-- /inner -->
    </div><!-- /wrap -->

</main>

<?php require "footer.php";?>