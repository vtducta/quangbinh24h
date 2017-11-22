{include file='block/head.tpl'}
<div class="wrapper" id="container">
    {include file='block/header.tpl'}
    <section class="focus_layout" id="homepage">
    <div class="content-wrap">
        <section class="article_content pictures_layout tt-detail" id="content"> 
            <header>
                <p itemprop="articleSection" class="cate"><a href="{$link_helper->link_to_category($data.cat_sub->get('meta_slug'),0)}">{$data.cat_sub->get('title')}</a></p>
                <time datetime="{$data.content->get('create_date_int')|date_format:"%H:%M %d-%m-%Y"}"> {$data.content->get('create_date_int')|date_format:"%H:%M %d-%m-%Y"}</time>
                <h1 itemprop="name">{$data.content->get('title')|stripslashes}</h1>
                <center class="none_mobile">
                    {$data.listAds['detail-top-content']}
                </center>
                <center class="block_mobile">
                    {$data.listAds['mobile-under-title-content']}
                </center>
                <div class="summary">
                    <p itemprop="description">{$data.content->get('intro_text')}</p>
                </div>
                <div style="text-align:center"> </div>
            </header>
            
            {if $data.news_relationship}
            <div style="clear:both"></div>
            <div class="list_news_relation_top pkg">
                <span class="head_relation">
                    TIN LIÊN QUAN
                </span>
                <ul>
                    {foreach from=$data.news_relationship item=val name=foo}
                    <li>
                        <a title="{$val->get('title')}" href="{$link_helper->link_to_news($val->get('meta_slug'),$val->get('id'))}">{$val->get('title')}</a>
                    </li>
                    {/foreach}
                </ul>
            </div>
            {/if}
            
            
            <article>
                <div itemprop="articleBody" class="content" id="news-bodyhtml">
                    {$data.content->get('content_text')}
                    {if $data.art_source}
                    <p style="text-align: right;"><span><strong>Tác giả:</strong> {$data.journalist}</span></p>
                    {/if}
                    {if $data.art_source}
                    <p style="text-align: right;"><span><strong>Nguồn tin:</strong> {$data.art_source->get("name")}</span></p>
                    {/if}
                </div>
                {$data.html_edit}
                <center class="block_mobile">
                    {$data.listAds['mobile-below-content']}
                </center>
                {if $data.list_tag}
                <div class="width_common space_bottom_10">
                    <div class="panel-body">
                        <div class="h5">
                            <em class="fa fa-tags">&nbsp;</em>
                            <strong>Từ khóa: </strong>
                            {foreach from=$data.list_tag item=val name=foo}
                            {$tag_name=$val->get("tag_name")}
                            {$tag_name = preg_replace('/(\s+)/i', " ", $tag_name)}
                            {$tag_name=trim($tag_name)}
                            {$tag_name=str_replace(" ", "-", $tag_name)}
                            {if $val->get('tag_name')}
                            {if $smarty.foreach.foo.index == 0}
                            <a title="{$val->get('tag_name')}" href="{$link_helper->link_to_tagv2($tag_name)}"><em>{$val->get('tag_name')}</em></a>
                            {else}
                            , <a title="{$val->get('tag_name')}" href="{$link_helper->link_to_tagv2($tag_name)}"><em>{$val->get('tag_name')}</em></a>
                            {/if}
                            {/if}
                            {/foreach}
                        </div>
                    </div>
                </div>
                {/if}
            </article>
            <div class="width_common space_bottom_10">
                <div class="socialicon clearfix margin-bottom-lg">
                    <div style="float:left"><div class="fb-like" data-href="{$link_helper->link_to_news($data.content->get("meta_slug"),$data.content->get("id"))}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true">&nbsp;</div></div>
                    <div style="float:left"><div class="g-plusone" data-size="medium"></div></div>
                    {literal}<div style="float:left"><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>{/literal}
                </div>
            </div>
            <div id="fb-root"></div>
        </section>
        <section class="cate_sidebar none_mobile">
            {$data.listAds['detail-middle-vertical-content-1']}
            {$data.listAds['detail-middle-vertical-content-2']}
        </section>
        <section class="recommendation" id="recommendation">
            <header>
                <h2><strong>BÀI MỚI ĐĂNG</strong></h2>
            </header>
          <div class="section-content">
                <div class="article-list block-layout">
                    {foreach from=$data.list_news item=val name=foo}
                    <article class="article-item type-text">
                        <p class="article-thumbnail"> <a title="{$val.title}" href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"><img alt="{$val.title}" src="{$template_helper->get_thumb_image($val.images,162,110)}"></a> </p>
                        <header>
                            <p class="article-title"><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></p>
                        </header>
                    </article>
                    {if $smarty.foreach.foo.index == 3}
                    <div style="clear:both"></div>
                    {/if}
                    {if $val.id eq 84663}
                      {literal}
                             <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103261947-1', 'auto');
  ga('send', 'pageview');

