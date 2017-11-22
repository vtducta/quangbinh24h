<?php /* Smarty version Smarty-3.1.12, created on 2017-09-12 13:07:57
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/statics_news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:148530307759b779bd3e18d8-58155345%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88b53a5ecb6762a644c4f3df4c980cf913284b4d' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/statics_news.tpl',
      1 => 1504767330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '148530307759b779bd3e18d8-58155345',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b779bd41c808_63292513',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b779bd41c808_63292513')) {function content_59b779bd41c808_63292513($_smarty_tpl) {?><div class="rightnow">
    <ul class="unstyled">
        <li><span class="number"><?php echo $_smarty_tpl->tpl_vars['data']->value['total']['public'];?>
</span><span class="icon16 icomoon-icon-new"></span>Tin</li>
        <li><span class="number"><?php echo $_smarty_tpl->tpl_vars['data']->value['total']['event'];?>
</span><span class="icon16 icomoon-icon-seven-segment"></span>sự kiện</li>
        <li><span class="number"><?php echo $_smarty_tpl->tpl_vars['data']->value['total']['category'];?>
</span><span class="icon16 brocco-icon-list"></span>Chuyên mục</li>    
    </ul>
</div><?php }} ?>