<?php /* Smarty version Smarty-3.1.12, created on 2017-09-12 13:07:55
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:158461071059b779bb74bf56-96834358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa4e5d888d4dc31bd0d0ee7ddc2dd00620a7afd5' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/search.tpl',
      1 => 1504767330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158461071059b779bb74bf56-96834358',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b779bb74e083_33002836',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b779bb74e083_33002836')) {function content_59b779bb74e083_33002836($_smarty_tpl) {?><form action="/" method="post" id="search">
    <div class="left margin10">                                        
        <label>Tìm kiếm: <input id="keyword" name="keyword" type="text" aria-controls="   checkAll" class="text"></label>
    </div>                                            
    <div class="left margin10">
        <button  type="button" class="btn btn-info" onclick="timkiem()">Tìm bài viết</button>
    </div>
</form>                                 <?php }} ?>