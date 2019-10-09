<?php
    ini_set('opcache.enable', 0);

    // PDO接続処理は問題なし ------------------------------------------
        // require_once "system/config.php";
        require_once "system/common.php";

        // 作成したデータベースに接続(今回は「my_works」)
        // ここで$pdoとすることで、postやcommentなどを使いやすくしている。
        // $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 記事一覧を取得するSQL文 「ORDER BY no DESC」で記事番号の大きい順、すなわち新しい記事から順番に並び替えられる
        // queryはqueryメソッドなどと呼ばれます。指定したSQL文をデータベースに対して発行してくれる役割を持っています。ポイントはqueryで取得した値は配列で返ってくる点。


    // ================ ページング処理について ============================
        // もし$_GETの値が無い場合phpの警告になるので、その場合は無視する処理を入れる

        // 8件ずつ表示
        // 1ページの記事の表示数
        // define('MAX','8');
        // $_GET['page_id'] はURLに渡された現在のページ数
        
        if(preg_match('/^[1-9][0-9]*$/',$_GET['page'])) {
            // 設定されてない場合は1ページ目にする
            // 各ページのオフセット（ページの先頭のレコード位置）は、ページ番号が1から始まるとして
            $now = (int)$_GET['page'];
        } else {
            $now = 1;
        }

        // オフセットページ数 = ページ番号[$now] - 1
        // オフセットレコード数 = オフセットページ数 × １ページあたりの表示数
        // 配列の何番目から取得すればよいか
        // ↓    「category」や「search」がないときは、where文は表示されないし、「category」や「search」があれば、WHERE文が適用され、処理がされる。
        // LIKE:%が必要。
        if($_GET['category']) {
            $c_word = $_GET['category'];
            $category_name = "where post.category = '$c_word'";
        } elseif($_get['search']) {
            $word = $_GET['search'];
            $category_name = "where title LIKE '%$word%' or content LIKE '%$word%' order by no DESC";
        }

        $start_no = ($now - 1) * 4;

        // 全記事を取得
        $st_page = $pdo->query("
        SELECT 
        *
        FROM post 
        $category_name 
        ");

        $posts_pages = $st_page->fetchAll(PDO::FETCH_ASSOC);
        // トータルデータ件数
        $st_num = count($posts_pages);

        // トータルページ数※ceilは繰り上げ関数
        $max_page = ceil($st_num / 4);


    // ブログ記事の取得について ------------------------------------------

        // 基本的にはこれでOKです。postテーブルにgoodテーブルをリレーションしています  
        // select で、取得するフィールドを下記のように明示してあげるといいですね
        $st = $pdo->query("
            SELECT post.no, post.title, post.category, post.content, post.time, good.no as good_no, good.count
            FROM post 
            LEFT JOIN good 
            ON 
            post.no = good.post_no 
            $category_name 
            ORDER by 
            post.no DESC 
            limit $start_no, 4
        ");


        // fetchAll:全てのレコードを配列として返す
        // ↓ fetchAllに"PDO::FETCH_ASSOCの引数を渡すのがポイントでした
        // この引数があると、結果が入る配列の重複したデータがうまく整理されます
        $posts = $st->fetchAll(PDO::FETCH_ASSOC);

        // トータルデータ件数
        // $st_num = count($posts);

        //$st_num = 8
        // var_dump($st_num); 
        // トータルページ数※ceilは小数点を切り捨てる関数
        // $max_page = ceil($st_num / 8);
    



    // =============== コメント取得について ============================
        // count($posts):全記事数を返す
        // 記事に対するコメント一覧を取得するSQL文
        for ($i = 0; $i < count($posts); $i++) {
            $st = $pdo->query("SELECT * FROM comment WHERE post_no={$posts[$i]['no']} ORDER BY no DESC");
            $posts[$i]['comments'] = $st->fetchAll();
        }

    
    // ============== メイン画像 ============================
        $stmt = $pdo->query('SELECT * FROM mainImage_upload ORDER BY no DESC LIMIT 1');
        $mainImage = $stmt->fetch(PDO::FETCH_ASSOC);


    // ============== 自己紹介 ============================
        $st_self_introduce = $pdo->query("SELECT * FROM self_introduce ORDER BY no DESC limit 0, 1");
        $self_introduce = $st_self_introduce->fetch(PDO::FETCH_ASSOC);


    // ============== 自己紹介画像 ============================
        $stsi = $pdo->query('SELECT * FROM self_introduceImage_upload ORDER BY no DESC LIMIT 1');
        $selfImage = $stsi->fetch(PDO::FETCH_ASSOC);


    // ============== 最新記事 ============================
        // ↓ fetchAllに"PDO::FETCH_ASSOC
        $st_new_post = $pdo->query("SELECT * FROM post ORDER BY no DESC limit 0, 3");
        $news_posts = $st_new_post->fetchAll(PDO::FETCH_ASSOC);


    // ============== アクセスランキング ============================
        $st_ranking = $pdo->query("
            SELECT post.no, post.title, post.category, post.content, post.time, good.no as good_no, good.count
            FROM post 
            LEFT JOIN good 
            ON 
            post.no = good.post_no 
            ORDER by 
            good.count DESC 
            limit 0, 3");
        $rankings = $st_ranking->fetchAll(PDO::FETCH_ASSOC);


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


    // ============== カテゴリ ============================
        $st_category = $pdo->query("SELECT DISTINCT category FROM post");
        $categorys = $st_category->fetchAll(PDO::FETCH_ASSOC);


    // ============== アーカイブ ============================
        $st_archive = $pdo->query("SELECT DISTINCT time FROM post");
        $archives = $st_archive->fetchAll(PDO::FETCH_ASSOC);
        // $date = '2013-01-01 00:00:00';
        // var_dump($archives);
        // var_dump(date('Y年n月', strtotime($archives)));


    // ファイルを分けて書き、外部ファイルを読み込み、実行する
    require 't_my-blog.php';
?>
