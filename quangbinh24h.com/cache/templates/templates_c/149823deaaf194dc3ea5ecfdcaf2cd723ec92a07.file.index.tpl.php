<?php /* Smarty version Smarty-3.1.12, created on 2017-10-01 20:34:35
         compiled from "/home/app/quangbinh24h-apps/quangbinh24h.com/html/templates/home/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:115363497459b755a12d07e2-50070995%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '149823deaaf194dc3ea5ecfdcaf2cd723ec92a07' => 
    array (
      0 => '/home/app/quangbinh24h-apps/quangbinh24h.com/html/templates/home/index.tpl',
      1 => 1506864862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '115363497459b755a12d07e2-50070995',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b755a1518964_15155962',
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'link_helper' => 0,
    'template_helper' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b755a1518964_15155962')) {function content_59b755a1518964_15155962($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_mb_truncate')) include '/home/app/kcms/libraries/smarty/plugins/modifier.mb_truncate.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/app/kcms/libraries/smarty/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="wrapper" id="container">
    <?php echo $_smarty_tpl->getSubTemplate ('block/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <section class="focus_layout" id="homepage">
        <div class="content-wrap">
            <section class="featured">
                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_lastest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']==0){?>
                <article class="featured">
                    <div style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
);" class="cover">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"></a>
                    </div>
                    <header>
                        <h1><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php if ($_smarty_tpl->tpl_vars['val']->value['id']==88229){?><img src="http://media.nghean24h.vn/2017/7/15/1/livestream-1500092844.jpg" style="height: 14px;margin-right: 5px;"><?php }?><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></h1>
                        <p class="summary"><?php echo $_smarty_tpl->tpl_vars['val']->value['intro_text'];?>
</p>
                    </header>
                </article>
                <?php }?>
                <?php } ?>
            </section>
            <section class="trending scroll mCustomScrollbar _mCS_1">
                 <div class="none_mobile" style="text-align: center; clear:both; margin-bottom: 10px;">
            <img src="http://media.danang24h.vn/2017/8/24/1/lienhe-1503542075.jpg" tyle="height: 57; width: 174" />
                </div>
                <div class="mCustomScrollBox mCS-dark" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                    <div class="mCSB_container" style="position:relative; top:0;">
                        <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_lastest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']>0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']<7){?>
                        <article>
                            <div class="cover">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
"></a>
                            </div>
                            <header>
                                <h1><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></h1>
                            </header>
                        </article>
                        <?php }?>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <div style="clear:both;"></div>
            <div class="slide_video">
                <ul class="list_slide_hot">
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_lastest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']>9){?>
                    <li>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" class="thumbb_slide"><img src="<?php echo $_smarty_tpl->tpl_vars['template_helper']->value->get_thumb_image($_smarty_tpl->tpl_vars['val']->value['images'],160,110);?>
"/> </a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" class="title_slide"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a>
                    </li>
                    <?php }?>
                    <?php } ?>
                </ul>
                
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
                
            </div>
            <section class="video tin-anh skin_mobile">
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
                    <div class="cover" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
)">
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
        </div>
        
        <section class="sidebar">
            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['top-hot'];?>

            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['top'];?>

        </section>
        
        <div class="none_mobile" style="text-align: center; clear:both; margin-bottom: 10px;">
            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['middle'];?>

        </div>
        <div class="block_mobile" style="text-align: center; clear:both; margin-bottom: 10px;">
            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['mobile-middle'];?>

        </div>
        
        <div class="content-wrap">
            <div class="content-wrap">
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_news_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                <section class="category skin1">
                    <header>
                        <hgroup>
                            <h1><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['v']->value['meta_slug'],0);?>
" title="<?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></h1>
                        </hgroup>
                    </header>
                    <?php if ($_smarty_tpl->tpl_vars['v']->value['id']==1){?>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['v']->value['news_hot_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                    <article class="featured">
                        <div class="cover" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
)">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"></a>
                        </div>
                        <header class="home-title">
                            <h1><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></h1>
                        </header>
                        <p class="summary"><?php echo smarty_modifier_mb_truncate($_smarty_tpl->tpl_vars['val']->value['intro_text'],170,"...","utf-8");?>
</p>
                        <p class="summary_more"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%H:%M %d-%m-%Y");?>
 <b class="title-view"><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Xem thêm &gt;&gt;</a></b></p>
                    </article>
                    <?php } ?>
                    <div class="top text_center none_mobile">
                        <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['home-content'];?>

                    </div>
                    <div style="clear:both"></div>
                    <div class="slide_video">
                        <ul class="list_slide_video">
                            <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['v']->value['list_news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                            <li>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" class="thumbb_slide"><img src="<?php echo $_smarty_tpl->tpl_vars['template_helper']->value->get_thumb_image($_smarty_tpl->tpl_vars['val']->value['images'],125,84);?>
"/> </a>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" class="title_slide"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a>
                            </li>
                            <?php } ?>
                        </ul>
                        
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
                        
                    </div>
                    <?php }else{ ?>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['v']->value['news_hot_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                    <article class="featured">
                        <div class="cover" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
)">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"></a>
                        </div>
                        <header class="home-title">
                            <h1><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></h1>
                        </header>
                        <p class="summary"><?php echo smarty_modifier_mb_truncate($_smarty_tpl->tpl_vars['val']->value['intro_text'],170,"...","utf-8");?>
</p>
                        <p class="summary_more"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%H:%M %d-%m-%Y");?>
 <b class="title-view"><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Xem thêm &gt;&gt;</a></b></p>
                    </article>
                    <?php } ?>
                    <div class="top">
                        <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['v']->value['list_news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                        <article class="new_lq">
                            <div class="cover im-new_lq" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
)">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"></a>
                            </div>
                            <header>
                                <h1><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></h1>
                                <p class="home-more"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%H:%M %d-%m-%Y");?>
 </p>
                            </header>
                        </article>
                        <?php } ?>
                    </div>
                    <?php }?>
                </section>
                <?php } ?>
            </div>
        </div>
        <section class="sidebar">
            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['top-sidebar'];?>

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
                    <div class="cover" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
)">
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
                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_quantam']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                <article>
                    <div class="cover">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
"></a>
                    </div>
                    <header>
                        <h1><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></h1>
                        <time datetime="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%H:%M %d-%m-%Y");?>
"> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%H:%M %d-%m-%Y");?>
</time>
                    </header>
                </article>
                <?php } ?>
            </section>
            <div id="fb-root"></div>
            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['sidebar-1'];?>

            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['sidebar-2'];?>

        </section>
    </section>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>