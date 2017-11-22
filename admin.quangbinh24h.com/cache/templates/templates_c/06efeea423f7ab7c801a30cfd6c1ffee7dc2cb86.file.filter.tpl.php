<?php /* Smarty version Smarty-3.1.12, created on 2017-09-16 11:09:24
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/filter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:199136625959bca3f4f314d8-16276467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06efeea423f7ab7c801a30cfd6c1ffee7dc2cb86' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/filter.tpl',
      1 => 1504767329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199136625959bca3f4f314d8-16276467',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59bca3f5032a36_85768873',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59bca3f5032a36_85768873')) {function content_59bca3f5032a36_85768873($_smarty_tpl) {?><div class="clearfix" style="padding: 10px;">
    <div class="left marginT10 marginR10"> 
        <input type="text" name="date_time" id="datepicker" value="Chọn ngày" />
    </div>
    <div class="left marginT10" style="width: 190px;overflow:hidden ;">
        <select name="select_cat" id="select_cat">
            <option id="0" value="0" >Lọc theo chuyên mục</option>
            <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                <?php if ($_smarty_tpl->tpl_vars['val']->value['status']==1&&$_smarty_tpl->tpl_vars['val']->value['home_display']==0){?>
                    <option id="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</option>
                
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['val']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                    <?php if ($_smarty_tpl->tpl_vars['v']->value->get('status')==1&&$_smarty_tpl->tpl_vars['v']->value->get('home_display')==0){?>
                        <option id="<?php echo $_smarty_tpl->tpl_vars['v']->value->get('id');?>
" value="<?php echo $_smarty_tpl->tpl_vars['v']->value->get('id');?>
" >|__<?php echo $_smarty_tpl->tpl_vars['v']->value->get('title');?>
</option>
                    <?php }?>
                <?php } ?>
                <?php }?>
            <?php } ?>                
        </select>

    </div>
    <div class="left" style="">
        <a href="javascript:void(0)" class="btn btn-info left margin10" style="z-index: 3;" onclick="filter(1)">Lọc</a>
    </div>
</div><!--clear--> <?php }} ?>