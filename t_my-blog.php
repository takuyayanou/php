<?php require "header.php";?>

<body class="drawer drawer--right">
<div class="wrap">

<!-- header -->
<header id="header" role="banner">
<div class="inner">

    <div class="header-left">
        <!-- header-img -->
        <div class="header-img">
            <a href="my-blog.php" class="hl">
                <p class="ht"><?php echo $headerText["ht_content"]; ?></p>
                <span class="h-sub">「家族 × プログラミング × ソフトボール」</span>
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
                <a class="drawer-menu-item" href="my-blog.php">
                    <li class="hr-menu">Home</li>
                </a>
                <a class="drawer-menu-item" href="https://www.takuyano-portfolio.com" target="_blank">
                    <li class="hr-menu">代表プロフィール</li>
                </a>
                <a class="drawer-menu-item" href="softball.php">
                    <li class="hr-menu">ソフトボール研究所(準備中)</li>
                </a>
                <a class="drawer-menu-item" href="myworks-contact.php">
                    <li class="hr-menu" href="myworks-contact.php">Contact</li>
                </a>
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
                        <!-- 記事画像====================================================== -->
                            <?php
                                $article_no = $post["no"];
                                $st_af = $pdo->query("SELECT * FROM articleImage_upload WHERE post_no=$article_no ORDER BY no DESC");
                                $articleImage = $st_af->fetch(PDO::FETCH_ASSOC);

                            ?>
                            <img src="<?php echo 'file_upload/articleImage/'. $articleImage['articleImage'];?>" class="article-img">
                        </div>
                        <div class="textArea">

                            <div class="tA-title">
                            <?php
                                $date = $post['time'];
                            ?>
                                <p class="date"><?php echo date('Y/m/d', strtotime($date)); ?></p>
                                <p class="cat"><?php echo $post['category']; ?></p>
                            </div>

                            <h2>
                            <!-- 本文は複数行入る可能性があるので、nl2br関数で改行をbrタグに変換しています。 -->
                                <span><?php echo convert_strings($post['title']); ?></span>
                            </h2>
                            
                            <!-- <div class="textContent">
                                <p><?php echo convert_strings($post['content']); ?></p>
                            </div> -->
                        </div>
                    </a>
                    <!-- <div class="good">
                        <span class="good-count">
                            
                            <i class="far fa-thumbs-up" id="<?php echo $post['good_no']; ?>" data-postno="<?php echo $post['no']; ?>"></i>
                            <span><?php echo empty($post['count']) ? 0: $post['count']; ?></span>
                        </span>
                    </div> -->
                    <!-- <div class="good mt-0">
                        <span class="good-count">
                            <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2Flocalhost%3A8888%2Fpost-article.php%3Fno%3D%3C%3Fphp%20echo%20%24article_no&width=83&layout=button_count&action=like&size=small&show_faces=false&share=false&height=21&appId" width="83" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </span>
                    </div> -->
                    <!-- <div class="good">
                        <span class="good-count">
                            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </span>
                    </div> -->
                </li>
            <?php } ?>
        </ul>
        <!-- <div id="pagination" class="col-xs-12">
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

                <?php 
                for($i = 1; $i <= $max_page; $i++){
                    echo '<li class="page-na">';
                    if ($i == $now) {
                        echo $now; 
                    } else {
                        echo '<a href=\'/my-blog.php?page='. $i. $category_name. '\')>'. $i. '</a>'. ' ';
                    }
                    echo '</li>';
                } 
                ?>

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
        </div> -->

