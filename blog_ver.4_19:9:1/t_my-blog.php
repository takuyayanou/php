<?php require "header.php";?>

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
    <!-- mv -->
    <section id="mv">
        <div class="inner">
            <img src="<?php echo 'file_upload/mainImage/'. $mainImage['mainImage'];?>" class="box">
        </div><!-- /inner -->
    </section><!-- /mv -->


    <div id="wrap">
    <div class="inner">
    
        <div class="row mx-0">
        <!-- article -->
        <section id="article" class="col-xs-12 col-sm-9">
        <ul class="article-grid bg-white col-xs-12">
            <?php 
            if($_GET['category']) {
                $c_word = $_GET['category'];
                $category_name = "&category=$c_word";
            } elseif($_GET['search']) {
                $word = $_GET['search'];
                $category_name = "&search=$word";
            }
            ?>
            <?php foreach ($posts as $post) { ?>
                <!-- 1 -->
                <li class="jsScroll jsReach jsSlide">
                    <a href="/post-article.php?no=<?php echo $post['no'] ?>">
                        <div class="imgEffect">
                            <div class="imgCover"></div>
                            <img src="img/about.jpg" alt="">
                        </div>
                        <div class="textArea">

                            <div class="tA-title">
                                <p class="date"><?php echo $post['time'] ?></p>
                                <p class="cat"><?php echo $post['category'] ?></p>
                            </div>

                            <h2>
                            <!-- 本文は複数行入る可能性があるので、nl2br関数で改行をbrタグに変換しています。 -->
                                <span><?php echo nl2br($post['title']) ?></span>
                            </h2>
                            
                        </div>
                    </a>
                    <div class="good">
                        <span class="good-count">
                            
                            <i class="far fa-thumbs-up" id="<?php echo $post['good_no']; ?>" data-postno="<?php echo $post['no']; ?>"></i>
                            <span><?php echo empty($post['count']) ? 0: $post['count']; ?></span>
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
                </li>
            <?php } ?>
        </ul>
        <div id="pagination col-xs-12">
            <ul class="pagination" role="menubar" aria-label="Pagination">
                <li>
                    <?php
                    if($now > 1){ // リンクをつけるかの判定
                    echo '<a href=\'/my-blog.php?page='.($now - 1). $category_name. '\')><i class="fas fa-angle-left"></i></a>';
                    } else {
                        echo '<i class="fas fa-angle-left"></i>';
                    }
                    ?>
                </li>

                <li>
                    <?php 
                    for($i = 1; $i <= $max_page; $i++){
                        if ($i == $now) {
                            echo $now. ' '; 
                        } else {
                            echo '<a href=\'/my-blog.php?page='. $i. $category_name. '\')>'. $i. '</a>'. ' ';
                        }
                    } 
                    ?>
                </li>

                <li>
                    <?php
                        if($now < $max_page){ // リンクをつけるかの判定
                            echo '<a href=\'/my-blog.php?page='.($now + 1). $category_name.'\')><i class="fas fa-angle-right"></i></a>'. ' ';
                        } else {
                            echo '<i class="fas fa-angle-right"></i>';
                        }
                    ?>
                </li>
            </ul>
        </div>
        </section><!-- /article -->

        
    <!-- aboutme -->
    <section id="aboutMe" class="col-xs-12 col-sm-3">
        <aside id="sidebar" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
            <div class="col-xs-12 author bg-white">
                <img src="<?php echo 'file_upload/self_introduce/'. $selfImage['selfImage'];?>" class="img-responsive img-circle">
                <h4><?php echo $self_introduce['name'];?></h4>
                <hr>
                <p><?php echo $self_introduce['content'];?></p>
            </div>

            <div class="col-xs-12 most_news bg-white">
                <form action="my-blog.php" method="get" id="searchform">
                    <input type="search" name="search" value="<?php echo $search_value ?>" placeholder="keyword">
                    <button type="submit" id="searchsubmit">
                    <i class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="col-xs-12 most_news bg-white">
                <h4>最新記事</h4>
                <hr>
                <?php foreach ($news_posts as $news_post) { ?>
                    <a href="/post-article.php?no=<?php echo $news_post['no'] ?>">
                        <div class="imgEffect">
                            <div class="imgCover"></div>
                            <img src="img/about.jpg" alt="">
                        </div>
                        <div class="textArea">
                            <span class="cat"><?php echo $news_post['title'] ?></span>
                        </div>
                    </a>
                <?php } ?>
            </div>

            <div class="col-xs-12 most_news bg-white">
                <h4>アクセスランキング</h4>
                <hr>
                <?php foreach ($rankings as $ranking) { ?>
                    <a href="/post-article.php?no=<?php echo $ranking['no']; ?>">
                        <div class="imgEffect">
                            <div class="imgCover"></div>
                            <img src="img/about.jpg" alt="">
                        </div>
                        <div class="textArea">
                            <span class="cat"><?php echo $ranking['title'] ?></span>
                        </div>
                    </a>
                <?php } ?>
            </div>
            
            <div class="col-xs-12 most_news bg-white">
                <h4>category</h4>
                <hr>
                <?php foreach ($categorys as $rows) { ?>
                    <?php foreach ($rows as $category) { ?>
                    <ul>
                        <li>
                        <a href="/my-blog.php?category=<?php echo $category; ?>">
                            <div class="textArea">
                                <span class="cat">
                                
                                    <?php echo $category; ?>
                                
                            </div>
                        </a>
                        </li>
                    </ul>
                    <?php } ?></span>
                <?php } ?>
            </div>

        </aside>
    </section><!-- /aboutme -->
    </div><!-- /row -->

    
    </div><!-- /inner -->
    </div><!-- /wrap -->

    <!-- contactArea -->
    <section id="contactArea">
        <h4>CONTACT</h4>
        <p>
            ご意見やご感想、お仕事のご依頼など
            <br class="sp-show">
            お気軽にご連絡ください。
        </p>
        <a href="myworks-contact.php" class="contactBtn">
            <div class="btn">
                <span class="btnText">CONTACT FORM</span>
                <span class="btnArrow">
                    <span class="line"></span>
                    <span class="arrow"></span>
                </span>
            </div>
        </a>
    </section><!-- /contact -->

<?php require "footer.php";?>