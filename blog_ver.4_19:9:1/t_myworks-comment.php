<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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

    <!-- contact -->
    <section id="contact">
        <div class="contact-form">

            <!-- contact-content -->
            <form class="contact-content" action="confirm-myworks-comment.php" method="post">

                <!-- contact-dl -->
                <dl class="contact-dl">
                    <dt class="contact-label">お名前
                    <dd class="contact-input mb-39"><input type="text" value="<?php echo $name ?>" name="name" size="40"></dd>
                    
                </dl><!-- /contact-dl -->
                    
                <dl class="contact-dl">
                    <dt class="contact-label">コメント</dt>
                    <dd class="contact-input con-input-1 mb--3"><textarea name="content" cols="40" rows="8"><?php echo $content ?></textarea></dd>
                    
                </dl>

                <input type="hidden" name="post_no" value="<?php echo $_GET['no'];?>">

                <div class="contact-send">
                    <input type="submit" value="入力確認" name="submit">
                </div><!-- /contact-send -->
                <p><?php echo $error ?></p>
                
            </form><!-- /contact-content -->
            
        </div><!-- /contact-form -->
    </section><!-- /contact -->
</main>

<?php require "footer.php";?>