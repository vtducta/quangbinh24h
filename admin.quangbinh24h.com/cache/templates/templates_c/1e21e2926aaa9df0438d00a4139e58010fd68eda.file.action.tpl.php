<?php /* Smarty version Smarty-3.1.12, created on 2017-09-12 13:07:57
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/action.tpl" */ ?>
<?php /*%%SmartyHeaderCode:83637229459b779bd4c2e07-75769132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e21e2926aaa9df0438d00a4139e58010fd68eda' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/action.tpl',
      1 => 1504767329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83637229459b779bd4c2e07-75769132',
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
  'unifunc' => 'content_59b779bd54ef33_01758358',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b779bd54ef33_01758358')) {function content_59b779bd54ef33_01758358($_smarty_tpl) {?><div class="centerContent">                                 
    <ul class="bigBtnIcon">                                
    <?php if ($_smarty_tpl->tpl_vars['data']->value['group_user']==4){?>
        <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AcpAddNews');?>
">
                <span class="icon brocco-icon-pencil"></span>
                <span class="txt">Viết bài mới</span>                                       
            </a>
        </li>
         <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AcpNotPublic');?>
" title="Bài đã chờ duyệt" class="pattern tipB">
                <span class="icon brocco-icon-clock"></span>
                <span class="txt">Bài chờ duyệt</span>  
                <span class="notification blue"><?php echo $_smarty_tpl->tpl_vars['data']->value['total']['no_public'];?>
</span>             
            </a>
        </li>
        <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AcpHome');?>
" title="Bài đã được đăng" class="pattern tipB">
                <span class="icon brocco-icon-play"></span>
                <span class="txt">Bài đã public</span>
                <span class="notification green"><?php echo $_smarty_tpl->tpl_vars['data']->value['total']['public'];?>
</span>
            </a>
        </li>
         <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AcpTimer');?>
" title="Bài hẹn giờ" class="pattern tipB">
                <span class="icon brocco-icon-alarm"></span>
                <span class="txt">Bài hẹn giờ</span>
                <span class="notification green"><?php echo $_smarty_tpl->tpl_vars['data']->value['total']['timer'];?>
</span>
            </a>
        </li>
        <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('Royalties');?>
" title="Nhuận bút" class="pattern tipB">
                <span class="icon brocco-icon-plus"></span>
                <span class="txt">Nhuận bút</span>                
            </a>
        </li>
    <?php }elseif($_smarty_tpl->tpl_vars['data']->value['group_user']==1){?>
        <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AdminAdd');?>
">
                <span class="icon brocco-icon-pencil"></span>
                <span class="txt">Viết bài mới</span>                                       
            </a>
        </li>
        <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AdminNotPublic');?>
" title="Bài đã chờ duyệt" class="pattern tipB">
                <span class="icon brocco-icon-pause"></span>
                <span class="txt">Bài chờ duyệt</span>  
                <span class="notification blue"><?php echo $_smarty_tpl->tpl_vars['data']->value['total_user']['no_public'];?>
</span>             
            </a>
        </li>
        <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AdminHome');?>
" title="Bài đã được đăng" class="pattern tipB">
                <span class="icon brocco-icon-play"></span>
                <span class="txt">Bài đã public</span> 
                <span class="notification green"><?php echo $_smarty_tpl->tpl_vars['data']->value['total_user']['public'];?>
</span>                            
            </a>
        </li>
    <?php }?>
        <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AddEvent');?>
" title="Tạo sự kiện"  class="tipB">
                <span class="icon brocco-icon-calendar"></span>
                <span class="txt">Tạo sự kiện</span>
                <span class="notification gray"><?php echo $_smarty_tpl->tpl_vars['data']->value['total']['event'];?>
</span>
            </a>
        </li>                               
        <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('NewsComment');?>
" title="Quản lý comment" class="pattern tipB">
                <span class="icon cut-icon-comment "></span>
                <span class="txt">Comment</span>            
            </a>
        </li>    
    </ul>
</div>
<?php }} ?>