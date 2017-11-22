<?php /* Smarty version Smarty-3.1.12, created on 2017-09-12 10:56:46
         compiled from "/home/app/quangbinh24h-apps/quangbinh24h.com/html/templates/category/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:82770873959b75afe8826b8-49450384%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2fe6fb55a32d340fc5e1468ab4bca09e14be8b06' => 
    array (
      0 => '/home/app/quangbinh24h-apps/quangbinh24h.com/html/templates/category/index.tpl',
      1 => 1504767455,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '82770873959b75afe8826b8-49450384',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'link_helper' => 0,
    'one' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b75afea43552_86596394',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b75afea43552_86596394')) {function content_59b75afea43552_86596394($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/app/kcms/libraries/smarty/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="wrapper" id="container">
    <?php echo $_smarty_tpl->getSubTemplate ('block/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <section class="template2" id="category">
        <div class="content-wrap">
            <section class="cate_content">
                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['news_hot_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                <section class="featured">
                    <article class="featured picture">
                        <div class="cover">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
" border="0" class="image1" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"/></a>
                        </div>
                        <header>
                            <p class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></p>
                            <p class="summary"><?php echo $_smarty_tpl->tpl_vars['val']->value['intro_text'];?>
</p>
                        </header>
                    </article>
                </section>
                <?php } ?>
                <section class="cate_content tt-cate">
                    <header></header>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                    <article>
                        <div style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
)" class="cover"> <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"></a> </div>
                        <header class="cate-new">
                            <h1><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a><span class="social"></span></h1>
                            <time datetime="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%H:%M %d-%m-%Y");?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%H:%M %d-%m-%Y");?>
</time>
                            <p class="summary"><?php echo $_smarty_tpl->tpl_vars['val']->value['intro_text'];?>
</p>
                        </header>
                    </article>
                    <?php } ?>
                    <div class="clearfix"></div>
                    
                    <?php if ($_smarty_tpl->tpl_vars['data']->value['paging']['total']>1){?>
                        <div class="text-center">
                            <ul class="pagination none_mobile">
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['object_category']->get('meta_slug'),$_smarty_tpl->tpl_vars['data']->value['paging']['current']-5);?>
">&lt;&lt;</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['object_category']->get('meta_slug'),$_smarty_tpl->tpl_vars['data']->value['paging']['current']-1);?>
">&lt;</a></li>
                                <?php  $_smarty_tpl->tpl_vars['one'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['one']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['paging']['page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['one']->key => $_smarty_tpl->tpl_vars['one']->value){
$_smarty_tpl->tpl_vars['one']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['one']->key;
?>
                                <li <?php if ($_smarty_tpl->tpl_vars['one']->value==$_smarty_tpl->tpl_vars['data']->value['paging']['current']){?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['object_category']->get('meta_slug'),$_smarty_tpl->tpl_vars['one']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['one']->value;?>
</a></li>
                                <?php } ?>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['object_category']->get('meta_slug'),$_smarty_tpl->tpl_vars['data']->value['paging']['current']+1);?>
">&gt;</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['object_category']->get('meta_slug'),$_smarty_tpl->tpl_vars['data']->value['paging']['current']+5);?>
">&gt;&gt;</a></li>
                            </ul>
                            <ul class="pagination block_mobile">
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['object_category']->get('meta_slug'),$_smarty_tpl->tpl_vars['data']->value['paging_mobile']['current']-3);?>
">&lt;&lt;</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['object_category']->get('meta_slug'),$_smarty_tpl->tpl_vars['data']->value['paging_mobile']['current']-1);?>
">&lt;</a></li>
                                <?php  $_smarty_tpl->tpl_vars['one'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['one']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['paging_mobile']['page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['one']->key => $_smarty_tpl->tpl_vars['one']->value){
$_smarty_tpl->tpl_vars['one']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['one']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                                <li <?php if ($_smarty_tpl->tpl_vars['one']->value==$_smarty_tpl->tpl_vars['data']->value['paging_mobile']['current']){?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['object_category']->get('meta_slug'),$_smarty_tpl->tpl_vars['one']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['one']->value;?>
</a></li>
                                <?php } ?>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['object_category']->get('meta_slug'),$_smarty_tpl->tpl_vars['data']->value['paging_mobile']['current']+1);?>
">&gt;</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_category($_smarty_tpl->tpl_vars['data']->value['object_category']->get('meta_slug'),$_smarty_tpl->tpl_vars['data']->value['paging_mobile']['current']+3);?>
">&gt;&gt;</a></li>
                            </ul>
                        </div>
                    <?php }?>
                </section>
                <div style="clear:both"></div>
                <section class="well_read_mobile cate_content tt-cate">
                    <div class="head_well_read">BÀI ĐỌC NHIỀU</div>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_docnhieu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                    <article>
                        <div class="cover" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['val']->value['images'];?>
)">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
"></a>
                        </div>
                        <header class="cate-new">
                            <h1><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_to_news($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></h1>
                            <time datetime="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%H:%M %d-%m-%Y");?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%H:%M %d-%m-%Y");?>
</time>
                            <p class="summary"><?php echo $_smarty_tpl->tpl_vars['val']->value['intro_text'];?>
</p>
                        </header>
                    </article>
                    <?php } ?>
                </section>
            </section>
            <section class="cate_sidebar"></section>
        </div>
        <section class="sidebar">
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

            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['cat-sidebar-1'];?>

            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['cat-sidebar-2'];?>

            <?php echo $_smarty_tpl->tpl_vars['data']->value['listAds']['cat-sidebar-3'];?>

        </section>
    </section>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>