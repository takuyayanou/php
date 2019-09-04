<?php
    require_once "system/config.php";

    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);

    // ============== メイン画像 ============================
    $stmt = $pdo->query('SELECT * FROM mainImage_upload ORDER BY no DESC LIMIT 1');
    $mainImage = $stmt->fetch(PDO::FETCH_ASSOC);

    // ============== ブログ名 ============================
    // データの問い合わせ:
    $headerText = array(); // 配列の初期化
    try {
        $st_ht = $pdo->query("SELECT * FROM header_text ORDER BY no DESC limit 0, 1");
        $headerText = $st_ht->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // エラー発生時
        exit("クエリの実行に失敗しました");
    }
?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="ページの内容を表す文章">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/swiper.css">
    <link rel="stylesheet" href="dist/css/swiper.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    
    <!-- drawer.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
    
    <!-- jquery & iScroll -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
    <link rel="stylesheet" href="css/myworks-contact_style.css">
    
    <!-- スムーズなページ内を移動をサポートしてくれる「smooth-scroll.js」 -->
    <script src="js/smooth-scroll.polyfills.min.js"></script>

    <title></title>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="dist/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
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

    <!-- mv -->
    <section id="mv">
        <div class="inner">
            <img src="<?php echo 'file_upload/mainImage/'. $mainImage['mainImage'];?>" class="box">
        </div><!-- /inner -->
    </section><!-- /mv -->

    <!-- contact -->
    <section id="contact">
        <div class="contact-form">

            <!-- contact-content -->
            <form class="contact-content">

                <!-- contact-dl -->
                <dl class="contact-dl">
                    <dt class="contact-label">お問い合わせ種別</dt>
                    <dd class="contact-input">
                        <select id="contact-select">
                            <option>選択してください</option>
                            <option>セレクトA</option>
                            <option>セレクトB</option>
                            <option>セレクトC</option>
                        </select>
                    </dd>

                    <dt class="contact-label">氏名<span class="contact-required con-re-1">必須</span></dt>
                    <dd class="contact-input mb-39"><input type="text" value="" name="your-name" placeholder="氏名"></dd>

                    <dt class="contact-label">フリガナ<span class="contact-required con-re-2">必須</span></dt>
                    <dd class="contact-input mb-38"><input type="text" value="" name="your-name" placeholder="フリガナ"></dd>
    
                    <dt class="contact-label">メールアドレス</dt>
                    <dd class="contact-input con-mail mb-39-2"><input type="text" value="" name="your-mail" placeholder="sample@gmail.com"></dd>
                </dl><!-- /contact-dl -->

                <div class="contact-radio">
                    <p class="contact-label pb-6">性別</p>
                    <label class="man"><input type="radio" name="your-radio" checked><span>男性</span></label>
                    <label class="woman"><input type="radio" name="your-radio"><span>女性</span></label>
                </div>
                    
                <dl class="contact-dl">
                    <dt class="contact-label">メッセージ</dt>
                    <dd class="contact-input con-input-1 mb--3"><textarea name="your-message"></textarea></dd>
                </dl>
    
                <div class="contact-agreement">
                    <label><input type="checkbox" name="your-checkbox"><span><a class="signup-show">個人情報保護方針</a>に同意する</span></label>
                </div>
    
                <!-- signup-modal-wrapper -->
                <!-- <div class="signup-modal-wrapper" id="signup-modal">
                    <div class="signup-modal">

                                                <div id="close-modal">
                            <img src="img/btn-batsu.png" alt="">
                        </div>

                                                <div id="signup-form">
                            <h2 class="section-title">プライバシーポリシー</h2>
                            <div class="signup-info">
                                <h3>ほにゃらら</h3>
                                <p>ほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃらら。</p>
                            </div>
                            <div class="signup-info">
                                <h3>ほにゃらら</h3>
                                <p>ほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃららほにゃらら。</p>
                                <div id="close-send">
                                    <input type="submit" value="閉じる">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div> -->
                
    
                <div class="contact-send">
                    <input type="submit" value="工事中・・・">
                </div><!-- /contact-send -->
                
            </form><!-- /contact-content -->
            
        </div><!-- /contact-form -->
    </section><!-- /contact -->

    <!-- contactArea -->
    <!-- <section id="contactArea">
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
    </!-->
    <!-- /contact -->

    <?php require "footer.php";?>