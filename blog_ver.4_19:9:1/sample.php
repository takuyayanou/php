<?php
$post_yt = array(1,2,3,4,5,6);
$database = array(
    1 => 5,
    3 => 1
);
?>
​
<html>
<body>
<main>
<p id="intro">
    ボタン有効時は黒、無効時はグレーになります。<br>
    一度押下するとグレーになり、それ以上カウントアップしないはず。<br>
    ブラウザをリロードしても、カウント値は戻るけど●の色は保持されるはず。
</p>
<button id="reset">リセット</button>
<?php
foreach($post_yt as $value){
?>
    <section>
        <h1>タイトル<?php echo $value; ?></h1>
        <p class="posts">記事<?php echo $value; ?></p>
​
        <div class="good">
            <span class="good-count">
                <i class="far fa-thumbs-up" id="<?php echo $value; ?>" data-postno="<?php echo $value; ?>">●</i>
                <span><?php echo empty($database[$value]) ? 0: $post_yt[$value]; ?></span>
            </span>
        </div>
    </section>
<?php
}
?>
​
</main>
<style>
.good i.disableGood {
    color: #CCC;
    cursor: default;
}
main{
    max-width: 750px;
    margin: 0 auto;
}
#intro {
    background: #fee;
    padding: 1em;
}
button {
    margin-bottom: 1em;
}
section {
    border: solid 1px #888;
    margin-bottom: 1em;
    border-radius: 3px;
}
h1 {
    background: #CCC;
    margin: 0;
    padding: 0.5em;
    font-size: 1rem;
}
.posts {
    padding: 1em;
}
.good {
    font-size: 2rem;
    padding-left: 2em;
}
.good i {
    cursor: pointer;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
​
​
​
​
<script>
//------------- ↓ good.js-------------------------------------------------------------------
$(function(){

    let goodArray = goodStorage();//関数を用意し、そこでlocalStorageの値を取得する
    goodEnable(goodArray);//ページ表示時に、LocalStrageの値に応じて有効/無効化

    $('.fa-thumbs-up').on('click', function(e){

        let $this = $(this);
        goodNo = $this.attr('id'); //goodテーブルのidを取得
        postNo = $this.attr('data-postno'); //post_noを取得
        goodCount = Number($this.next().text()); //押す前のcount値

        if($.inArray(goodNo, goodArray) == -1){//localStorageに該当の記事に対する押下した情報が入っていなかったら、カウントアップの処理する
            $.ajax({
                type: 'POST',
                url: 'ajaxGood.php', //post送信を受けとるphpファイル
                data: { good_no: goodNo,post_no: postNo, good_count: goodCount} //{キー:投稿ID}
            }).done(function(data){
                console.log('Ajax Success');

                $this.next().text(goodCount+1);
                $this.addClass('disableGood');//押下済なので、無効化用のclass名を付与

                goodArray.push(goodNo);//今回押下したidを配列に追加する
                goodPush = goodArray.join(',');//↑の配列を,区切りの文字列に変換
                localStorage.setItem('goodNo', goodPush);//↑の文字列をLocalStrageへ格納

            }).fail(function(msg) {
                console.log('Ajax Error');
            });
        }

    });

    //デバッグ用にリセットボタンを設置したので、ここは本番運用では丸ごとカット==========
    $('#reset').on('click', function(){
        localStorage.removeItem('goodNo');
        $('.goodMark').each(function(){
            $(this).removeClass('disableGood');
        });
    })
    //============================================================================
});

//イイねボタンの有効/無効化処理
function goodEnable(goodArray){
    $('.fa-thumbs-up').each(function(){//fa-thumbs-up要素を全検索してループ
        let goodNo = $(this).attr('id');//それのidを取得
        if($.inArray(goodNo, goodArray) != -1){//そのidがLocalStrageに含まれていたら
            $(this).addClass('disableGood');//無効化用のクラスを付与
        }
    });
}

//LocalStrage読み込み処理
function goodStorage(){
    let goodArray = [];//LocalStrageの値を保持する用の配列を定義
    let goodStorage = localStorage.getItem('goodNo');//LocalStrageを読み込み

    if(goodStorage != null){//LocalStrageがNullじゃなかったら
        goodArray = goodStorage.split(',');//↑で読み込んだ文字列を,区切りで配列に変換
    }
    
    return goodArray;//変数を返します
}
//------------- ↓ good.js-------------------------------------------------------------------
</script>
</body>
</html>