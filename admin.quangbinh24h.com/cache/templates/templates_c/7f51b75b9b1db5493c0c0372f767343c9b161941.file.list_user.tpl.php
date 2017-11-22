<?php /* Smarty version Smarty-3.1.12, created on 2017-09-14 13:57:13
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/user/list_user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:102502092059ba284969b038-96875184%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f51b75b9b1db5493c0c0372f767343c9b161941' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/user/list_user.tpl',
      1 => 1504767333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102502092059ba284969b038-96875184',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'GUrl' => 0,
    'template_helper' => 0,
    'data' => 0,
    'val' => 0,
    'link_helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59ba2849727c26_53097747',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59ba2849727c26_53097747')) {function content_59ba2849727c26_53097747($_smarty_tpl) {?>    <?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
                    <h3>Danh sách thành viên</h3>                    
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
                        <li class="active">Danh sách thành viên</li>
                    </ul>
                </div><!-- End .heading-->
                <!-- Build page from here: -->
                <div class="row-fluid">
                <?php echo $_smarty_tpl->tpl_vars['template_helper']->value->displayAlert();?>

                    <div class="box gradient">                                
                                <div class="title">
                                    <h4>
                                        <span>Danh sách thành viên</span>
                                    </h4>
                                </div>                                                                    
                                    <div class="content noPad">
                                    <table class="responsive table table-bordered" id="checkAll">
                                        <thead>
                                          <tr>
                                            <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                            <th>Tên đăng nhập</th>                                            
                                            <th>Fullname</th>
                                            <th>Chức danh</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                                          <tr>
                                            <td class="chChildren"><input type="checkbox" name="checkbox[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="styled" /></td>
                                            <td class="alignleft"><span class="lastedit-pe"></span><strong style="color: blue;"><?php echo $_smarty_tpl->tpl_vars['val']->value['user_name'];?>
</strong>
                                                <div class="quk-edit">
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("EditUser",$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Sửa</a>
                                                | 
                                                <a  href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome("UserAction");?>
&action=deleteUser&id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
">Xóa</a>
                                                | 
                                                <a  href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("ResetPass",$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Reset pass</a>
                                                </div>
                                            </td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['val']->value['fullname'];?>
</td>
                                            <td><?php if ($_smarty_tpl->tpl_vars['val']->value['id']==121){?>Coder<?php }elseif($_smarty_tpl->tpl_vars['val']->value['group_id']==1){?><strong style="color: blue;">S.Mod</strong><?php }elseif($_smarty_tpl->tpl_vars['val']->value['group_id']==2){?><strong style="color: green">Mod</strong> <?php }elseif($_smarty_tpl->tpl_vars['val']->value['group_id']==3){?><strong style="color: red;">Reporter</strong><?php }elseif($_smarty_tpl->tpl_vars['val']->value['group_id']==4){?><strong style="color: gray;">Administrator</strong><?php }?></td>
                                          </tr> 
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