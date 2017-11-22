</div>
<footer id="footer">
    <div class="wrapper">
        <nav class="categories foo-menu">
            <ul>
                <li><a href="/c/video">Video</a></li>
                <li><a href="/c/trong-nuoc">Trong nước</a></li>
                <li><a href="/c/the-gioi">Thế giới</a></li>
                <li><a href="/c/xa-hoi">Xã hội</a></li>
                <li><a href="/c/phap-luat">Pháp luật</a></li>
                <li><a href="/c/giao-duc">Giáo dục</a></li>
                <li><a href="/c/kinh-te">Kinh tế</a></li>
                <li><a href="/c/giai-tri">Giải trí</a></li>
                <li><a href="/c/the-thao">Thể thao</a></li>
                <li><a href="/c/cong-dong-mang">Cộng đồng mạng</a></li>
                <li><a href="/c/cuoc-song">Cuộc sống</a></li>
            </ul>
        </nav>
        <nav class="categories cate-news">
            <ul class="parent xa-hoi flex">
                <li class="jobs-25"><a href="/c/video"><i class="fa fa-caret-right" aria-hidden="true"></i> Video</a></li>
                <li class="jobs-25"><a href="/c/trong-nuoc"><i class="fa fa-caret-right" aria-hidden="true"></i> Trong nước</a></li>
                <li class="jobs-25"><a href="/c/the-gioi"><i class="fa fa-caret-right" aria-hidden="true"></i> Thế giới</a></li>
                <li class="jobs-25"><a href="/c/xa-hoi"><i class="fa fa-caret-right" aria-hidden="true"></i> Xã hội</a></li>
                <li class="jobs-25"><a href="/c/phap-luat"><i class="fa fa-caret-right" aria-hidden="true"></i> Pháp luật</a></li>
                <li class="jobs-25"><a href="/c/giao-duc"><i class="fa fa-caret-right" aria-hidden="true"></i> Giáo dục</a></li>
                <li class="jobs-25"><a href="/c/kinh-te"><i class="fa fa-caret-right" aria-hidden="true"></i> Kinh tế</a></li>
                <li class="jobs-25"><a href="/c/giai-tri"><i class="fa fa-caret-right" aria-hidden="true"></i> Giải trí</a></li>
                <li class="jobs-25"><a href="/c/the-thao"><i class="fa fa-caret-right" aria-hidden="true"></i> Thể thao</a></li>
                <li class="jobs-25"><a href="/c/cong-dong-mang"><i class="fa fa-caret-right" aria-hidden="true"></i> Cộng đồng mạng</a></li>
                <li class="jobs-25"><a href="/c/cuoc-song"><i class="fa fa-caret-right" aria-hidden="true"></i> Cuộc sống</a></li>
            </ul>
        </nav>
        <div class="copyright">
            <div class="logo"> <a href="/"> <img src="/images/logo-foo_2016.png?1" style="height: 75px; width: 168px; margin-right: 5px;"> </a> </div>
            <div class="info vcard">
                <span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;"><strong>Công Ty CP Truyền thông 24H Online</strong></span></span>
                <p><span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">®&nbsp;<strong>TRANG ĐANG CHẠY THỬ NGHIỆM</strong></span></span></p>
                <p><span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"></span></span><br  />
                    Liên hệ: <br  />
                    Email: </p>
            </div>
        </div>
    </div>
</footer>
<div id="fixed-banner-left" class="none_mobile">
    <div class="ct clearfix">
        {$data.listAds['float-left']}
    </div>
</div>
<div id="fixed-banner-right" class="none_mobile">
    <div class="ct clearfix">
        {$data.listAds['float-right']}
    </div>
</div>
{literal}
<script>
    var obj_left = $('#fixed-banner-left');
    var obj_right = $('#fixed-banner-right');
    
    var rate = screen.width/$(window).width();
    var x = Math.floor(((screen.width - (1014 * rate) - (2*rate*obj_left.width())) / 2)/ rate);
    obj_left.css({ left : x > -100 ? x : 0-obj_left.width() });
    obj_right.css({ right : x > -100 ? x : 0-obj_left.width() });
</script>
{/literal}
<a href="javascript:;" id="back_top" style="display: block;margin-bottom: 25px;">TOP</a>
{literal}
<script type="text/javascript">
    $(document).click(function(e){
        $('.block_scoll_menu').removeClass('active');
        $('.btn_menu_mobile').removeClass('active');
    });
    $(".block_scoll_menu").click(function() {
        var e=window.event||e;
        e.stopPropagation();
    });

    $("#back_top").hide();

    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back_top').fadeIn();
            } else {
                $('#back_top').fadeOut();
            }
        });

        $('#back_top').click(function () {
            $('body,html').animate({
                scrollTop: 0
                }, 800);
            return false;
        });
    });
</script>
<style type="text/css">#back_top {background: rgba(0,0,0,0.7);padding: 15px 0;    width: 40px;height: 40px;text-align: center;position: fixed;bottom: 10px;right: 10px;z-index: 9999;display: none;color: #fff}
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.cse_search').click(function(){
            var text_search = $('.txt_search').val();
            window.open("https://cse.google.com.vn/cse?cx=000480117788849223566:risxbx2lnzc&ie=UTF-8&q="+text_search+"&sa=Search&ref=#gsc.tab=0&gsc.q="+text_search+"&gsc.page=1"); 
        });
        $('.txt_search').keypress(function(e){
            if(e.keyCode==13) {
                $('.cse_search').click();
            }
        });
        $('.cse_search1').click(function(){
            var text_search = $('.txt_search1').val();
            window.open("https://cse.google.com.vn/cse?cx=000480117788849223566:risxbx2lnzc&ie=UTF-8&q="+text_search+"&sa=Search&ref=#gsc.tab=0&gsc.q="+text_search+"&gsc.page=1"); 
        });
        $('.txt_search1').keypress(function(e){
            if(e.keyCode==13) {
                $('.cse_search1').click();
            }
        });
    });
</script>
{/literal}
</body>
</html>