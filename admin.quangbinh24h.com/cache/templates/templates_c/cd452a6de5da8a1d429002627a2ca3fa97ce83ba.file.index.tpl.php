<?php /* Smarty version Smarty-3.1.12, created on 2017-10-28 09:12:44
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/category/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:81385665759f3e79c548ee5-88580553%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd452a6de5da8a1d429002627a2ca3fa97ce83ba' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/category/index.tpl',
      1 => 1504767330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81385665759f3e79c548ee5-88580553',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_helper' => 0,
    'link_helper' => 0,
    'data' => 0,
    'val' => 0,
    'link' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59f3e79c84aa11_41613654',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f3e79c84aa11_41613654')) {function content_59f3e79c84aa11_41613654($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading"> 
            <h3>Bảng điều khiển</h3> 
            <div class="resBtnSearch">
                <a href="#"><span class="icon16 brocco-icon-search"></span></a>
            </div>               
            <ul class="breadcrumb">
                <li>Vị trí hiện tại:</li>
                <li>
                    <a href="" class="tip" title="Trở lại bảng điều khiển">
                        <span class="icon16 icomoon-icon-screen"></span>
                    </a> 
                    <span class="divider">
                        <span class="icon16 icomoon-icon-arrow-right"></span>
                    </span>
                </li>
                <li class="active">Bảng điều khiển</li>
            </ul> 
        </div><!-- End .heading-->
        <div class="row-fluid">
            <?php echo $_smarty_tpl->tpl_vars['template_helper']->value->displayAlert();?>
                    
        </div><!-- End .row-fluid -->                 
        <div class="row-fluid">                                                
            <a class="btn btn-success btn-large" href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('CategoryAdd');?>
">Thêm Chuyên mục</a>
        </div>
        <hr class="line" />
        <div class="row-fluid">
            <div class="box gradient">                                
                <div class="title">
                    <h4>
                        <span>Danh sách Chuyên mục</span>
                    </h4>
                </div>                
                <div class="clearfix right margin10">                                    
                </div>
                <div class="content noPad">                                     
                    <div class="clearfix">
                        <table class="responsive table table-bordered" id="checkAll">
                            <thead>
                                <tr>
                                    <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" /></th>
                                    <th>Tên chuyên mục</th>                                            
                                    <th>description</th>                                            
                                    <th>meta_slug</th>                                            
                                    <th>meta_title</th>                                            
                                    <th>meta_keyword</th>                                            
                                    <th>meta_description</th>                                            
                                </tr>
                            </thead>
                            <tbody>   
                                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                                <tr <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']%2!=0){?> class="second" <?php }?> >
                                    <td ><strong style="color: blue;"><?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
</strong></td>                                                
                                    <td class="alignleft"><span class="lastedit-pe"></span><strong style="color: blue;"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</strong>
                                        <div class="quk-edit">  
                                            <a href="http://danang24h.tinmoi.vn/c/<?php echo $_smarty_tpl->tpl_vars['val']->value['meta_slug'];?>
" target="_blank">Xem nhanh</a>                                               
                                            |
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->link_edit("CategoryEdit",$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Sửa</a>                                                                                                       
                                        </div>
                                    </td> 
                                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['description'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['meta_slug'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['meta_title'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['meta_keyword'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['meta_description'];?>
</td>
                                </tr>
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                <tr>
                                    <td ><strong style="color: blue;"><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</strong></td>
                                    <td class="alignleft"><span class="lastedit-pe"></span><strong>___<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</strong>
                                        <div class="quk-edit">  
                                            <a href="http://danang24h.tinmoi.vn/c/<?php echo $_smarty_tpl->tpl_vars['item']->value['meta_slug'];?>
" target="_blank">Xem nhanh</a>                                               
                                            |
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->link_edit("CategoryEdit",$_smarty_tpl->tpl_vars['item']->value['id']);?>
">Sửa</a>                                                                                                       
                                        </div>
                                    </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['meta_slug'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['meta_title'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['meta_keyword'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['meta_description'];?>
</td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                            </tbody>                                        
                        </table>
                    </div>
                </div><!-- End .box -->
            </div><!-- End .row-fluid --> 
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->
    </div><!-- End #wrapper -->
<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>