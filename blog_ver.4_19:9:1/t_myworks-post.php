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
                <li><a class="drawer-menu-item" href="#service">menu2</a></li>
                <li><a class="drawer-menu-item" href="#results">menu3</a></li>
                <li><a class="drawer-menu-item" href="#faqs">menu4</a></li>
                <li><a class="drawer-menu-item" href="#price">menu5</a></li>
                <li><a class="drawer-menu-item" href="#comments">menu6</a></li>
                <li><a class="drawer-menu-item" href="myworks-contact.php">Contact</a></li>
            </ul>
        </nav><!-- drawer-nav -->
    </div>

</div><!-- inner -->
</header> <!-- header -->


<main role="main">

    <!-- post -->
    <section id="post">
        <div class="post-form">

            <!-- contact-content -->
            <form class="contact-content" action="confirm-myworks-post.php" method="post">

                <!-- contact-dl -->
                <dl class="contact-dl">
                    <dt class="contact-label">題名<span class="contact-required con-re-1">必須</span></dt>
                    <dd class="contact-input mb-39"><input type="text" value="<?php echo $title ?>" name="title"></dd>
                    
                </dl><!-- /contact-dl -->

                <dl class="contact-dl">
                    <dt class="contact-label">カテゴリ<span class="contact-required con-re-1">必須</span></dt>
                    <dd class="contact-input mb-39">
                    <input type="text" value="<?php echo $category ?>" name="category"></dd>
                </dl>
                    
                <dl class="contact-dl">
                    <dt class="contact-label">本文</dt>
                    <dd class="contact-input con-input-1 mb--3"><textarea name="content" cols="40" rows="8"><?php echo $content ?></textarea></dd>
                    
                </dl>

                <div class="contact-send">
                    <input type="submit" value="入力確認" name="submit">
                </div><!-- /contact-send -->
                <p><?php echo $error ?></p>
                
            </form><!-- /contact-content -->
            
        </div><!-- /contact-form -->
    </section><!-- /contact -->
</main>

<!-- footer -->
<footer id="footer">
	<div class="inner">
		<p class="policy"><a href="">プライバシーポリシー</a></p>
        <p class="copyright">&copy; TAKUYA YANO All Rights Reserved.</p>
	</div>
</footer><!-- /footer -->


    <!-- drawer.js ここにないと作動しない。-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
    <!-- ドロワーメニューの利用宣言 -->
    <script>
        $(document).ready(function() {
        $('.drawer').drawer();
    });
    </script>

    <script>
    jQuery(window).on("scroll", function($) {
        if (jQuery(this).scrollTop() > 100) {
        jQuery('.floating').show();
        } else {
        jQuery('.floating').hide();
        }
    });
    
    jQuery('.floating').click(function () {
        jQuery('body,html').animate({
        scrollTop: 0
        }, 500);
        return false;
    });
    </script>


<script src="script.js"></script>
</div><!-- /.wrap -->
</body>
</html>