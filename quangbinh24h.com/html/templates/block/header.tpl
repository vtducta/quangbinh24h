<div class="box_head_mobile">
    <div class="head_mobile">
        <a href="javascript:;" class="btn_menu_mobile"> </a>
        <a href="/" class="logo_mobile"><img src="/images/logo91x40.png?1"/>   </a>
    </div>
    <div class="block_scoll_menu">
        <div class="block_search">
            <form>
                <input type="hidden" name="language" value="vi">
                <input type="hidden" name="nv" value="seek">
                <input type="text" class="input_search txt_search" maxlength="60" value="" placeholder="Tìm kiếm" name="q">
                <input value="" class="icon_menu_phone btn_search cse_search" type="submit">
            </form>
            <div style="clear:both"></div>
        </div>
        
        <ul class="list_item_panel">
            <li class="item active"><a href="/"><span class="icon_menu_phone ico_menu_home">&nbsp;</span>Trang chủ</a> </li>
            {foreach from=$data.list_cat_menu item=val key=k name=foo}
            <li class="item {if $data.list_cat_menu eq $val.id} active{/if}"><a href="{$link_helper->link_to_category($val.meta_slug,0)}"><span class="icon_menu_phone ico_menu_{$val.id}">&nbsp;</span>{$val.title}</a> </li>
            {/foreach}
        </ul>
    </div>
</div>
<center class="block_mobile">
    {$data.listAds['mobile-top-header']}
</center>
<div class="wrapper" id="container">
    <header id="top">
        <div id="site-header">
            <div id="logo"> <a href="/"><img src="http://quangbinh24h.com/images/logo.png" alt="Quang Binh 24h"></a> </div>
            <div class="banner" id="banner_top">
                {$data.listAds['top-header']}
            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="ads-desktop-3col">
            <div class="col">
                {$data.listAds['header-1']}
            </div>
            <div class="col">
                {$data.listAds['header-2']}
            </div>
            <div class="col last">{$data.listAds['header-3']}</div>
            <div class="clear"></div>
        </div>
        <div class="MenuCate clearfix">
            <ul class="menu-top ">
                <li class="item active"><a href="/" class="icon-home" title="Trang chủ"> Trang chủ </a></li>
                {foreach from=$data.list_cat_menu item=val key=k name=foo}
                <li class="item {if $data.current_category eq $val.id} active{/if}"><a href="{$link_helper->link_to_category($val.meta_slug,0)}" class="label ico_menu_17">{$val.title}</a> </li>
                {/foreach}
            </ul>
        </div>
        <div class="MenuSub none_mobile">
            <div class="clearfix">
                <div class="TimeUpdate left"> Thời gian: <span id="clock"></span></div>
                <div class="box_search right" style="float: right;">
                  <input type="text" class="txt_search1" placeholder="Nhập từ khóa" style="border: 1px solid #ddd;padding: 0 6px;height: 19px;font-size: 11px;">
                  <input type="button" class="btn_search cse_search1" value="Tìm kiếm" style="border: none;background: #8e8b80;font-weight: bold;text-transform: uppercase;font-size: 10px;border-radius: 0;height: 19px;padding: 0px 8px;line-height: 20px;color: #fff;">
                </div>
                <div class="HotLine right"> <span style="color:rgb(255, 0, 0);">Hotline</span>: 0911.956.986 </div>
            </div>
        </div>
    </header>
<script>
    $(document).ready(function(){       
    $(".btn_menu_mobile").click(function() {
    var e=window.event||e;
    $('.btn_menu_mobile').toggleClass('active');
    $('.block_scoll_menu').toggleClass('active');

    e.stopPropagation();
    });

    });
    
    var dayNames = [
        "Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư",
        "Thứ Năm", "Thứ Sáu", "Thứ Bảy"
    ];
    function myTimer() {
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var day = date.getDate();
        var hour = date.getHours();
        var hourFormatted = hour % 12 || 12;
        if (hourFormatted < 10) hourFormatted = "0" + hourFormatted;
        var minute = date.getMinutes();
        var minuteFormatted = minute < 10 ? "0" + minute : minute;
        var morning = hour < 12 ? "AM" : "PM";
        var dow = date.getDay();
        dow = dayNames[dow];
        var datetime = dow + " " + day + "/" + month + "/" + year + " " + hourFormatted + ":" + minuteFormatted + " " + morning;
        document.getElementById("clock").innerHTML = datetime;
        setTimeout(function(){ myTimer() }, 1000);
    }
    myTimer();
</script>    
