<?php /* Smarty version Smarty-3.1.12, created on 2017-10-06 14:47:05
         compiled from "/home/app/quangbinh24h-apps/quangbinh24h.com/html/templates/view/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169075104959b796b5bc1ec7-97026966%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8177409bd5c2a2f6197d1c99d65eb206318e621d' => 
    array (
      0 => '/home/app/quangbinh24h-apps/quangbinh24h.com/html/templates/view/index.tpl',
      1 => 1507275996,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169075104959b796b5bc1ec7-97026966',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b796b5dac3d9_49850170',
  'variables' => 
  array (
    'data' => 0,
    'link_helper' => 0,
    'val' => 0,
    'tag_name' => 0,
    'template_helper' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b796b5dac3d9_49850170')) {function content_59b796b5dac3d9_49850170($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/app/kcms/libraries/smarty/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="wrapper" id="container">
    <?php echo $_smarty_tpl->getSubTemplate ('block/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <section class="focus_layout" id="homepage">
    <div class="content-wrap">
        <section class="article_content pictures_layout tt-detail" id="content"> 
            <header>
                <p itemprop="articleSection" class="cate"><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['cat_sub']->get('meta_slug'),0);?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['cat_sub']->get('title');?>
</a></p>
                <time datetime="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['content']->get('create_date_int'),"%H:%M %d-%m-%Y");?>
"> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['content']->get('create_date_int'),"%H:%M %d-%m-%Y");?>
</time>
                <h1 itemprop="name"><?php echo stripslashes($_smarty_tpl->tpl_vars['data']->value['content']->get('title'));?>
</h1>
                <center class="none_mobile">
                    <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['detail-top-content'];?>

                </center>
                <center class="block_mobile">
                    <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['mobile-under-title-content'];?>

                </center>
                <div class="summary">
                    <p itemprop="description"><?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('intro_text');?>
</p>
                </div>
                <div style="text-align:center"> </div>
            </header>
            
            <?php if ($_smarty_tpl->tpl_vars['data']->value['news_relationship']){?>
            <div style="clear:both"></div>
            <div class="list_news_relation_top pkg">
                <span class="head_relation">
                    TIN LIÊN QUAN
                </span>
                <ul>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['news_relationship']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                    <li>
                        <a title="<?php echo $_smarty_tpl->tpl_vars['val']->value->get('title');?>
" href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value->get('meta_slug'),$_smarty_tpl->tpl_vars['val']->value->get('id'));?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value->get('title');?>
</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php }?>
            
            
            <article>
                <div itemprop="articleBody" class="content" id="news-bodyhtml">
                    <?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('content_text');?>

                    <?php if ($_smarty_tpl->tpl_vars['data']->value['art_source']){?>
                    <p style="text-align: right;"><span><strong>Tác giả:</strong> <?php echo $_smarty_tpl->tpl_vars['data']->value['journalist'];?>
</span></p>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['data']->value['art_source']){?>
                    <p style="text-align: right;"><span><strong>Nguồn tin:</strong> <?php echo $_smarty_tpl->tpl_vars['data']->value['art_source']->get("name");?>
</span></p>
                    <?php }?>
                </div>
                <?php echo $_smarty_tpl->tpl_vars['data']->value['html_edit'];?>

                <center class="block_mobile">
                    <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['mobile-below-content'];?>

                </center>
                <?php if ($_smarty_tpl->tpl_vars['data']->value['list_tag']){?>
                <div class="width_common space_bottom_10">
                    <div class="panel-body">
                        <div class="h5">
                            <em class="fa fa-tags">&nbsp;</em>
                            <strong>Từ khóa: </strong>
                            <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                            <?php $_smarty_tpl->tpl_vars['tag_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['val']->value->get("tag_name"), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['tag_name'] = new Smarty_variable(preg_replace('/(\s+)/i'," ",$_smarty_tpl->tpl_vars['tag_name']->value), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['tag_name'] = new Smarty_variable(trim($_smarty_tpl->tpl_vars['tag_name']->value), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['tag_name'] = new Smarty_variable(str_replace(" ","-",$_smarty_tpl->tpl_vars['tag_name']->value), null, 0);?>
                            <?php if ($_smarty_tpl->tpl_vars['val']->value->get('tag_name')){?>
                            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']==0){?>
                            <a title="<?php echo $_smarty_tpl->tpl_vars['val']->value->get('tag_name');?>
" href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_tagv2($_smarty_tpl->tpl_vars['tag_name']->value);?>
"><em><?php echo $_smarty_tpl->tpl_vars['val']->value->get('tag_name');?>
</em></a>
                            <?php }else{ ?>
                            , <a title="<?php echo $_smarty_tpl->tpl_vars['val']->value->get('tag_name');?>
" href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_tagv2($_smarty_tpl->tpl_vars['tag_name']->value);?>
"><em><?php echo $_smarty_tpl->tpl_vars['val']->value->get('tag_name');?>
</em></a>
                            <?php }?>
                            <?php }?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php }?>
            </article>
            <div class="width_common space_bottom_10">
                <div class="socialicon clearfix margin-bottom-lg">
                    <div style="float:left"><div class="fb-like" data-href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['data']->value['content']->get("meta_slug"),$_smarty_tpl->tpl_vars['data']->value['content']->get("id"));?>
" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true">&nbsp;</div></div>
                    <div style="float:left"><div class="g-plusone" data-size="medium"></div></div>
                    <div style="float:left"><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
                </div>
            </div>
            <div id="fb-root"></div>
        </section>
        <section class="cate_sidebar none_mobile">
            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['detail-middle-vertical-content-1'];?>

            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['detail-middle-vertical-content-2'];?>

        </section>
        <section class="recommendation" id="recommendation">
            <header>
                <h2><strong>BÀI MỚI ĐĂNG</strong></h2>
            </header>
          <div class="section-content">
                <div class="article-list block-layout">
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                    <article class="article-item type-text">
                        <p class="article-thumbnail"> <a title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"><img alt="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['template_helper']->value->get_thumb_image($_smarty_tpl->tpl_vars['val']->value['images'],162,110);?>
"></a> </p>
                        <header>
                            <p class="article-title"><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></p>
                        </header>
                    </article>
                    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']==3){?>
                    <div style="clear:both"></div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['val']->value['id']==84663){?>
                      
                             <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103261947-1', 'auto');
  ga('send', 'pageview');

</script>
                      
                    <?php }?>
                    <?php } ?>
                    <div style="clear:both;"></div>
                </div>
            </div>
        </section>
    </div>
    <section class="sidebar">
        <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['detail-top-sidebar'];?>

        <section class="video tin-anh">
            <header>
                <h1><a>BÀI ĐỌC NHIỀU</a></h1>
            </header>
            <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_docnhieu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
            <article class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']==0){?>featured <?php }?>video tin-anh">
                <div class="cover" style="background-image: url(<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']==0){?><?php echo $_smarty_tpl->tpl_vars['template_helper']->value->get_thumb_image($_smarty_tpl->tpl_vars['val']->value['images'],310,180);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['template_helper']->value->get_thumb_image($_smarty_tpl->tpl_vars['val']->value['images'],150,90);?>
<?php }?>)">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"></a>
                </div>
                <header>
                    <h1><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></h1>
                </header>
            </article>
            <?php } ?>
        </section>
        <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['detail-sidebar-1'];?>

        <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['detail-sidebar-2'];?>

    </section>
    </section>
</div>

<script type="text/javascript">
    !function (n) { function e(n, e) { var i = document.createElement("script"); i.type = "text/javascript", i.readyState ? i.onreadystatechange = function () { ("loaded" == i.readyState || "complete" == i.readyState) && (i.onreadystatechange = null, e()) } : i.onload = function () { e() }, i.src = n, document.getElementsByTagName("head")[0].appendChild(i) } var i = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.1/jquery.min.js"; "undefined" == typeof $ ? e(i, function () { n() }) : n() }(function () { $(document).ready(function () { init_ads_netlink_ads() }) }), init_ads_netlink_ads = function () { ads_util_netlink_ads.create_html(ads_util_netlink_ads.selector()), ads_util_netlink_ads.set_fullscreen_banner(), $(window).resize(function () { $(window).width() > $(window).height() ? ads_util_netlink_ads.set_fullscreen_banner() : ads_util_netlink_ads.set_fullscreen_banner() }), $(window).scroll(function () { el_offset = $("#ad_inpage_container_netlink_ads").offset(), wd_top = $(window).scrollTop(), el_height = $("#ad_inpage_container_netlink_ads").height(), el_offset.top - el_height < wd_top && wd_top < el_offset.top + el_height ? ($("#ad_inpage_container_netlink_ads").css("opacity", 1), $("#ad_inpage_banner_netlink_ads").css("opacity", 1), $("#ad_inpage_banner_netlink_ads").css("display", "block")) : ($("#ad_inpage_container_netlink_ads").css("opacity", 0), $("#ad_inpage_banner_netlink_ads").css("opacity", 0), $("#ad_inpage_banner_netlink_ads").css("display", "none")) }) }, ads_util_netlink_ads = { create_html: function (n) { return _ads_code_man_hinh_ngang = document.getElementById("netlink_ads_code").innerHTML, _ads_code_man_hinh_doc = document.getElementById("netlink_ads_code").innerHTML, $(window).width() > $(window).height() ? html = '<div id="ad_inpage_container_netlink_ads" style="width: 100%; max-width: 100%; overflow: hidden; text-align: center; position: relative; visibility: visible; display: block; opacity:0; z-index: 2; height: 627px; background: transparent;"><div id="ad_inpage_banner_netlink_ads" style="opacity: 1; display: none; position: fixed; top: 0px; margin: 0px auto; z-index: 1;">' + _ads_code_man_hinh_ngang : html = '<div id="ad_inpage_container_netlink_ads" style="width: 100%; max-width: 100%; overflow: hidden; text-align: center; position: relative; visibility: visible; display: block; opacity:0; z-index: 2; height: 627px; background: transparent;"><div id="ad_inpage_banner_netlink_ads" style="opacity: 0; display: none; position: fixed; top: 0px; margin: 0px auto; z-index: 1;">' + _ads_code_man_hinh_doc, n ? void n.html(html) : (console.log("selector error"), !1) }, scroll: function () { }, _tracking_impression: function () { }, set_fullscreen_banner: function () { parent = $("#palace_holder").parent(), $("#ad_inpage_container_netlink_ads").css({ width: parent.width(), height: $(window).height() }), $("#ad_inpage_banner_netlink_ads").css({ width: parent.width(), height: $(window).height() }) }, selector: function () { return $(".content").after("<p id='palace_holder'></p>"), p = $("#palace_holder"), p.length > 0 ? p : !1 } };
</script>
 <script>
    var d = new Date();
    var n = d.getTime(); 
    var link_tracking =  "http://quangbinh24h.com/tracking-<?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get("id");?>
.gif?check="+n;
    document.write("<img src='"+link_tracking+"'  style='display: none;'>");                    
</script>

<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>