<div id="pagination" class="col-xs-12">
    <ul class="pagination" role="menubar" aria-label="Pagination">
        <li>
        <?php
                // $max_page = $totalPages = 20; //トータルページ数
                //  $now = $page = 4; //現在のページ
                // var_dump($now);
                // var_dump($max_page);
                $page_width = 2; //現在のページから表示する幅

                // if($now > 1){ //現在のページが1の場合に<表示
                //     echo '<a href=\'/my-blog.php?page='.($now - 1). $category_name. '\')><i class="fas fa-angle-left"></i></a>';
                // }
        ?>

        <li>
            <?php
                //現在のページが1より大きい場合に<表示
                    if($now > 1){
                        if ($now == 2) {
                            echo '<a href=\'/my-blog.php?page='.($now - 1). $category_name. '\')><i class="fas fa-angle-left"></i></a>'." ";
                            echo '<a href=\'/my-blog.php?page=1'. $category_name. '\')>1</a>'." ";
                        } else {
                            echo '<a href=\'/my-blog.php?page='.($now - 1). $category_name. '\')><i class="fas fa-angle-left"></i></a>'." ";

                        }
                    } else {
                        echo '<i class="fas fa-angle-left"></i>';
                    }
            ?>
        </li>

        <li>
            <?php
                //ページ幅が1より大きい場合に1と...表示
                    if (($now-$page_width) > 2) {
                        // echo 1;
                        echo '<li class="">';
                            echo '<a href=\'/my-blog.php?page=1'. $category_name. '\')>1</a>';
                        echo '</li>';

                        echo '<li class="">';
                            echo "...";
                        echo '</li>';
                    } elseif(($now-$page_width) == 2) {
                        // echo 1;
                        echo '<a href=\'/my-blog.php?page=1'. $category_name. '\')>1</a>'." ";
                        // echo "...";
                    }
            ?>
        </li>

        <?php
            //中心ページより小さいページ番号を表示
                if ($now == $max_page-3) {
                    for($i = $page_width-1; $i>0; $i--) {
                        echo '<li class="">';
                            if(($now-$i) < 1) break; //1未満は表示させない
                            // echo ($now-$i)." ";
                            echo '<a href=\'/my-blog.php?page='. ($now-$i). $category_name. '\')>'.($now-$i). '</a>'." ";
                            // echo '<a href=\'/my-blog.php?page='. $now-$i. $category_name. '\')>'. $now-$i. '</a>'. ' ';
                        echo '</li>';
                    }

                } elseif ($now == $max_page-1) {
                    for($i = $page_width+1; $i>0; $i--) {
                        echo '<li class="">';
                            if(($now-$i) < 1) break; //1未満は表示させない
                            // echo ($now-$i)." ";
                            echo '<a href=\'/my-blog.php?page='. ($now-$i). $category_name. '\')>'.($now-$i). '</a>'." ";
                            // echo '<a href=\'/my-blog.php?page='. $now-$i. $category_name. '\')>'. $now-$i. '</a>'. ' ';
                        echo '</li>';
                    }
                } elseif ($now == $max_page) {
                    for($i = $page_width+2; $i>0; $i--) {
                        echo '<li class="">';
                            if(($now-$i) < 1) break; //1未満は表示させない
                            // echo ($now-$i)." ";
                            echo '<a href=\'/my-blog.php?page='. ($now-$i). $category_name. '\')>'.($now-$i). '</a>'." ";
                            // echo '<a href=\'/my-blog.php?page='. $now-$i. $category_name. '\')>'. $now-$i. '</a>'. ' ';
                        echo '</li>';
                    }
                } else {
                    for($i = $page_width; $i>0; $i--) {
                        echo '<li class="">';
                            if(($now-$i) < 1) break; //1未満は表示させない
                            // echo ($now-$i)." ";
                            echo '<a href=\'/my-blog.php?page='. ($now-$i). $category_name. '\')>'.($now-$i). '</a>'." ";
                            // echo '<a href=\'/my-blog.php?page='. $now-$i. $category_name. '\')>'. $now-$i. '</a>'. ' ';
                        echo '</li>';
                    }
                }
        ?>

        <li class="page-na">
            <?php
                //中心ページを表示
                        echo $now." ";
            ?>
        </li>

        <?php
            //中心ページより大きいページ番号を表示
                if($now == 1) {
                    for($i = 1; $i<=$page_width+2; $i++) {
                        echo '<li class="">';
                            if(($now+$i) > $max_page) break; //最終ページ以上は表示させない
                            // echo ($now+$i)." ";
                            echo '<a href=\'/my-blog.php?page='. ($now+$i). $category_name. '\')>'.($now+$i). '</a>'." ";
                            // echo '<a href=\'/my-blog.php?page='. $now+$i. $category_name. '\')>'. $now+$i. '</a>'. ' ';
                        echo '</li>';
                    }
                } elseif($now == 2) {
                    for($i = 1; $i<=$page_width+1; $i++) {
                        echo '<li class="">';
                            if(($now+$i) > $max_page) break; //最終ページ以上は表示させない
                            // echo ($now+$i)." ";
                            echo '<a href=\'/my-blog.php?page='. ($now+$i). $category_name. '\')>'.($now+$i). '</a>'." ";
                            // echo '<a href=\'/my-blog.php?page='. $now+$i. $category_name. '\')>'. $now+$i. '</a>'. ' ';
                        echo '</li>';
                    }

                } elseif($now == 4) {
                    for($i = 1; $i<=$page_width-1; $i++) {
                        echo '<li class="">';
                            if(($now+$i) > $max_page) break; //最終ページ以上は表示させない
                            // echo ($now+$i)." ";
                            echo '<a href=\'/my-blog.php?page='. ($now+$i). $category_name. '\')>'.($now+$i). '</a>'." ";
                            // echo '<a href=\'/my-blog.php?page='. $now+$i. $category_name. '\')>'. $now+$i. '</a>'. ' ';
                        echo '</li>';
                    }
                } else {
                    for($i = 1; $i<=$page_width; $i++) {
                        echo '<li class="">';
                            if(($now+$i) > $max_page) break; //最終ページ以上は表示させない
                            // echo ($now+$i)." ";
                            echo '<a href=\'/my-blog.php?page='. ($now+$i). $category_name. '\')>'.($now+$i). '</a>'." ";
                            // echo '<a href=\'/my-blog.php?page='. $now+$i. $category_name. '\')>'. $now+$i. '</a>'. ' ';
                        echo '</li>';
                    }
                }
        ?>
        
        <li>
            <?php
                //ページ幅が最終ページより小さい場合に最終ページ番号と...表示
                    if(($now+$page_width) == $max_page-1) {
                        // echo "...";
                        // echo $max_page;
                        echo '<a href=\'/my-blog.php?page='. $max_page. $category_name. '\')>'.$max_page. '</a>'. ' ';
                        // echo '<a href=\'/my-blog.php?page='. $max_page. $category_name. '\')>';
                    } elseif(($now+$page_width)<$max_page) {
                        echo '<li class="">...</li>';

                        // echo $max_page;
                        echo '<li class="">';
                            echo '<a href=\'/my-blog.php?page='. $max_page. $category_name. '\')>'.$max_page. '</a>'. ' ';
                        echo '</li>';
                        
                        // echo '<a href=\'/my-blog.php?page='. $max_page. $category_name. '\')>';
                    }
            ?>
        </li>

        <li>
            <?php
                // ページが最終ページより小さい場合に>表示
                    if($now < $max_page) {
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
        <aside id="sidebar" role="complementary" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
            <div class="col-xs-12 author bg-white">
                <img src="<?php echo 'file_upload/self_introduce/'. $selfImage['selfImage'];?>" class="img-responsive img-circle">
                <h4><?php echo $self_introduce['name'];?></h4>
                <hr>
                <p><?php echo $self_introduce['content'];?></p>
                <p class="author-fort">仕事のご依頼は<a href="https://www.takuyano-portfolio.com" class="my-fort">こちら</a>まで</p>
            </div>

            <div class="col-xs-12 most_search bg-white">
                <form action="my-blog.php" method="get" id="searchform">
                    <input type="search" name="search" value="<?php echo $search_value; ?>" placeholder="keyword">
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
                            <!-- <div class="imgCover"></div>
                            <img src="img/about.jpg" alt=""> -->
                            <?php 
                                $article_no = $news_post["no"];
                                $st_af = $pdo->query("SELECT * FROM articleImage_upload WHERE post_no=$article_no ORDER BY no DESC");
                                $articleImage = $st_af->fetch(PDO::FETCH_ASSOC);

                            ?>
                            <img src="<?php echo 'file_upload/articleImage/'. $articleImage['articleImage'];?>" class="article-img">
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
                            <!-- <div class="imgCover"></div>
                            <img src="img/about.jpg" alt=""> -->
                            <?php 
                                $article_no = $ranking["no"];
                                $st_af = $pdo->query("SELECT * FROM articleImage_upload WHERE post_no=$article_no ORDER BY no DESC");
                                $articleImage = $st_af->fetch(PDO::FETCH_ASSOC);

                            ?>
                            <img src="<?php echo 'file_upload/articleImage/'. $articleImage['articleImage'];?>" class="article-img">
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