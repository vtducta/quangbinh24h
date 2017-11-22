<?php /* Smarty version Smarty-3.1.12, created on 2017-09-16 10:54:00
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/user/load_js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:191443492059bca058a5dcd4-72511193%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb78d628702bddf4ec28c5434aa3cb05d0bd9553' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/user/load_js.tpl',
      1 => 1504767333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '191443492059bca058a5dcd4-72511193',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59bca058a63ea0_11288235',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59bca058a63ea0_11288235')) {function content_59bca058a63ea0_11288235($_smarty_tpl) {?><script type="text/javascript">
         $(document).ready(function(){
             $("#groupname").change(function(){
                if($(this).val() ==4)
                {
                   $("#category").hide();
                }else{
                    $("#category").show();
                }
             });
             if($( "#groupname option:selected" ).val()==4)
             {
                 $("#category").hide();
             }else{
                 $("#category").show();
             }

         });
</script><?php }} ?>