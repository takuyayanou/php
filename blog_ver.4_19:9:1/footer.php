<?php
// 関連ファイルをロード
require_once "system/common.php";
// データの問い合わせ
$footerText = array(); // 配列の初期化
try {
    $st_ft = $pdo->query("SELECT * FROM footer_text ORDER BY no DESC limit 0, 1");
    $footerText = $st_ft->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // エラー発生時
    exit("クエリの実行に失敗しました");
}
?>

<!-- footer -->
<footer id="footer">
	<div class="inner">
		<p class="policy"><a href="">プライバシーポリシー</a></p>
        <p class="copyright">&copy; <?php echo he($footerText["ft_content"]); ?></p>
	</div>
</footer><!-- /footer -->


<script src="dist/js/swiper.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
        navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
        },
        slidesPerView: 3,
        spaceBetween: 40,
        initialSlide: 2,
        loop: true,
        autoplay: {
        delay: 3000,
        disableOnInteraction: true
        },
        pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        },
    });
    </script>
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

<script>
    $('.faq-list-item').click(function(){
        var $answer = $(this).find('.answer');
        if($answer.hasClass('open')){
            $answer.removeClass('open');
            $answer.slideUp(3500);
        
            $(this).find('.q-sign-1 img').attr('src', 'img/plus.png');
        } else {
            $answer.addClass('open');
            $answer.slideDown(1500);
            
            $(this).find('.q-sign-1 img').attr('src', 'img/minus.png');
        }
    });
</script>

<script>
    $('.faq-list-item-1').click(function(){
        var $answer = $(this).find('.answer');
        if($answer.hasClass('open')){
            $answer.removeClass('open');
            $answer.slideUp(3500);
        
            $(this).find('.q-sign-2 img').attr('src', 'img/plus.png');
        } else {
            $answer.addClass('open');
            $answer.slideDown(1500);
            
            $(this).find('.q-sign-2 img').attr('src', 'img/minus.png');
        }
    });
</script>

<script>
    $('.signup-show').click(function(){
        $('#signup-modal').fadeIn();
    });
    $('#close-modal').click(function(){
        $('#signup-modal').fadeOut();
    });
</script>


<script>
    // 確認ダイアログの返り値によりフォーム送信
$(function(){
    $('.pe-delete').on('click',function(e){
        e.stopPropagation(); //これをつけることにより、ここでいうと<a></a>とsubmitChkが同時処理で優先される<a></a>をストップしてくれる。
        confirm ( "送信してもよろしいですか？\n\n送信したくない場合は[キャンセル]ボタンを押して下さい");
    });
});
</script>

<script src="script.js"></script>
<script src="js/good.js"></script>
</div><!-- /.wrap -->
</main>
</body>
</html>
