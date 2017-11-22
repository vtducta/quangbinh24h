<?php /* Smarty version Smarty-3.1.12, created on 2017-09-22 15:52:29
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/source/manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:83516288559c4cf4dbeaba9-15811075%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3663f288647e72166334ca6654df527fe264958' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/source/manage.tpl',
      1 => 1504767332,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83516288559c4cf4dbeaba9-15811075',
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
  'unifunc' => 'content_59c4cf4deb0894_46482286',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c4cf4deb0894_46482286')) {function content_59c4cf4deb0894_46482286($_smarty_tpl) {?>    <?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
                    <h3>Danh sách nguồn Bài Viết</h3>                    
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
                        <li class="active">Danh sách nguồn Bài Viết</li>
                    </ul>
                </div><!-- End .heading-->
                <!-- Build page from here: -->
                <div class="row-fluid">
                <?php echo $_smarty_tpl->tpl_vars['template_helper']->value->displayAlert();?>

                    <div class="box gradient">                                
                                <div class="title">
                                    <h4>
                                        <span>Danh sách nguồn Bài Viết</span>
                                    </h4>
                                </div> 
                                <div class="margin10 clearfix">
                                    <form id="search_form" method="get" action="">
                                        <div class="left margin10" >                                        
                                            <label>Tìm kiếm theo tên : </label>
                                            <input type="text" class="text" aria-controls="   checkAll" name="name" id="name" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['search_data']['name'])){?><?php echo stripslashes($_smarty_tpl->tpl_vars['data']->value['search_data']['name']);?>
<?php }?>">
                                            <input type="hidden" value="1" name="page" id="page">
                                            <input type="hidden" value="Source" name="act">
                                            <input type="hidden" value="manage" name="action">
                                        </div>
                                        <div class="left margin10"  style="width:200px;overflow:hidden">
                                            <label>Chọn trạng thái</label>
                                            <select name="status" style="width:200px">
                                                <option value="1" <?php if (!isset($_smarty_tpl->tpl_vars['data']->value['search_data']['status'])||$_smarty_tpl->tpl_vars['data']->value['search_data']['status']==1){?>selected="selected"<?php }?>>kích hoạt</option> 
                                                <option value="2" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['search_data']['status'])&&$_smarty_tpl->tpl_vars['data']->value['search_data']['status']==2){?>selected="selected"<?php }?>>đã xóa</option> 
                                            </select>
                                        </div>                                            
                                        <div class="left margin10">
                                            <label>&nbsp; &nbsp;</label>
                                            <button onclick="paging(1)" class="btn btn-info" style="">Tìm nguồn Bài Viết</button>
                                        </div>
                                    </form>
                                </div>                                                                   
                                    <div class="content noPad">
                                    <table class="responsive table table-bordered" id="checkAll">
                                        <thead>
                                          <tr>
                                            <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                            <th>Tên nguồn Bài Viết</th>                                            
                                            <th>Miêu tả</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_source']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                                          <tr>
                                            <td class="chChildren"><input type="checkbox" name="checkbox[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value->id;?>
" class="styled" /></td>
                                            <td class="alignleft">
                                                <span class="lastedit-pe"></span><strong style="color: blue;"><?php echo $_smarty_tpl->tpl_vars['val']->value->name;?>
</strong>
                                                <div class="quk-edit">
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_source("edit",$_smarty_tpl->tpl_vars['val']->value->id);?>
">Sửa</a>
                                                    | 
                                                    <a  href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_source("delete",$_smarty_tpl->tpl_vars['val']->value->id);?>
">Xóa</a
                                                </div>
                                            </td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['val']->value->description;?>
</td>
                                          </tr> 
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="margin10 clearfix">    
                                    <div class="pagination left">
                                        total : <?php echo $_smarty_tpl->tpl_vars['data']->value['paging']['total'];?>

                                    </div>
                                  <?php if ($_smarty_tpl->tpl_vars['data']->value['paging']['total_page']>1){?>
                                    <div class="pagination right">
                                          <ul>
                                            <li><a href="javascript:paging(1);"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                                            <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['paging']['page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['val']->key;
?> 
                                                <li <?php if ($_smarty_tpl->tpl_vars['val']->value==$_smarty_tpl->tpl_vars['data']->value['paging']['current_page']){?> class="active"<?php }?>>
                                                    <a href="javascript:paging(<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
);"><span><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</span></a>
                                                </li>                                                    
                                            <?php } ?>                                               
                                            <li><a href="javascript:paging(<?php echo $_smarty_tpl->tpl_vars['data']->value['paging']['total_page'];?>
);"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
                                          </ul>
                                    </div>                                        
                                    <?php }?>                           
                                </div>
                                
                            </div><!-- End .box -->
                </div><!-- End .row-fluid -->
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->
    

<script>
    function paging(page){
        $("#page").val(page);
        $("#search_form").submit();       
    }
</script>

<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>