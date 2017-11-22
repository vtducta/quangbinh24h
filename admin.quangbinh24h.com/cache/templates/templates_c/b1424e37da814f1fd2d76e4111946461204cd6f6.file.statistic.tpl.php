<?php /* Smarty version Smarty-3.1.12, created on 2017-10-16 08:25:27
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/home/statistic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:188361408359e40a87274b80-10345715%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1424e37da814f1fd2d76e4111946461204cd6f6' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/home/statistic.tpl',
      1 => 1504767331,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '188361408359e40a87274b80-10345715',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_helper' => 0,
    'data' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59e40a873ca3e8_21629777',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e40a873ca3e8_21629777')) {function content_59e40a873ca3e8_21629777($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<!-- loading animation -->
<!--<div id="qLoverlay"></div>
<div id="qLbar"></div>  -->

<script type="text/javascript">
    flag =0;
</script>

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

                <div>
                    <div id ="count_news">
                    </div>                
                </div><!-- End .span8 -->                    
            </div><!-- End .row-fluid --> 
            <div class="row-fluid">
                <div class="box gradient">                                
                    <div class="title">
                        <h4>
                            <span>Danh sách bài đã pubic</span>
                        </h4>
                    </div>
                    <form method="post" action="" id="statistic">
                        <div class="clearfix" style="padding: 10px;">
                            <div class="left marginT10 marginR10"> 
                                <input type="text" name="date_from" id="datepicker" placeholder="Từ ngày" />
                            </div>
                            <div class="left marginT10 marginR10"> 
                                <input type="text" name="date_to" id="datepicker-inline" placeholder="Đến ngày" />
                            </div>
                            <div class="left marginT10" style="width: 190px;overflow:hidden;margin-left: 10px;">
                                <select name="select_user" id="select_user">
                                    <option id="0" value="0" >User</option>
                                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
                                    <option id="<?php echo $_smarty_tpl->tpl_vars['val']->value->user_id;?>
" value="<?php echo $_smarty_tpl->tpl_vars['val']->value->user_id;?>
" ><?php echo $_smarty_tpl->tpl_vars['val']->value->username;?>
</option>
                                    <?php } ?>                
                                </select>
                            </div>
                            <div class="left" style="">
                                <a onclick="document.getElementById('statistic').submit();" class="btn btn-info left margin10" style="z-index: 3;">Thống kê</a>
                            </div>
                        </div>
                    </form>
                </div><!-- End .box -->
                <?php if ($_smarty_tpl->tpl_vars['data']->value['total_view']){?>
                Tổng bài viết: <?php echo $_smarty_tpl->tpl_vars['data']->value['total_news'];?>
<br>
                Tổng view: <?php echo $_smarty_tpl->tpl_vars['data']->value['total_view'];?>
<br>
                <?php }?>
            </div><!-- End .row-fluid --> 
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->
</div><!-- End #wrapper -->
<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>