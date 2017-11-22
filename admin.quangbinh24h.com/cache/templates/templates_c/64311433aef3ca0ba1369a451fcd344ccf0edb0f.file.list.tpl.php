<?php /* Smarty version Smarty-3.1.12, created on 2017-10-07 11:50:17
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/journalist/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:158301149259d85d090fddd2-62293552%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64311433aef3ca0ba1369a451fcd344ccf0edb0f' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/journalist/list.tpl',
      1 => 1504767331,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158301149259d85d090fddd2-62293552',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'GUrl' => 0,
    'template_helper' => 0,
    'link_helper' => 0,
    'data' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59d85d0935fec2_01536383',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59d85d0935fec2_01536383')) {function content_59d85d0935fec2_01536383($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<!-- loading animation -->
<div id="qLoverlay"></div>
<div id="qLbar"></div>
<?php echo $_smarty_tpl->getSubTemplate ('block/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="wrapper">
    <!--Responsive navigation button-->  
    <div class="resBtn">
        <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
    </div>
    <!--Sidebar collapse button-->  
    <div class="collapseBtn">
        <a href="#" class="tipR" title="Ẩn menu"><span class="icon12 minia-icon-layout"></span></a>
    </div>
    <!--Sidebar background-->
    <div id="sidebarbg"></div>        
    <?php echo $_smarty_tpl->getSubTemplate ('block/menu_left.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
       
    <!--Body content-->
    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Con1tent wrapper-->
            <div class="heading">
                <h3>Danh sách tác giả</h3>                    
                <div class="resBtnSearch">
                    <a href="#"><span class="icon16 brocco-icon-search"></span></a>
                </div>
                <ul class="breadcrumb">
                    <li>Vị trí hiện tại:</li>
                    <li>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Base'];?>
" class="tip" title="Trở lại bảng điều khiển">
                            <span class="icon16 icomoon-icon-screen"></span>
                        </a> 
                        <span class="divider">
                            <span class="icon16 icomoon-icon-arrow-right"></span>
                        </span>
                    </li>
                    <li class="active">Danh sách tác giả</li>
                </ul>
            </div><!-- End .heading-->
            <!-- Build page from here: -->
            <div class="row-fluid">
                <?php echo $_smarty_tpl->tpl_vars['template_helper']->value->displayAlert();?>
  
                <div class="clearfix">
                    <div class="left" style="">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_admin('CreateJournalist');?>
" class="btn btn-info left margin10" style="z-index: 3;">Tạo tác giả</a>
                    </div>
                </div>
                <div class="box gradient">                                
                    <div class="title">
                        <h4>
                            <span>Danh sách tác giả</span>
                        </h4>
                    </div>
                    <?php if (sizeof($_smarty_tpl->tpl_vars['data']->value['list_journalist'])>0){?>
                    <div class="content noPad">
                        <table class="responsive table table-bordered" id="checkAll">
                            <thead>
                                <tr>
                                    <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                    <th>Tên đầy đủ</th>
                                    <th>Bút danh</th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Facebook</th>
                                    <th>GPlus</th>
                                    <th>Avatar</th>
                                    <th>Tiểu sử</th>
                                    <th>Đánh giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_journalist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                                <tr>
                                    <td class="chChildren"><input type="checkbox" name="checkbox[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="styled" /></td>
                                    <td class="alignleft"><span class="lastedit-pe"></span><strong><?php echo $_smarty_tpl->tpl_vars['val']->value['full_name'];?>
</strong>
                                        <div class="quk-edit">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("EditJournalist",$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Sửa</a>
                                            <?php if ($_smarty_tpl->tpl_vars['data']->value['group_user']==4){?>
                                            | <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_delete_journalist($_smarty_tpl->tpl_vars['val']->value['id']);?>
" onclick="return confirm('Bạn chắc chắn xóa?');">Xóa</a>
                                            <?php }?>
                                        </div>
                                    </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['pen_name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['email'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['birthday'];?>
</td>
                                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['facebook_link'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['val']->value['facebook'];?>
</a></td>
                                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['gplus_link'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['val']->value['gplus'];?>
</a></td>
                                    <td><img src="<?php echo $_smarty_tpl->tpl_vars['val']->value['avatar'];?>
" style="max-height: 150px;max-width: 150px;"></td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['biography'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['rate'];?>
</td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }elseif(sizeof($_smarty_tpl->tpl_vars['data']->value['list_journalist'])==0){?>
                    Bạn chỉ được thao tác đối với những tài khoản bạn đã tạo.   
                    <?php }?>

                </div><!-- End .box -->
            </div><!-- End .row-fluid -->
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->

    </div><!-- End #wrapper -->
<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>