</script>
                      {/literal}
                    {/if}
                    {/foreach}
                    <div style="clear:both;"></div>
                </div>
            </div>
        </section>
    </div>
    <section class="sidebar">
        {$data.listAds['detail-top-sidebar']}
        <section class="video tin-anh">
            <header>
                <h1><a>BÀI ĐỌC NHIỀU</a></h1>
            </header>
            {foreach from=$data.list_docnhieu item=val name=foo}
            <article class="{if $smarty.foreach.foo.index == 0}featured {/if}video tin-anh">
                <div class="cover" style="background-image: url({if $smarty.foreach.foo.index == 0}{$template_helper->get_thumb_image($val.images,310,180)}{else}{$template_helper->get_thumb_image($val.images,150,90)}{/if})">
                    <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"></a>
                </div>
                <header>
                    <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></h1>
                </header>
            </article>
            {/foreach}
        </section>
        {$data.listAds['detail-sidebar-1']}
        {$data.listAds['detail-sidebar-2']}
    </section>
    </section>
</div>
{literal}
<script type="text/javascript">
    !function (n) { function e(n, e) { var i = document.createElement("script"); i.type = "text/javascript", i.readyState ? i.onreadystatechange = function () { ("loaded" == i.readyState || "complete" == i.readyState) && (i.onreadystatechange = null, e()) } : i.onload = function () { e() }, i.src = n, document.getElementsByTagName("head")[0].appendChild(i) } var i = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.1/jquery.min.js"; "undefined" == typeof $ ? e(i, function () { n() }) : n() }(function () { $(document).ready(function () { init_ads_netlink_ads() }) }), init_ads_netlink_ads = function () { ads_util_netlink_ads.create_html(ads_util_netlink_ads.selector()), ads_util_netlink_ads.set_fullscreen_banner(), $(window).resize(function () { $(window).width() > $(window).height() ? ads_util_netlink_ads.set_fullscreen_banner() : ads_util_netlink_ads.set_fullscreen_banner() }), $(window).scroll(function () { el_offset = $("#ad_inpage_container_netlink_ads").offset(), wd_top = $(window).scrollTop(), el_height = $("#ad_inpage_container_netlink_ads").height(), el_offset.top - el_height < wd_top && wd_top < el_offset.top + el_height ? ($("#ad_inpage_container_netlink_ads").css("opacity", 1), $("#ad_inpage_banner_netlink_ads").css("opacity", 1), $("#ad_inpage_banner_netlink_ads").css("display", "block")) : ($("#ad_inpage_container_netlink_ads").css("opacity", 0), $("#ad_inpage_banner_netlink_ads").css("opacity", 0), $("#ad_inpage_banner_netlink_ads").css("display", "none")) }) }, ads_util_netlink_ads = { create_html: function (n) { return _ads_code_man_hinh_ngang = document.getElementById("netlink_ads_code").innerHTML, _ads_code_man_hinh_doc = document.getElementById("netlink_ads_code").innerHTML, $(window).width() > $(window).height() ? html = '<div id="ad_inpage_container_netlink_ads" style="width: 100%; max-width: 100%; overflow: hidden; text-align: center; position: relative; visibility: visible; display: block; opacity:0; z-index: 2; height: 627px; background: transparent;"><div id="ad_inpage_banner_netlink_ads" style="opacity: 1; display: none; position: fixed; top: 0px; margin: 0px auto; z-index: 1;">' + _ads_code_man_hinh_ngang : html = '<div id="ad_inpage_container_netlink_ads" style="width: 100%; max-width: 100%; overflow: hidden; text-align: center; position: relative; visibility: visible; display: block; opacity:0; z-index: 2; height: 627px; background: transparent;"><div id="ad_inpage_banner_netlink_ads" style="opacity: 0; display: none; position: fixed; top: 0px; margin: 0px auto; z-index: 1;">' + _ads_code_man_hinh_doc, n ? void n.html(html) : (console.log("selector error"), !1) }, scroll: function () { }, _tracking_impression: function () { }, set_fullscreen_banner: function () { parent = $("#palace_holder").parent(), $("#ad_inpage_container_netlink_ads").css({ width: parent.width(), height: $(window).height() }), $("#ad_inpage_banner_netlink_ads").css({ width: parent.width(), height: $(window).height() }) }, selector: function () { return $(".content").after("<p id='palace_holder'></p>"), p = $("#palace_holder"), p.length > 0 ? p : !1 } };
</script>
 <script>
    var d = new Date();
    var n = d.getTime(); 
    var link_tracking =  "http://quangbinh24h.com/tracking-{/literal}{$data.content->get("id")}{literal}.gif?check="+n;
    document.write("<img src='"+link_tracking+"'  style='display: none;'>");                    
</script>
{/literal}
{include file='block/footer.tpl'}
