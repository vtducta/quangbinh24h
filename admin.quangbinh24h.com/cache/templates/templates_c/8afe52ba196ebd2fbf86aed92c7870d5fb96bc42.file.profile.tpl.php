<?php /* Smarty version Smarty-3.1.12, created on 2017-09-12 13:07:57
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/user/profile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70553006959b779bd372b46-31467288%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8afe52ba196ebd2fbf86aed92c7870d5fb96bc42' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/user/profile.tpl',
      1 => 1504767333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70553006959b779bd372b46-31467288',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'link_helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b779bd459694_61867270',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b779bd459694_61867270')) {function content_59b779bd459694_61867270($_smarty_tpl) {?><a href="#" class="dropdown-toggle avatar tipB" title="Tài khoản" data-toggle="dropdown">                                
    <span class="txt"><?php echo $_smarty_tpl->tpl_vars['data']->value['user_info']->get('fullname');?>
</span>
    <b class="caret"></b>
</a>
<ul class="dropdown-menu">
    <li class="menu">
        <ul>
             <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('ChangePass');?>
"><span class="icon16 entypo-icon-contact"></span>Thay đổi pass word</a>
             </li>
        </ul>
    </li>
</ul>
<?php }} ?>