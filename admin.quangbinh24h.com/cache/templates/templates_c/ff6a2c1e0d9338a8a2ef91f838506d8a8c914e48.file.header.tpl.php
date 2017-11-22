<?php /* Smarty version Smarty-3.1.12, created on 2017-09-21 11:05:00
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:168927061859b779bb6d9768-61179130%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff6a2c1e0d9338a8a2ef91f838506d8a8c914e48' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/header.tpl',
      1 => 1505966697,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '168927061859b779bb6d9768-61179130',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b779bb6e8640_18660804',
  'variables' => 
  array (
    'GUrl' => 0,
    'link_helper' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b779bb6e8640_18660804')) {function content_59b779bb6e8640_18660804($_smarty_tpl) {?> <div id="header">   
        <div class="navbar">
            <div class="navbar-inner">
              <div class="container-fluid">
                <a class="brand" href="<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Base'];?>
"><img height="56px" src="images/logo.png?2" /></a>
                <div class="nav-no-collapse">                   
                    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Base'];?>
js/app/jquery.user.js?3"></script>
                    
                    <ul class="nav pull-right usernav">
                        <li><a href="http://quangbinh24h.com/" class="tipB" title="Trang chủ" target="_blank"><span class="icon16 entypo-icon-home"></span></a></li>
                        <li class="dropdown" id="userinfo">                        
                        </li>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('Logout');?>
" class="tipB" title="Đăng xuất"><span class="icon16 icomoon-icon-exit"></span> Đăng xuất</a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
          </div><!-- /navbar -->
</div><!-- End #header -->
<?php }} ?>