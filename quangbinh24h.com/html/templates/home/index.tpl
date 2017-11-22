{include file='block/head.tpl'}
<div class="wrapper" id="container">
    {include file='block/header.tpl'}
    <section class="focus_layout" id="homepage">
        <div class="content-wrap">
            <section class="featured">
                {foreach from=$data.list_lastest item=val name=foo}
                {if $smarty.foreach.foo.index == 0}
                <article class="featured">
                    <div style="background-image: url({$val.images});" class="cover">
                        <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"></a>
                    </div>
                    <header>
                        <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{if $val.id eq 88229}<img src="http://media.nghean24h.vn/2017/7/15/1/livestream-1500092844.jpg" style="height: 14px;margin-right: 5px;">{/if}{$val.title}</a></h1>
                        <p class="summary">{$val.intro_text}</p>
                    </header>
                </article>
                {/if}
                {/foreach}
            </section>
            <section class="trending scroll mCustomScrollbar _mCS_1">
                 <div class="none_mobile" style="text-align: center; clear:both; margin-bottom: 10px;">
            <img src="http://media.danang24h.vn/2017/8/24/1/lienhe-1503542075.jpg" tyle="height: 57; width: 174" />
                </div>
                <div class="mCustomScrollBox mCS-dark" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                    <div class="mCSB_container" style="position:relative; top:0;">
                        {foreach from=$data.list_lastest item=val name=foo}
                        {if $smarty.foreach.foo.index > 0 && $smarty.foreach.foo.index < 7}
                        <article>
                            <div class="cover">
                                <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"><img src="{$val.images}"></a>
                            </div>
                            <header>
                                <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></h1>
                            </header>
                        </article>
                        {/if}
                        {/foreach}
                    </div>
                </div>
            </section>
            <div style="clear:both;"></div>
            <div class="slide_video">
                <ul class="list_slide_hot">
                    {foreach from=$data.list_lastest item=val name=foo}
                    {if $smarty.foreach.foo.index > 9}
                    <li>
                        <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" class="thumbb_slide"><img src="{$template_helper->get_thumb_image($val.images,160,110)}"/> </a>
                        <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" class="title_slide">{$val.title}</a>
                    </li>
                    {/if}
                    {/foreach}
                </ul>
                {literal}
                <style>
                    .thumbb_slide{display:block;margin-bottom:5px}
                    .slide_video{margin-bottom:15px}
                    .title_slide{line-height:16px}
                </style>
                <script>
                    $(document).ready(function(){
                        $('.list_slide_hot').bxSlider({
                            minSlides: 2,
                            maxSlides: 4,
                            moveSlides: 1,
                            slideWidth: 157,
                            slideMargin: 10,
                            auto:false,
                            autoHover:true,
                            controls:true,
                            pager:false,
                        });
                    })
                </script>
                {/literal}
            </div>
            <section class="video tin-anh skin_mobile">
                <header>
                    <h1><a>BÀI ĐỌC NHIỀU</a></h1>
                </header>
                {foreach from=$data.list_docnhieu item=val name=foo}
                <article class="{if $smarty.foreach.foo.index == 0}featured {/if}video tin-anh">
                    <div class="cover" style="background-image: url({$val.images})">
                        <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"></a>
                    </div>
                    <header>
                        <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></h1>
                    </header>
                </article>
                {/foreach}
            </section>
        </div>
        
        <section class="sidebar">
            {$data.listAds['top-hot']}
            {$data.listAds['top']}
        </section>
        
        <div class="none_mobile" style="text-align: center; clear:both; margin-bottom: 10px;">
            {$data.listAds['middle']}
        </div>
        <div class="block_mobile" style="text-align: center; clear:both; margin-bottom: 10px;">
            {$data.listAds['mobile-middle']}
        </div>
        
        <div class="content-wrap">
            <div class="content-wrap">
                {foreach from=$data.list_news_cat item=v name=foo}
                <section class="category skin1">
                    <header>
                        <hgroup>
                            <h1><a href="{$link_helper->link_to_category($v.meta_slug,0)}" title="{$v.title}">{$v.title}</a></h1>
                        </hgroup>
                    </header>
                    {if $v.id == 1}
                    {foreach from=$v.news_hot_cat item=val name=foo}
                    <article class="featured">
                        <div class="cover" style="background-image: url({$val.images})">
                            <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"></a>
                        </div>
                        <header class="home-title">
                            <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></h1>
                        </header>
                        <p class="summary">{$val.intro_text|mb_truncate:170:"...":"utf-8"}</p>
                        <p class="summary_more"><i class="fa fa-clock-o" aria-hidden="true"></i> {$val.create_date_int|date_format:"%H:%M %d-%m-%Y"} <b class="title-view"><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}">Xem thêm &gt;&gt;</a></b></p>
                    </article>
                    {/foreach}
                    <div class="top text_center none_mobile">
                        {$data.listAds['home-content']}
                    </div>
                    <div style="clear:both"></div>
                    <div class="slide_video">
                        <ul class="list_slide_video">
                            {foreach from=$v.list_news item=val name=foo}
                            <li>
                                <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" class="thumbb_slide"><img src="{$template_helper->get_thumb_image($val.images,125,84)}"/> </a>
                                <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" class="title_slide">{$val.title}</a>
                            </li>
                            {/foreach}
                        </ul>
                        {literal}
                        <style>
                            .thumbb_slide{display:block;margin-bottom:5px}
                            .slide_video{margin-bottom:15px}
                            .title_slide{line-height:16px}
                        </style>
                        <script>
                            $(document).ready(function(){
                            $('.list_slide_video').bxSlider({
                            minSlides: 2,
                            maxSlides: 5,
                            moveSlides: 1,
                            slideWidth: 125,
                            slideMargin: 10,
                            auto:false,
                            autoHover:true,
                            controls:true,
                            pager:false,
                            });
                            })
                        </script>
                        {/literal}
                    </div>
                    {else}
                    {foreach from=$v.news_hot_cat item=val name=foo}
                    <article class="featured">
                        <div class="cover" style="background-image: url({$val.images})">
                            <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"></a>
                        </div>
                        <header class="home-title">
                            <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></h1>
                        </header>
                        <p class="summary">{$val.intro_text|mb_truncate:170:"...":"utf-8"}</p>
                        <p class="summary_more"><i class="fa fa-clock-o" aria-hidden="true"></i> {$val.create_date_int|date_format:"%H:%M %d-%m-%Y"} <b class="title-view"><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}">Xem thêm &gt;&gt;</a></b></p>
                    </article>
                    {/foreach}
                    <div class="top">
                        {foreach from=$v.list_news item=val name=foo}
                        <article class="new_lq">
                            <div class="cover im-new_lq" style="background-image: url({$val.images})">
                                <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"></a>
                            </div>
                            <header>
                                <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></h1>
                                <p class="home-more"><i class="fa fa-clock-o" aria-hidden="true"></i> {$val.create_date_int|date_format:"%H:%M %d-%m-%Y"} </p>
                            </header>
                        </article>
                        {/foreach}
                    </div>
                    {/if}
                </section>
                {/foreach}
            </div>
        </div>
        <section class="sidebar">
            {$data.listAds['top-sidebar']}
            <section class="video tin-anh">
                <header>
                    <h1><a>BÀI ĐỌC NHIỀU</a></h1>
                </header>
                {foreach from=$data.list_docnhieu item=val name=foo}
                <article class="{if $smarty.foreach.foo.index == 0}featured {/if}video tin-anh">
                    <div class="cover" style="background-image: url({$val.images})">
                        <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"></a>
                    </div>
                    <header>
                        <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></h1>
                    </header>
                </article>
                {/foreach}
            </section>
                
            <section class="order-list">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- antt-300x250 -->
                <ins class="adsbygoogle"
                style="display:inline-block;width:300px;height:250px"
                data-ad-client="ca-pub-3441108131270465"
                data-ad-slot="4117362434"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <header>
                    <h1><a title="CÓ THỂ BẠN QUAN TÂM">CÓ THỂ BẠN QUAN TÂM</a></h1>
                </header>
                {foreach from=$data.list_quantam item=val name=foo}
                <article>
                    <div class="cover">
                        <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"><img src="{$val.images}"></a>
                    </div>
                    <header>
                        <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></h1>
                        <time datetime="{$val.create_date_int|date_format:"%H:%M %d-%m-%Y"}"> {$val.create_date_int|date_format:"%H:%M %d-%m-%Y"}</time>
                    </header>
                </article>
                {/foreach}
            </section>
            <div id="fb-root"></div>
            {$data.listAds['sidebar-1']}
            {$data.listAds['sidebar-2']}
        </section>
    </section>
</div>
{include file='block/footer.tpl'}
