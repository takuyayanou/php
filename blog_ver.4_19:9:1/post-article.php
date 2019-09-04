
<?php
    require_once "system/config.php";

    // 作成したデータベースに接続(今回は「my_works」)
    // ここで$pdoとすることで、postやcommentなどを使いやすくしている。
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 記事一覧を取得するSQL文 「ORDER BY no DESC」で記事番号の大きい順、すなわち新しい記事から順番に並び替えられる
    // queryはqueryメソッドなどと呼ばれます。指定したSQL文をデータベースに対して発行してくれる役割を持っています。ポイントはqueryで取得した値は配列で返ってくる点。

    $article_no = intval($_GET['no']);
//$article_noには適切なnoが入っている。
// var_dump($article_no);
    // $st_article = $pdo->query("SELECT * FROM post WHERE $article_no");
    // $st_article = $pdo->query("SELECT * FROM post WHERE ". $article_no);
    $st_article = $pdo->query("
    SELECT post.no, post.title, post.category, post.content, post.time, good.no as good_no, good.count
    FROM post 
    LEFT JOIN good 
    ON 
    post.no = good.post_no 
    WHERE post.no=$article_no");
    
    // var_dump($st_article);
    // die("aaaaa");
    // $st_article_one = $st_article->execute(array(no,title,content));
    // $article_one = $st_article->fetchAll(PDO::FETCH_ASSOC);
    $article_one = $st_article->fetch();
    // die("aaaaa");

    // var_dump($article_one);


// =============== コメント取得について ============================
    // count($posts):全記事数を返す
    // 記事に対するコメント一覧を取得するSQL文

    // １：今表示しているブログのnoを取得　GETでとる
    // $article_no = intval($_GET['no']);

    // ２：SQL文でqueryで、post_no=１で取得したnoとなる
    $st = $pdo->query("SELECT * FROM comment WHERE post_no=$article_no ORDER BY no DESC");
    // ３、それをfetchAllする
    $comments = $st->fetchAll(PDO::FETCH_ASSOC);


    // for ($i = 0; $i < count($posts); $i++) {
    //     $st = $pdo->query("SELECT * FROM comment WHERE post_no={$posts[$i]['no']} ORDER BY no DESC");
    //     $posts[$i]['comments'] = $st->fetchAll();
    // }


    // トータルページ数※ceilは小数点を切り捨てる関数
    // $max_page = ceil($article_no / 8);
    

    // ============== ブログ名 ============================
    // データの問い合わせ
    $headerText = array(); // 配列の初期化
    try {
        $st_ht = $pdo->query("SELECT * FROM header_text ORDER BY no DESC limit 0, 1");
        $headerText = $st_ht->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // エラー発生時
        exit("クエリの実行に失敗しました");
    }



    require 't_post-article.php';
?>
