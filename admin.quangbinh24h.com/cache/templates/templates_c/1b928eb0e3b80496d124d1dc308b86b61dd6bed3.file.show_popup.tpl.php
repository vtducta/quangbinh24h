<?php /* Smarty version Smarty-3.1.12, created on 2017-09-13 13:42:38
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/box/show_popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39463152259b8d35ef11f32-01510358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b928eb0e3b80496d124d1dc308b86b61dd6bed3' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/box/show_popup.tpl',
      1 => 1504767330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39463152259b8d35ef11f32-01510358',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b8d35f02f767_75246318',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b8d35f02f767_75246318')) {function content_59b8d35f02f767_75246318($_smarty_tpl) {?> <table class="responsive table table-bordered" id="checkAll">
    <thead>
      <tr>
        <th>Loại</th>                                            
        <th>Vị trí</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
 
    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_box']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
      <tr>
        <td>
            <?php echo $_smarty_tpl->tpl_vars['val']->value['type'];?>

        </td>
        <td><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</td>
        <td id="set_hot_news<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
">      
            <?php if (!in_array($_smarty_tpl->tpl_vars['val']->value['id'],$_smarty_tpl->tpl_vars['data']->value['list_box_art'])){?>    
                <button data-toggle="modal" type="button" class="btn btn-info btn-large" style="width: 100px;font-size: 15px; font-weight: bold;" onclick="set_news_hot(<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['data']->value['news_id'];?>
,'set_pos')">Set vị trí</button>
            <?php }else{ ?>
                <button data-toggle="modal" type="button" class="btn btn-mini" style="width: 100px; font-size: 15px; font-weight: bold; height: 38px; border: 1px solid;" onclick="set_news_hot(<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['data']->value['news_id'];?>
,'delete_pos')" >Hạ xuống</button>
            <?php }?>
        </td>
      </tr> 
    <?php } ?>
    </tbody>
</table><?php }} ?>